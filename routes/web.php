<?php

use App\Http\Controllers\DriverAuthController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserAuthController::class, 'login'])->name('users.login');
    Route::get('/register', [UserAuthController::class, 'register'])->name('users.register');
    Route::post('/login', [UserAuthController::class, 'handleLogin'])->name('users.handleLogin');
    Route::post('/register', [UserAuthController::class, 'handleRegister'])->name('users.handleRegister');

    Route::get('/driver/login', [DriverAuthController::class, 'login'])->name('drivers.login');
    Route::post('/driver/login', [DriverAuthController::class, 'handleLogin'])->name('drivers.handleLogin');
    Route::get('/driver/register', [DriverAuthController::class, 'register'])->name('drivers.register');
    Route::post('/driver/register', [DriverAuthController::class, 'handleRegister'])->name('drivers.handleRegister');
});
Route::get('/logout', [UserAuthController::class, 'logout'])->name('users.logout');
Route::get('/driver/logout', [DriverAuthController::class, 'logout'])->name('drivers.logout');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [UserAuthController::class, 'index'])->name('users.index');
    Route::get('/profile', [UserAuthController::class, 'profile'])->name('users.profile');
    Route::put('/profile', [UserAuthController::class, 'handleUpdate'])->name('users.handleUpdate');
    Route::get('/rides', [UserAuthController::class, 'rides'])->name('users.rides');
    Route::post('/ridesstore', [UserAuthController::class, 'ridesStore'])->name('users.ridesStore');
    Route::get('/report', [UserAuthController::class, 'report'])->name('users.report');
    Route::get('/delete/{id}', [UserAuthController::class, 'delete'])->name('users.delete');

    Route::post('/pay/{id}', [UserAuthController::class, 'pay'])->name('users.handlePay');
    Route::get('/payment/{id}/{pay}', [UserAuthController::class, 'payment'])->name('users.handlePayment');

    Route::post('/ratings', [UserAuthController::class, 'ratings'])->name('users.handleRating');

    Route::get('/maplocation/{id}', [UserAuthController::class, 'maplocation'])->name('users.maplocation');
});

Route::middleware(['auth:webdrivers'])->group(function () {
    Route::get('/driver', [DriverAuthController::class, 'index'])->name('drivers.index');
    Route::get('/driver/profile', [DriverAuthController::class, 'profile'])->name('drivers.profile');
    Route::put('/driver/profile', [DriverAuthController::class, 'handleUpdate'])->name('drivers.handleUpdate');
    Route::get('/driver/ride', [DriverAuthController::class, 'ride'])->name('drivers.ride');
    Route::get('/driver/accept/{id}', [DriverAuthController::class, 'accept'])->name('drivers.accept');
    Route::get('/driver/report', [DriverAuthController::class, 'report'])->name('drivers.report');
    Route::get('/driver/edit/{id}', [DriverAuthController::class, 'edit'])->name('drivers.edit');
    Route::put('/driver/edit', [DriverAuthController::class, 'handleEdit'])->name('drivers.handleEdit');
    Route::post('/driver/updateDriverLocation', [DriverAuthController::class, 'updateLocation'])->name('drivers.updateLocation');
    Route::post('/driver/Location', [DriverAuthController::class, 'locations'])->name('drivers.location');
    Route::get('/payment/{id}', [DriverAuthController::class, 'payment'])->name('drivers.payment');
    Route::post('/payment', [DriverAuthController::class, 'storePayment'])->name('drivers.handlePayment');
    Route::get('/driver/location', [DriverAuthController::class, 'location'])->name('drivers.samplelocation');
    Route::get('/maplocations/{id}', [DriverAuthController::class, 'maplocation'])->name('drivers.maplocations');
});
