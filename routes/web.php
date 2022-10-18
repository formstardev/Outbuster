<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\PlaylistController;
use App\Http\Controllers\Account\SubscriptionController;
use App\Http\Controllers\Account\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FilmController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('email', [RegisterController::class, 'email'])->name('email');

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::get('category-list', [CategoryController::class, 'index'])->name('category.index');
Route::get('category-list/{id}', [CategoryController::class, 'showFilm'])->name('category.showfilm');
Route::get('film-list', [FilmController::class, 'index'])->name('film.index');
Route::get('tag-list', [TagController::class, 'index'])->name('tag.index');
Route::get('tag-list/{id}', [TagController::class, 'showFilm'])->name('tag.showfilm');
Route::group(['middleware' => ['guest']], function () {
    // Register
    Route::post('register', [RegisterController::class, 'register'])->name('register.perform');
    // Login
    Route::post('login', [LoginController::class, 'login'])->name('login.perform');
    // Forget
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget');
    // Password reset
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    // Password update
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('password.update');

    Route::get('verify/{token}', [RegisterController::class, 'verifyAccount'])->name('verify');
});
Route::group(['middleware' => ['auth']], function () {
    // logout reset
    Route::get('logout', [LoginController::class, 'logout'])->name('logout.perform');

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('playlist', [PlaylistController::class, 'index'])->name('playlist');
        Route::post('set-favorite', [PlaylistController::class, 'favorite'])->name('set_favorite');
        Route::get('payment', [PaymentController::class, 'index'])->name('payment');    
        // Account Subscription Routes
        Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription');
        Route::get('subscription-create', [SubscriptionController::class, 'create'])->name('subscription.create');
        Route::get('subscription-type', [SubscriptionController::class, 'type'])->name('subscription.type');
        Route::post('subscription-cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
        Route::get('payment-manage', [SubscriptionController::class, 'paymentManage'])->name('payment.manage');
    });
    /** PayPal Subscription */
    Route::get('/subscribe/{id}/paypal', [SubscriptionController::class, 'paypalRedirect'])->name('paypal.redirect');
    Route::get('/subscribe/{id}/paypal/return', [SubscriptionController::class, 'paypalReturn'])->name('paypal.return');
    Route::get('/subscribe/{id}/paypal/cancel', [SubscriptionController::class, 'paypalCancel'])->name('paypal.cancel');
    /** Stripe Subscription */
    Route::get('/subscribe/{id}/stripe', [SubscriptionController::class, 'stripeRedirect'])->name('stripe.redirect');
    Route::post('/subscribe/stripe', [SubscriptionController::class, 'stripeSubscribe'])->name('stripe.subscribe');
    Route::post('/subscribe/stripe/trial', [SubscriptionController::class, 'stripeTrial'])->name('stripe.trial');
    Route::get('/subscribe/{id}/stripe/cancel', [SubscriptionController::class, 'stripeCancel'])->name('stripe.cancel');
});
