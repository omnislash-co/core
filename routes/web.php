<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Events\DiagnosingHealth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserController;
use App\Game;

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
Route::get('/terms', function () { return view('terms'); })->name('terms');
Route::get('/privacy', function () { return view('privacy'); })->name('privacy');

// Games
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game:slug}', [GameController::class, 'show'])->name('games.show');
Route::get('/games/{game:slug}/reviews', [GameController::class, 'show'])->name('games.reviews');
Route::get('/games/{game:slug}/recommendations', [GameController::class, 'show'])->name('games.recommendations');
Route::get('/games/{game:slug}/releases', [GameController::class, 'show'])->name('games.releases');

Route::get('games/{game:slug}/library', fn(Game $game) => view('games.library', compact('game')))
    ->middleware('auth')
    ->name('games.library');

// Reviews
Route::resource('reviews', ReviewController::class)->only([
    'index', 'show', 'create', 'edit'
]);

// Recommendations
Route::resource('recommendations', RecommendationController::class)->only([
    'index', 'show', 'create', 'edit'
]);

// Users
Route::get('community/users/{user:id}/favourites', [UserController::class, 'favourites'])->name('users.favourites');
Route::get('community/users/{user:id}/library', [UserController::class, 'libraryIndex'])->name('users.libraryIndex');
Route::get('community/users/{user:id}/library/{playStatus:slug}', [UserController::class, 'library'])->withoutScopedBindings()->name('users.library');
Route::get('community/users/{user:id}/reviews', [UserController::class, 'reviews'])->name('users.reviews');
Route::get('community/users/{user:id}/recommendations', [UserController::class, 'recommendations'])->name('users.recommendations');

// Health route
Route::get('/up', function () {
    Event::dispatch(new DiagnosingHealth);

    return View::file(__DIR__.'/../vendor/laravel/framework/src/illuminate/foundation/resources/health-up.blade.php');
});