<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ReplayController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/faq', function () { return view('faq'); })->name('faq');
// Route::get('/terms', function () { return view('terms'); })->name('terms');
// Route::get('/privacy', function () { return view('privacy'); })->name('privacy');

// Games
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game:slug}', [GameController::class, 'show'])->name('games.show');
Route::post('/games/{game:slug}/toggle-favorite', [GameController::class, 'toggleFavorite'])
    ->middleware('auth')
    ->name('games.toggleFavorite');

// Library
Route::resource('games/{game:slug}/library', LibraryController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middlewareFor(['index'], ['auth'])
    ->middlewareFor(['create', 'store'], ['auth', 'can:create,App\Library'])
    ->middlewareFor(['edit', 'update'], ['auth', 'can:update,library'])
    ->middlewareFor(['destroy'], ['auth', 'can:delete,library']);

// Replay
Route::resource('games/{game:slug}/library/{library:id}/replay', ReplayController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middlewareFor(['create', 'store'], ['auth', 'can:create,App\Replay,library'])
    ->middlewareFor(['edit', 'update'], ['auth', 'can:update,replay'])
    ->middlewareFor(['destroy'], ['auth', 'can:delete,replay']);

// Reviews
Route::resource('reviews', ReviewController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update'])
    ->middlewareFor(['create', 'store'], ['auth', 'can:create,App\Review'])
    ->middlewareFor(['edit', 'update'], ['auth', 'can:update,review']);

// Recommendations
Route::resource('recommendations', RecommendationController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update'])
    ->middlewareFor(['create', 'store'], ['auth', 'can:create,App\Recommendation'])
    ->middlewareFor(['edit', 'update'], ['auth', 'can:update,recommendation']);

// Users
Route::get('community/users/{user:id}', [UserController::class, 'libraryIndex'])->name('waterhole.users.show');
Route::get('community/users/{user:id}/favorites', [UserController::class, 'favorites'])->name('users.favorites');
Route::get('community/users/{user:id}/library', [UserController::class, 'libraryIndex'])->name('users.libraryIndex');
Route::get('community/users/{user:id}/library/{playStatus:slug}', [UserController::class, 'library'])->withoutScopedBindings()->name('users.library');
Route::get('community/users/{user:id}/reviews', [UserController::class, 'reviews'])->name('users.reviews');
Route::get('community/users/{user:id}/recommendations', [UserController::class, 'recommendations'])->name('users.recommendations');