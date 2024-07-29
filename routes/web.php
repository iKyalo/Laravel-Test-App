<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CommentsController;

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


Route::get('/', function () {
    return view('home.dashboard');
})->name('home');
Route::get('/dashboard', [UsersController::class, 'index'])->middleware('auth')->name('dashboard');

Route::redirect('/blog', '/blogs');
Route::redirect('/home', '/dashboard');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/user/edit/{id}', [UsersController::class, 'edit'])->name('users.edit')->where('id', '[0-9]+');;
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit')->where('id', '[0-9]+');;
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/update', [UsersController::class, 'update'])->name('users.update');
    Route::post('/users/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('blogs', [BlogsController::class, 'index'])->name('blogs.index');
    Route::get('blogs/{id}', [BlogsController::class, 'show'])->name('blogs.show')->where('id', '[0-9]+');
    Route::get('blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('blogs/edit/{id}', [BlogsController::class, 'edit'])->name('blogs.edit')->where('id', '[0-9]+');
    Route::put('/blogs/update', [BlogsController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/destroy', [BlogsController::class, 'destroy'])->name('blogs.destroy');

    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
});
