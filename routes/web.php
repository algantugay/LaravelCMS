<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\User\TestController;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', function(){
    return view('Frontend.index');
});

// Yorum Yönetimi
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::put('admin/comments/{id}/status', [CommentController::class, 'updateStatus'])->name('admin.comments.updateStatus');
    Route::delete('/admin/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
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

// Kullanıcı yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('users', UserController::class);
});

// Sayfa yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('pages', PageController::class);
});

// Kategori yönetimi
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('categories', CategoryController::class);

    // Kategori oluşturma route'u
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

    // Kategori düzenleme route'u
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
});

// İletişim
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/messages/reply', [MessageController::class, 'reply'])->name('admin.messages.reply');
    Route::delete('admin/messages/user/{user_id}', [MessageController::class, 'destroyUserMessages'])->name('admin.messages.destroyUserMessages');
});




// TEST //
Route::get('login', [TestController::class, 'showLoginForm'])->name('login');
Route::post('login', [TestController::class, 'login']);
Route::get('/logout', [TestController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('messages', [TestController::class, 'index'])->name('messages.index');
    Route::post('messages', [TestController::class, 'send'])->name('messages.send');
});