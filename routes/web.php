<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\WebAuthController;
use App\Http\Controllers\TrajetWebController;
use App\Http\Controllers\ReservationWebController;
use App\Http\Controllers\AvisWebController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/cars', [PageController::class, 'cars'])->name('cars');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [PageController::class, 'single'])->name('single');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);
Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [WebAuthController::class, 'register']);
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WebAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/trajets/create', [TrajetWebController::class, 'create'])->name('trajets.create');
    Route::post('/trajets', [TrajetWebController::class, 'store'])->name('trajets.store');
    Route::get('/my-trips', [TrajetWebController::class, 'index'])->name('trajets.my');
    Route::get('/reservations/create/{trajet}', [ReservationWebController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationWebController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationWebController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/my-reservations', [ReservationWebController::class, 'index'])->name('reservations.my');
    Route::get('/profile', [WebAuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [WebAuthController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [WebAuthController::class, 'deleteProfile'])->name('profile.destroy');
    Route::post('/trajets/{trajet}/contact', [PageController::class, 'sendDriverContact'])->name('trajets.contact');
    Route::post('/trajets/{trajet}/review', [\App\Http\Controllers\AvisWebController::class, 'store'])->name('trajets.review');
    Route::get('/admin', [WebAuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/vehicules', [\App\Http\Controllers\VehiculeWebController::class, 'index'])->name('vehicules.index');
    Route::get('/vehicules/create', [\App\Http\Controllers\VehiculeWebController::class, 'create'])->name('vehicules.create');
    Route::post('/vehicules', [\App\Http\Controllers\VehiculeWebController::class, 'store'])->name('vehicules.store');
    Route::get('/vehicules/{vehicule}/edit', [\App\Http\Controllers\VehiculeWebController::class, 'edit'])->name('vehicules.edit');
    Route::put('/vehicules/{vehicule}', [\App\Http\Controllers\VehiculeWebController::class, 'update'])->name('vehicules.update');
    Route::delete('/vehicules/{vehicule}', [\App\Http\Controllers\VehiculeWebController::class, 'destroy'])->name('vehicules.destroy');
    Route::get('/messages', [\App\Http\Controllers\MessageWebController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [\App\Http\Controllers\MessageWebController::class, 'create'])->name('messages.create');
    Route::post('/messages', [\App\Http\Controllers\MessageWebController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}', [\App\Http\Controllers\MessageWebController::class, 'show'])->name('messages.show');
    Route::get('/avis', [AvisWebController::class, 'index'])->name('avis.index');
});

Route::get('/trajets/{trajet}', [TrajetWebController::class, 'show'])->name('trajets.show');