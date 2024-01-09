<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;

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

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\movieController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\commentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', [UserAuthController::class, 'dashboard']);
//Route::get('login', [UserAuthController::class, 'index'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('reportedMovies', [movieController::class, 'reportedMovies'])->name('reportedMovies');
    // if (Auth::id() == 1) {
        // Route::get('reportedCommentes', [commentController::class, 'reportedCommentes'])->name('reportedCommentes');
        Route::post('MovieType/{type}', [movieController::class,'MovieType'])->name('MovieType');
        Route::get('allUsers', [UserAuthController::class, 'allUsers'])->name('allUsers');
        Route::get('usersearch', [userAuthController::class, 'search'])->name('usersearch');
        Route::get('categorysearch', [categoryController::class, 'search'])->name('categorysearch');
        Route::get('moviesearch', [movieController::class, 'search'])->name('moviesearch');
        Route::resource('categories', categoryController::class);
        Route::get('reportedComment', [commentController::class,'reportedCommentes'])->name('reportedCommentes');
        Route::get('reportedMovie', [movieController::class,'reportedMovies'])->name('reportedMovies');
        // Route::get('reportedCommentes', [commentController::class, 'reportedCommentes'])->name('reportedCommentes');
    // }
});

Route::post('user-login', [UserAuthController::class, 'userLogin'])->name('login.user');
Route::get('registration', [UserAuthController::class, 'registration'])->name('register-user');
Route::post('user-registration', [UserAuthController::class, 'userRegistration'])->name('register.user');


//Route::get('destroyuser/{user}', [UserAuthController::class, 'destroyuser'])->name('destroyuser');
Route::get('/', function () {
    return view('welcome');
});




Route::get('moviesearch', [movieController::class, 'search'])->name('moviesearch');

//Route::get('usersearch',[UserAuthController::class,'search'])->name('usersearch');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::resource('movie', movieController::class);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('categorysearch', [categoryController::class, 'search'])->name('categorysearch');
    Route::resource('categories', categoryController::class);
    Route::post('like', [movieController::class, 'like'])->name('like');
    Route::post('dislike', [movieController::class, 'dislike'])->name('dislike');
    Route::post('report', [movieController::class, 'report'])->name('report');
    Route::post('likeComment', [commentController::class, 'like'])->name('likeComment');
    Route::post('dislikeComment', [commentController::class, 'dislike'])->name('dislikeComment');
    Route::post('reportComment', [commentController::class, 'report'])->name('reportComment');
    Route::get('userMovie', [movieController::class, 'userMovie'])->name('userMovie');
    Route::post('movie/{id}', [movieController::class, 'show'])->name('moviedetails');
    Route::get('category/{id}', [categoryController::class, 'show'])->name('categorydetails');
    Route::post('showMovie/{id}', [movieController::class, ' showMovie'])->name('showMovie');
    Route::get('delete/{id}', [commentController::class, 'remove'])->name('deletecomment');
    Route::post('movie/{id}/comment', [commentController::class, 'store'])->name('comment');
    Route::get('edit/{user}', [UserAuthController::class, 'edit'])->name('edit-user');
    Route::post('user-update/{user}', [UserAuthController::class, 'update'])->name('update.user');
    Route::delete('deleteAcount/{user}', [UserAuthController::class, 'destroy'])->name('deleteAcount');
    Route::get('signout', [UserAuthController::class, 'signOut'])->name('signout');
    Route::get('MovieType/{id}', [movieController::class,'MovieType'])->name('MovieType');
    Route::get('profile/{user}', [movieController::class, 'profile'])->name('profile-user');
 
    Route::get('movies/{user}', [movieController::class, 'likemovies'])->name('like-movies');
    Route::get('cancel/{id}', [commentController::class, 'destroy'])->name('destroycomment');
    Route::get('remove/{id}', [movieController::class, 'delete'])->name('deletereport');
    Route::get('about', [UserAuthController::class, 'about'])->name('about');
});
Route::get('vsearch', [movieController::class, 'vsearch'])->name('vsearch');
Route::get('welcome', [UserAuthController::class, 'welcome'])->name('welcome');