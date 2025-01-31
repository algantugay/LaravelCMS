<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TamplateController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\User\TestController;
use App\Http\Controllers\Frontend\FrontendController;


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



// Admin Login
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});

// Admin Yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/panel', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('pages', PageController::class);
    Route::resource('categories', CategoryController::class);

    // Kategori özel
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');   
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    // Yorumlar
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::put('comments/{id}/status', [CommentController::class, 'updateStatus'])->name('comments.updateStatus');
    Route::delete('comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Mesajlar
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::delete('admin/messages/user/{user_id}', [MessageController::class, 'destroyUserMessages'])->name('messages.destroyUserMessages');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/', function(){
    return view('Frontend.index');
});

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    // Mesajları görüntüleme
    Route::get('/messages', [TestController::class, 'index'])->name('messages.index');

    // Yeni mesaj gönderme
    Route::post('/messages/send', [TestController::class, 'send'])->name('messages.send');
});