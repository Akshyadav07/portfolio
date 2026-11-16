<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
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
| Google OAuth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->name('auth.google.')->group(function () {
    Route::get('/google',          [GoogleController::class, 'redirect'])->name('redirect');
    Route::get('/google/callback', [GoogleController::class, 'callback'])->name('callback');
    Route::post('/logout',         [GoogleController::class, 'logout'])->name('logout');
});

// Admin login page (public)
Route::get('/admin/login', function () {
    if (session('admin_logged_in')) {
        return redirect()->route('admin.dashboard');
    }
    return view('auth.login');
})->name('admin.login');

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
