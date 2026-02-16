<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


// Show login page
Route::get('/login', [AuthController::class , 'showLoginForm'])->name('login');

// Handle login submit
Route::post('/login', [AuthController::class , 'login'])->name('login.submit');

Route::get('/', function () {
    return view('main');
});

use App\Http\Controllers\ForgotPasswordController;

Route::get('/forgot-password', [ForgotPasswordController::class , 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class , 'resetPassword'])->name('password.reset.simple');



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Show signup page
Route::get('/signup', [AuthController::class , 'showSignupForm'])->name('signup');

// Handle signup submit
Route::post('/signup', [AuthController::class , 'signup'])->name('signup.submit');

Route::get('/main', function () {
    return view('main');
})->name('main');

Route::get('/home', function () {
    return view('home');
})->name('home');



Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/track-order', function () {
    return view('track-order');
})->name('track-order');

Route::get('/feedback', function () {
    return view('feedback');
})->name('feedback');

//menu
use App\Http\Controllers\MenuController;
// Default menu route
Route::get('/menu', [MenuController::class , 'index'])->name('menu');
Route::get('/menu', [App\Http\Controllers\MenuController::class , 'index'])->name('menu.index');

// Specific categories
/*Route::get('/menu/buns', [MenuController::class, 'showBuns'])->name('menu.buns');
Route::get('/menu/drinks', [MenuController::class, 'showDrinks'])->name('menu.drinks');
Route::get('/menu/sweets', [MenuController::class, 'showSweets'])->name('menu.sweets');
Route::get('/menu/snacks', [MenuController::class, 'showSnacks'])->name('menu.snacks');
Route::get('/menu/breakfast', [MenuController::class, 'showBreakfast'])->name('menu.breakfast');
Route::get('/menu/lunch', [MenuController::class, 'showLunch'])->name('menu.lunch');
Route::get('/menu/dinner', [MenuController::class, 'showDinner'])->name('menu.dinner');*/


use App\Http\Controllers\CartController;
Route::get('/cart', [CartController::class , 'index'])->name('cart');
Route::patch('/cart/update/{id}', [CartController::class , 'update'])->name('cart.update');
Route::get('/checkout', [CartController::class , 'checkout'])->name('checkout');
Route::post('/cart/add/{id}', [CartController::class , 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class , 'remove'])->name('cart.remove');


use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class , 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class , 'store'])->name('checkout.store');



Route::get('/checkout', [CheckoutController::class , 'index'])->name('checkout');

use App\Http\Controllers\PaymentController;

// Show the payment form
Route::get('/payment', [PaymentController::class , 'create'])->name('payment.create');

// Handle form submission
Route::post('/payment', [PaymentController::class , 'store'])->name('payment.store');


use App\Http\Controllers\OrderController;

// View order status by ticket
Route::get('/track-order', [OrderController::class , 'showOrder'])->name('track-order');

// Confirm order received
Route::post('/order/confirm', [OrderController::class , 'confirmReceived'])->name('order.confirm');

// Submit feedback
Route::post('/order/feedback', [OrderController::class , 'submitFeedback'])->name('order.feedback');

// View all feedback
Route::get('/feedback', [OrderController::class , 'showFeedbackPage'])->name('feedback.index');

// Consolidated Feedback Routes (removed duplicates)
// Note: Feedback submission is handled by OrderController@submitFeedback via 'order.feedback' route defined above

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\DashboardController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class , 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class , 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');
        }
        );
    });

use App\Http\Controllers\Admin\Auth\MenuItemController;

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/menu', [MenuItemController::class , 'index'])->name('menu-items.index');
    Route::post('/menu-items/{item}/toggle-availability', [MenuItemController::class , 'toggleAvailability'])->name('menu-items.toggle'); // ✅ Toggle status
});
use App\Http\Controllers\Admin\Auth\OrdersController;

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('/orders', [OrdersController::class , 'index'])->name('orders');
});

Route::put('/admin/orders/{order}/status', [OrdersController::class , 'updateStatus'])->name('admin.orders.update-status');
Route::post('/orders/confirm-received', [OrdersController::class , 'confirmReceived'])->name('order.confirm');
Route::get('/admin/feedback', [OrdersController::class , 'feedback'])->name('admin.feedback');
Route::get('/admin/orders/weekly-report', [OrdersController::class , 'weeklyReportView'])->name('admin.orders.weekly-report');
Route::post('/admin/orders/cash-order', [OrdersController::class , 'storeCashOrder'])->name('admin.orders.cash-order');
Route::post('/admin/orders/cash-order-multi', [OrdersController::class , 'cashOrderMulti'])->name('admin.orders.cash-order-multi');
Route::post('/admin/orders/cash-order-multi', [OrdersController::class , 'storeCashOrderMulti'])->name('admin.orders.cash-order-multi');

use App\Http\Controllers\Admin\Auth\UserController;

Route::get('/admin/users', [UserController::class , 'index'])->name('admin.users');

use App\Http\Controllers\Admin\Auth\CashOrderController;

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/cash-orders', [CashOrderController::class , 'index'])->name('cash-orders');
});
?>
