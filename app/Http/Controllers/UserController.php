<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\User;
use App\Game;
use App\Library;
use App\PlayStatus;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;

class UserController extends Controller
{
    /**
     * Show user favourites.
     */
    public function favourites(User $user): View
    {
        $favourites = $user->getFavoriteItems(Game::class)->orderBy('title')->get();
        return view('users.favourites', compact('user', 'favourites'));
    }

    /**
     * Show user library.
     */
    public function libraryIndex(User $user)
    {
        $playStatus = PlayStatus::where('name', 'Currently Playing')->first();
        return redirect()->route('users.library', compact('user', 'playStatus'));
    }

    /**
     * Show user library by play status.
     */
    public function library(User $user, PlayStatus $playStatus): View
    {
        $entries = QueryBuilder::for(Library::class)
            ->select('libraries.*', 'games.title', 'platforms.name', 'platforms.acronym')
                ->join('games', 'libraries.game_id', 'games.id')
                ->join('platforms', 'libraries.platform_id', 'platforms.id')
            ->with(['game', 'platform'])
            ->defaultSort('games.title')
            ->allowedSorts([
                AllowedSort::field('title', 'games.title'),
                AllowedSort::field('platform', 'platforms.name'),
                AllowedSort::field('score', 'score'),
                AllowedSort::field('main', 'hours'),
                AllowedSort::field('sides', 'hours_optional'),
                AllowedSort::field('complete', 'hours_complete'),
            ])
            ->where([
                'user_id' => $user->id,
                'play_status_id' => $playStatus->id,
            ])
            ->paginate(50)
            ->appends(request()->query());

        return view('users.library', compact('user', 'entries'));
    }

    /**
     * Show user reviews.
     */
    public function reviews(User $user): View
    {
        $reviews = $user->reviews()->with([
            'user',
            'game',
            'platform'
        ])->orderBy('created_at', 'desc')->paginate(8);
        return view('users.reviews', compact('user', 'reviews'));
    }

    /**
     * Show user recommendations.
     */
    public function recommendations(User $user): View
    {
        $recommendations = $user->recommendations()->with([
            'user',
            'game',
            'playedGame'
        ])->orderBy('created_at', 'desc')->paginate(8);
        return view('users.recommendations', compact('user', 'recommendations'));
    }
}
