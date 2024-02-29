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




Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\Client\AboutController::class, 'index'])->name('about');
Route::get('/jobs/filter', [\App\Http\Controllers\Client\JobController::class, 'filter'])->name('jobs.filter');

Route::resource('jobs', \App\Http\Controllers\Client\JobController::class);

Route::resource('companies', \App\Http\Controllers\Client\CompanyController::class);

Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'index'])->name('contact');

Route::post('/newsletter', [\App\Http\Controllers\Client\NewsletterController::class, 'store'])->name('newsletter');

Route::get('/verification/{token}', [App\Http\Controllers\Client\Auth\AuthController::class, 'verify'])->name('verify');



Route::middleware('IsLoggedIn')->group(function (){
        Route::controller(\App\Http\Controllers\Client\AccountController::class)->group(function (){
            Route::get('/account','index')->name('account');
            Route::put('/account/socials', 'socials')->name('account.socials');
            Route::put('/account/info', 'info')->name('account.info');
            /*Route::put('/account/password', 'password')->name('account.password');*/
            Route::put('/account/picture', 'picture')->name('account.picture');
        });
        Route::post('/jobs/save/{id}', [\App\Http\Controllers\Client\JobController::class, 'save'])->name('jobs.save');
    Route::controller(\App\Http\Controllers\Client\ApplicationController::class)->group(function (){
        Route::get('/application/{id}', 'index')->name('application.index');
        Route::post('/application/store', 'store')->name('application.store');
    });
    Route::get('/logout', [\App\Http\Controllers\Client\Auth\AuthController::class, 'logout'])->name('logout');
});

Route::middleware('IsNotLoggedIn')->group(function (){
    Route::controller(\App\Http\Controllers\Client\Auth\AuthController::class)->group(function (){
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.login');
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register')->name('register.register');
    });
});
