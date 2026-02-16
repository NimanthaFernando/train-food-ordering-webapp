<?php

use Illuminate\Support\Facades\Mail;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "APP_KEY: " . env('APP_KEY') . "\n";
echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";

try {
    Mail::raw('This is a test email from Train Eats (Order System). If you see this, your email configuration is working!', function ($message) {
        $message->to(env('MAIL_USERNAME'))
            ->subject('Train Eats Config Test');
    });
    echo "SUCCESS: Email sent successfully!\n";
}
catch (\Exception $e) {
    echo "ERROR: Failed to send email.\n";
    echo "Reason: " . $e->getMessage() . "\n";
}
