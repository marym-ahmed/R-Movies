<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

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

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [UserAuthController::class, 'dashboard']);
Route::get('registration', [UserAuthController::class, 'registration'])->name('register-user');
Route::post('user-registration', [UserAuthController::class, 'userRegistration'])->name('register.user');
Route::post('user-login', [UserAuthController::class, 'userLogin'])->name('login.user');
Route::get('vsearch', [MovieController::class, 'vsearch'])->name('vsearch');
Route::get('welcome', [UserAuthController::class, 'welcome'])->name('welcome');

Auth::routes();

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {

    // User-related Routes
    Route::get('allUsers', [UserAuthController::class, 'allUsers'])->name('allUsers');
    Route::get('usersearch', [UserAuthController::class, 'search'])->name('usersearch');
    Route::get('edit/{user}', [UserAuthController::class, 'edit'])->name('edit-user');
    Route::post('user-update/{user}', [UserAuthController::class, 'update'])->name('update.user');
    Route::delete('deleteAcount/{user}', [UserAuthController::class, 'destroy'])->name('deleteAcount');
    Route::get('signout', [UserAuthController::class, 'signOut'])->name('signout');
    Route::get('profile/{user}', [MovieController::class, 'profile'])->name('profile-user');
    Route::get('about', [UserAuthController::class, 'about'])->name('about');

    // Movie-related Routes
    Route::resource('movie', MovieController::class);
    Route::get('reportedMovies', [MovieController::class, 'reportedMovies'])->name('reportedMovies');
    Route::post('MovieType/{type}', [MovieController::class, 'MovieType'])->name('MovieType');
    Route::get('moviesearch', [MovieController::class, 'search'])->name('moviesearch');
    Route::post('like', [MovieController::class, 'like'])->name('like');
    Route::post('dislike', [MovieController::class, 'dislike'])->name('dislike');
    Route::post('report', [MovieController::class, 'report'])->name('report');
    Route::get('userMovie', [MovieController::class, 'userMovie'])->name('userMovie');
    Route::post('movie/{id}', [MovieController::class, 'show'])->name('moviedetails');
    Route::post('showMovie/{id}', [MovieController::class, 'showMovie'])->name('showMovie');
    Route::get('remove/{id}', [MovieController::class, 'delete'])->name('deletereport');
    Route::get('movies/{user}', [MovieController::class, 'likemovies'])->name('like-movies');

    // Category-related Routes
    Route::resource('categories', CategoryController::class);
    Route::get('categorysearch', [CategoryController::class, 'search'])->name('categorysearch');
    Route::get('category/{id}', [CategoryController::class, 'show'])->name('categorydetails');

    // Comment-related Routes
    Route::get('reportedComment', [CommentController::class, 'reportedCommentes'])->name('reportedCommentes');
    Route::post('likeComment', [CommentController::class, 'like'])->name('likeComment');
    Route::post('dislikeComment', [CommentController::class, 'dislike'])->name('dislikeComment');
    Route::post('reportComment', [CommentController::class, 'report'])->name('reportComment');
    Route::get('delete/{id}', [CommentController::class, 'remove'])->name('deletecomment');
    Route::post('movie/{id}/comment', [CommentController::class, 'store'])->name('comment');
    Route::get('cancel/{id}', [CommentController::class, 'destroy'])->name('destroycomment');
});
