<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Game;
use App\Review;
use App\Recommendation;
use App\Library;
use App\User;
use \Waterhole\Models\Post;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $trending = Game::with([
            'developers',
            'genres',
        ])->popularThisMonth()->limit(4)->get();

        if (count($trending) === 0)
        {
            $trending = Game::with([
                'developers',
                'genres',
            ])
            ->popularLastMonth()->limit(4)->get();
        }

        $userActivities = Library::with([
            'user',
            'game',
            'playStatus'
        ])->orderBy('created_at', 'desc')->limit(3)->get();

        $popular = Game::with([
            'developers',
        ])->orderBy('popularity_rank', 'asc')->limit(5)->get();

        $topRanked = Game::with([
            'developers',
        ])->orderBy('score_rank', 'asc')->limit(5)->get();

        $posts = Post::with([
            'user',
            'channel',
            'tags',
            'lastComment' => fn($q) => $q->with('user')
        ])->orderBy('created_at', 'desc')->limit(3)->get();

        $reviews = Review::with([
            'user',
            'game',
        ])->orderBy('created_at', 'desc')->limit(2)->get();

        $recommendations = Recommendation::with([
            'user',
            'game',
            'playedGame'
        ])->orderBy('created_at', 'desc')->limit(2)->get();

        $gamesCount = Game::all()->count();
        $usersCount = User::all()->count();
        $postsCount = Post::all()->count();

        return view('home', compact('trending', 'userActivities', 'popular', 'topRanked', 'posts', 'reviews', 'recommendations', 'gamesCount', 'usersCount', 'postsCount'));
    }
}
