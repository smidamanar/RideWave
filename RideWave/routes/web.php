<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Driver\DashboardController as DriverDashboardController;
use App\Http\Controllers\Driver\FindRideController as DriverFindRideController;
use App\Http\Controllers\Driver\FleetController;
use App\Http\Controllers\Driver\HomeController as DriverHomeController;
use App\Http\Controllers\Driver\HistoryController as DriverHistoryController;
use App\Http\Controllers\Driver\OfferRideController;
use App\Http\Controllers\Driver\ReservationDecisionController;
use App\Http\Controllers\Driver\RideBookingController as DriverRideBookingController;
use App\Http\Controllers\Driver\ProfileController as DriverProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Passenger\BookingController;
use App\Http\Controllers\Passenger\FindRideController as PassengerFindRideController;
use App\Http\Controllers\Passenger\HistoryController as PassengerHistoryController;
use App\Http\Controllers\Passenger\HomeController as PassengerHomeController;
use App\Http\Controllers\Passenger\ProfileController as PassengerProfileController;
use App\Http\Controllers\RideCommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::post('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/rides/{trajet}/comments', [RideCommentController::class, 'store'])->name('rides.comments.store');
});

Route::middleware(['auth', 'role:passenger'])->prefix('passenger')->name('passenger.')->group(function () {
    Route::get('/home', PassengerHomeController::class)->name('home');
    Route::get('/find-rides', PassengerFindRideController::class)->name('find-rides');
    Route::post('/rides/{trajet}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/history', PassengerHistoryController::class)->name('history');
    Route::post('/history/{reservation}/reviews', [PassengerHistoryController::class, 'storeReview'])->name('history.reviews.store');
    Route::get('/profile', [PassengerProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/photo', [PassengerProfileController::class, 'photo'])->name('profile.photo');
    Route::put('/profile', [PassengerProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:driver'])->prefix('driver')->name('driver.')->group(function () {
    Route::get('/home', DriverHomeController::class)->name('home');
    Route::get('/find-rides', DriverFindRideController::class)->name('find-rides');
    Route::post('/rides/{trajet}/book', [DriverRideBookingController::class, 'store'])->name('bookings.store');
    Route::get('/offer-ride', [OfferRideController::class, 'create'])->name('offer-ride.create');
    Route::post('/offer-ride', [OfferRideController::class, 'store'])->name('offer-ride.store');
    Route::get('/fleet', [FleetController::class, 'index'])->name('fleet');
    Route::post('/fleet', [FleetController::class, 'store'])->name('fleet.store');
    Route::get('/fleet/{vehicule}/edit', [FleetController::class, 'edit'])->name('fleet.edit');
    Route::put('/fleet/{vehicule}', [FleetController::class, 'update'])->name('fleet.update');
    Route::get('/fleet/{vehicule}/photo', [FleetController::class, 'photo'])->name('fleet.photo');
    Route::delete('/fleet/{vehicule}', [FleetController::class, 'destroy'])->name('fleet.destroy');
    Route::get('/history', DriverHistoryController::class)->name('history');
    Route::post('/history/{reservation}/reviews', [DriverHistoryController::class, 'storeReview'])->name('history.reviews.store');
    Route::get('/dashboard', DriverDashboardController::class)->name('dashboard');
    Route::post('/reservations/{reservation}/accept', [ReservationDecisionController::class, 'accept'])->name('reservations.accept');
    Route::post('/reservations/{reservation}/reject', [ReservationDecisionController::class, 'reject'])->name('reservations.reject');
    Route::get('/profile', [DriverProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/photo', [DriverProfileController::class, 'photo'])->name('profile.photo');
    Route::put('/profile', [DriverProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/trips', [AdminDashboardController::class, 'trips'])->name('trips');
    Route::post('/trips/{trajet}/toggle-validation', [AdminDashboardController::class, 'toggleTripValidation'])->name('trips.toggle-validation');
    Route::get('/fleet', [AdminDashboardController::class, 'fleet'])->name('fleet');
    Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/search', [AdminDashboardController::class, 'search'])->name('search');
    Route::get('/reports/export', [AdminDashboardController::class, 'exportReport'])->name('reports.export');
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/photo', [AdminProfileController::class, 'photo'])->name('profile.photo');
    Route::get('/offer-ride', fn () => redirect()->route('admin.trips'))->name('offer-ride');
    Route::get('/my-rides', fn () => redirect()->route('admin.trips'))->name('my-rides');
});
