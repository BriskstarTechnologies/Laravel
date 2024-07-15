<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit-user');
    Route::put('update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update-user');
});    
Route::get('/register-user', [App\Http\Controllers\UserController::class, 'index'])->name('create');
Route::post('store-user', [App\Http\Controllers\UserController::class, 'store'])->name('create-user');

Route::get('payment', 'StripePaymentController@index');
Route::post('charge', 'StripePaymentController@charge');
