<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\User\TestController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\TamplateController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function(){
    return view('Frontend.index');
});

Route::get('/login', [TamplateController::class, 'login'])->name("login.tamplate");
Route::get('/register', [TamplateController::class, 'register'])->name("register.tamplate");
Route::get('/dashboard', [TamplateController::class, 'dashboard'])->name("dashboard")->middleware('user');
Route::get('overview', [TamplateController::class, 'overview'])->name("profile.overview")->middleware('user');
Route::get('settings', [TamplateController::class, 'settings'])->name("profile.settings")->middleware('user');
Route::get('/logout', [TamplateController::class, 'logout'])->name("logout");

Route::get('/users/{id}', [RegisterController::class, 'show']);

Route::post('/update-email', [RegisterController::class, 'updateEmail'])->name('update-email');
Route::post('/update-password', [RegisterController::class, 'updatePassword'])->name('update-password');

Route::post('/login', [RegisterController::class, 'loginUser'])->name('login');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register');

Route::prefix('profile')->name('profile.')->group(function () {
    Route::post('/update', [RegisterController::class, 'updateName'])->name('update');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Admin LOGİN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::middleware('admin')->group(function () {
        Route::get('/panel', [AdminController::class, 'index'])->name('dashboard');
    });
});

// Admin Yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('users', UserController::class);

    Route::resource('pages', PageController::class);

    Route::resource('categories', CategoryController::class);

    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/admin/comments', [CommentController::class, 'index'])->name('comments.index');

    Route::put('admin/comments/{id}/status', [CommentController::class, 'updateStatus'])->name('comments.updateStatus');

    Route::delete('/admin/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// İletişim
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/messages/reply', [MessageController::class, 'reply'])->name('admin.messages.reply');
    Route::delete('admin/messages/user/{user_id}', [MessageController::class, 'destroyUserMessages'])->name('admin.messages.destroyUserMessages');
});
