<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Venue;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::view('/privada', "secret")->name('privada');


Route::get('/', function () {
    return view('app');
});

Route::get('/venues', function () {
    return view('venues.index');
});

Route::get('/bookings', function () {
    return view('bookings.index');
});

Route::get('/users', function () {
    return view('users.index');
});

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');



Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');


Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');


Route::get('/venues', function () {
    $venues = Venue::all();
    return view('venues.index', ['venues' => $venues]);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion',[LoginController::class,'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');