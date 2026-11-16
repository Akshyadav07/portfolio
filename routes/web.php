<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProjectController as FrontendProjectController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects/{slug}', [FrontendProjectController::class, 'show'])->name('projects.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Routes — Protected by admin.auth middleware
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile',         [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',         [ProfileController::class, 'update'])->name('profile.update');

    // Skills
    Route::resource('skills', SkillController::class);

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::delete('/projects/{project}/images/{image}', [ProjectController::class, 'deleteImage'])
         ->name('projects.images.destroy');

    // Experience
    Route::resource('experiences', ExperienceController::class);

    // Education
    Route::resource('education', EducationController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // Social Links
    Route::resource('social-links', SocialLinkController::class);

    // Settings
    Route::get('/settings',  [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings',  [SettingController::class, 'update'])->name('settings.update');

    // Messages
    Route::get('/messages',                       [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}',             [MessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/read',      [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{message}',          [MessageController::class, 'destroy'])->name('messages.destroy');

});
