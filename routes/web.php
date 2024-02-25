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




Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::resource('jobs', \App\Http\Controllers\JobController::class);

Route::resource('companies', \App\Http\Controllers\CompanyController::class);

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');



Route::middleware('IsLoggedIn')->group(function (){
    Route::get('/account/{id}', [App\Http\Controllers\AccountController::class, 'show'])->name('account.show');
    Route::get('/account/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    Route::controller(\App\Http\Controllers\ApplicationController::class)->group(function (){
        Route::get('/application', 'index')->name('application.index');
        Route::post('/application', 'store')->name('application.store');
        Route::get('/application/{id}', 'show')->name('application.show');
    });
    Route::get('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});

Route::middleware('IsNotLoggedIn')->group(function (){
    Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function (){
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.login');
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register')->name('register.register');
        Route::get('/verification/{token}', 'verify')->name('verify');
    });
});
