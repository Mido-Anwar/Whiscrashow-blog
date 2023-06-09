<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
//use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'role:Admin'])->name('dashboard');

//////// all my model i have created

Route::resource('post', PostController::class)->middleware(['auth', 'verified', 'role:Admin']);
Route::resource('category', CategoryController::class)->middleware(['auth', 'verified', 'role:Admin']);
Route::resource('tag', TagController::class)->middleware(['auth', 'verified', 'role:Admin']);
Route::resource('role', RoleController::class)->middleware(['auth', 'verified', 'role:Admin']);
Route::resource('permission', PermissionController::class)->middleware(['auth', 'verified', 'role:Admin']);
Route::resource('user', UserController::class)->middleware(['auth', 'verified', 'role:Admin']);
Route::resource('home', HomeController::class)->middleware(['auth', 'verified', 'role:Admin']);


//
//mail route
//
//Route::post('/contact', ContactController::class)->name('contact');

// favorite list routes
Route::post('/favorite/{post}', [HomeController::class, 'favoritePost'])->name('favorite');
Route::post('/unfavorite/{post}', [HomeController::class, 'unfavoritePost'])->name('unfavorite');
// قراءة المقال  route to read post
Route::get('/show/{id}', [HomeController::class, 'show'])->name('article.show');
// logo change route
//Route::get('/homeLogo',  [HomeController::class, 'create'])->name('logo.create');
//Route::post('/logoSave', [HomeController::class, 'store'])->name('logo.store');
//get posts by category route
Route::get('/categories/{id}', [HomeController::class, 'getCategryPosts'])->name('categories');
// search route
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
