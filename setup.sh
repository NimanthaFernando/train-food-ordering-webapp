#!/bin/bash

###############################################################################
# Laravel Podman Setup Script for CentOS
# This script automates the deployment of a containerized Laravel application
###############################################################################

set -e  # Exit on any error

echo "========================================="
echo "Laravel Podman Deployment Setup"
echo "========================================="
echo ""

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[✓]${NC} $1"
}

print_error() {
    echo -e "${RED}[✗]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[!]${NC} $1"
}

# Check if running as root
if [[ $EUID -ne 0 ]]; then
   print_error "This script must be run as root (use sudo)"
   exit 1
fi

print_status "Starting deployment process..."

# Step 1: Update system packages
#echo ""
#echo "Step 1: Updating system packages..."
#dnf update -y
#print_status "System packages updated"

# Step 2: Install Podman and related tools
echo ""
echo "Step 2: Installing Podman and podman-compose..."
if ! command -v podman &> /dev/null; then
    dnf install -y podman podman-compose podman-docker
    print_status "Podman installed successfully"
else
    print_warning "Podman is already installed"
fi

# Step 3: Enable Podman socket (for docker-compose compatibility)
echo ""
echo "Step 3: Enabling Podman socket..."
systemctl enable --now podman.socket
print_status "Podman socket enabled"

# Step 4: Verify Podman installation
echo ""
echo "Step 4: Verifying Podman installation..."
podman --version
podman-compose --version 2>/dev/null || print_warning "podman-compose not available, using podman compose"
print_status "Podman verification complete"

# Step 5: Configure environment file
echo ""
echo "Step 5: Configuring environment..."
cd /root/Order_System

if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
        print_status "Environment file created from .env.example"
    else
        print_error ".env.example file not found!"
        exit 1
    fi
else
    print_warning ".env file already exists, skipping..."
fi

# Step 6: Build and start containers
echo ""
echo "Step 6: Building and starting containers..."
podman-compose down 2>/dev/null || true
podman-compose up -d --build
print_status "Containers started"

# Step 8: Wait for containers to be ready
echo ""
echo "Step 8: Waiting for containers to initialize..."
sleep 10

# Step 9: Install Composer dependencies
echo ""
echo "Step 9: Installing Composer dependencies..."
podman-compose exec app composer install --no-interaction --optimize-autoloader --no-dev 2>/dev/null || {
    print_warning "Composer dependencies may already be installed or container is not ready yet"
}

# Step 10: Set proper permissions
echo ""
echo "Step 10: Setting directory permissions..."
podman-compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
podman-compose exec app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
print_status "Permissions set"

# Step 10: Database migrations and Application initialization
echo ""
echo "Step 10: Initializing database and application..."
podman-compose exec app php artisan migrate --force --seed 2>/dev/null || true
podman-compose exec app php artisan storage:link 2>/dev/null || true
print_status "Database migrated, seeded, and storage linked"

# Step 11: Application Key check
echo ""
echo "Step 11: Generating Application key..."
if ! grep -q "APP_KEY=base64:" .env; then
    podman-compose exec app php artisan key:generate
    print_status "APP_KEY generated. Restarting containers to apply..."
    podman-compose restart app
else
    print_status "APP_KEY is already set"
fi

# Step 12: Configure firewall
echo ""
echo "Step 12: Configuring firewall..."
if command -v firewall-cmd &> /dev/null; then
    if systemctl is-active --quiet firewalld; then
        firewall-cmd --permanent --add-port=8000/tcp || true
        firewall-cmd --permanent --add-port=8081/tcp || true
        firewall-cmd --permanent --add-port=3306/tcp || true
        firewall-cmd --reload
        print_status "Firewall configured (ports 8000, 8081, 3306 opened)"
    else
        print_warning "Firewalld is not running, skipping firewall configuration"
    fi
else
    print_warning "Firewalld not found, skipping firewall configuration"
fi

# Step 13: Display container status
echo ""
echo "Step 13: Container status..."
podman-compose ps

# Final status
echo ""
echo "========================================="
echo -e "${GREEN}Deployment Complete!${NC}"
echo "========================================="
echo ""
echo "Your application is now running:"
echo "  - Laravel App: http://localhost:8000 or http://$(hostname -I | awk '{print $1}'):8000"
echo "  - phpMyAdmin:  http://localhost:8081 or http://$(hostname -I | awk '{print $1}'):8081"
echo "  - MySQL Port:  3306"
echo ""
echo "Useful commands:"
echo "  - View logs:        podman-compose logs -f"
echo "  - Stop containers:  podman-compose down"
echo "  - Start containers: podman-compose up -d"
echo "  - Restart:          podman-compose restart"
echo ""
echo "Next steps:"
echo "  1. If APP_KEY is not set, run: podman-compose exec app php artisan key:generate"
echo "  2. Run migrations: podman-compose exec app php artisan migrate"
echo "  3. Access the application in your browser"
echo ""
print_status "Setup complete!"
