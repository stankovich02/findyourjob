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

//testirati da li rade linkovi i sve bez controllera
Route::view('/author', 'client.author')->name('author');

Route::resource('jobs', \App\Http\Controllers\Client\JobController::class);

Route::resource('companies', \App\Http\Controllers\Client\CompanyController::class);

Route::controller(\App\Http\Controllers\Client\ContactController::class)->group(function (){
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'store')->name('contact.store');
});

Route::post('/newsletter', [\App\Http\Controllers\Client\NewsletterController::class, 'store'])->name('newsletter');

Route::get('/search', [\App\Http\Controllers\Client\HomeController::class, 'search'])->name('search');

Route::middleware('IsLoggedIn')->group(function (){
    Route::controller(\App\Http\Controllers\Client\AccountController::class)->group(function (){
        Route::prefix('account')->name('account.')->group(function (){
            Route::get('/','index')->name('index');
            Route::patch('/socials', 'updateSocials')->name('update_socials');
            Route::patch('/info', 'info')->name('info');
            Route::patch('/picture', 'picture')->name('picture');
            Route::get('/password/new', 'showFormForNewPassword')->name('show_form_for_new_password');
            Route::patch('/password/new', 'updatePassword')->name('update_password');
        });
    });
        Route::patch('/companies/logo/{id}', [\App\Http\Controllers\Client\CompanyController::class, 'logo'])->name('companies.logo');
        Route::post('/jobs/save/{id}', [\App\Http\Controllers\Client\JobController::class, 'save'])->name('jobs.save');
        Route::post('/jobs/boost/{id}', [\App\Http\Controllers\Client\JobController::class, 'boost'])->name('jobs.boost');
    Route::controller(\App\Http\Controllers\Client\ApplicationController::class)->group(function (){
        Route::get('/application/{id}', 'index')->name('application.index');
        Route::post('/application/store', 'store')->name('application.store');
        Route::delete('/application/delete/{id}', 'destroy')->name('application.destroy');
    });
    Route::get('/logout', [\App\Http\Controllers\Client\Auth\AuthController::class, 'logout'])->name('logout');
});

Route::middleware('IsNotLoggedIn')->group(function (){
    Route::controller(\App\Http\Controllers\Client\AccountController::class)->group(function (){
        Route::prefix('account')->name('account.')->group(function (){
            Route::get('/password/forgot','showFormForEmail')->name('show_form_for_email');
            Route::post('/password/forgot', 'sendEmailForReset')->name('send_email_for_reset');
            Route::get('/password/reset/{token}', 'showFormForReset')->name('show_form_for_reset');
            Route::patch('/password/reset/{token}', 'resetPassword')->name('reset_password');
        });
    });
    Route::controller(\App\Http\Controllers\Client\Auth\AuthController::class)->group(function (){
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.login');
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register')->name('register.register');
        Route::get('/verification/{token}',  'verify')->name('verify');
    });
});

