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

Route::get('/author', [\App\Http\Controllers\Client\AuthorController::class, 'index'])->name('author');

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
Route::middleware('IsAdmin')->prefix('/admin')->name('admin.')->group(function (){
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::get('/applications/stats', [\App\Http\Controllers\Admin\AdminController::class, 'applicationStats'])->name('applications.stats');
    Route::controller(\App\Http\Controllers\Admin\JobController::class)->group(function (){
        Route::get('/jobs','index')->name('jobs.index');
        Route::get('/jobs/pending','pending')->name('jobs.pending');
        Route::get('/jobs/boosted','boosted')->name('jobs.boosted');
        Route::patch('/jobs/{id}', 'approve')->name('jobs.approve');
        Route::get('/jobs/{id}', 'show')->name('jobs.show');
        Route::delete('/jobs/{id}', 'destroy')->name('jobs.destroy');
        Route::delete('/jobs/boosted/{id}', 'destroyBoosted')->name('jobs.destroy_boosted');
    });
    Route::controller(\App\Http\Controllers\Admin\CompanyController::class)->group(function (){
        Route::get('/companies','index')->name('companies.index');
        Route::get('/companies/pending','pending')->name('companies.pending');
        Route::patch('/companies/{id}', 'approve')->name('companies.approve');
        Route::get('/companies/{id}', 'show')->name('companies.show');
        Route::delete('/companies/{id}', 'destroy')->name('companies.destroy');
    });
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::patch('/users/ban/{id}', [\App\Http\Controllers\Admin\UserController::class, 'ban'])->name('users.ban');
    Route::patch('/users/unban/{id}', [\App\Http\Controllers\Admin\UserController::class, 'unban'])->name('users.unban');
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('cities', \App\Http\Controllers\Admin\CityController::class);
    Route::resource('navs', \App\Http\Controllers\Admin\NavController::class);
    Route::resource('seniorities', \App\Http\Controllers\Admin\SeniorityController::class);
    Route::resource('technologies', \App\Http\Controllers\Admin\TechnologyController::class);
    Route::resource('workplaces', \App\Http\Controllers\Admin\WorkplaceController::class);
    Route::get('/newsletters', [\App\Http\Controllers\Client\NewsletterController::class, 'index'])->name('newsletters.index');
    Route::delete('/newsletters/{id}', [\App\Http\Controllers\Client\NewsletterController::class, 'destroy'])->name('newsletters.destroy');

});

