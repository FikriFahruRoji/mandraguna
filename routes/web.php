<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FieldStoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// =============================================
// PUBLIC ROUTES
// =============================================
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/sustainability', [PageController::class, 'sustainability'])->name('sustainability');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{post:slug}', [PageController::class, 'newsDetail'])->name('news.detail');
Route::get('/field-stories/{fieldStory:slug}', [PageController::class, 'fieldStoryDetail'])->name('field-stories.detail');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit')->middleware('throttle:contact');
Route::get('/captcha/refresh', [PageController::class, 'refreshCaptcha'])->name('captcha.refresh');

// =============================================
// AUTH ROUTES
// =============================================
Route::middleware('guest')->group(function () {
    Route::get('/cms-login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/cms-login', [LoginController::class, 'login'])->middleware('throttle:login');
    Route::get('/captcha/refresh-login', [LoginController::class, 'refreshCaptcha'])->name('captcha.refresh-login');
});

Route::post('/cms-logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// =============================================
// ADMIN ROUTES (Protected)
// =============================================
Route::middleware('auth')->prefix('panel-umkm')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');



    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Field Stories
    Route::get('/field-stories', [FieldStoryController::class, 'index'])->name('field-stories.index');
    Route::get('/field-stories/create', [FieldStoryController::class, 'create'])->name('field-stories.create');
    Route::post('/field-stories', [FieldStoryController::class, 'store'])->name('field-stories.store');
    Route::get('/field-stories/{fieldStory}/edit', [FieldStoryController::class, 'edit'])->name('field-stories.edit');
    Route::post('/field-stories/{fieldStory}', [FieldStoryController::class, 'update'])->name('field-stories.update');
    Route::delete('/field-stories/{fieldStory}', [FieldStoryController::class, 'destroy'])->name('field-stories.destroy');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Storage Link Helper (for cPanel without SSH)
    Route::get('/run-storage-link', function () {
        Artisan::call('storage:link');
        return redirect()->route('admin.dashboard')->with('success', 'Storage link berhasil dibuat.');
    })->name('storage-link');
});
