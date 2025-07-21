<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Game;
use App\Developer;
use App\Genre;
use App\Platform;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $games = QueryBuilder::for(Game::class)
            ->with(['developers', 'genres'])
            ->allowedFilters([
                AllowedFilter::partial('title'),
                AllowedFilter::exact('developers', 'developers.name'),
                AllowedFilter::exact('platforms', 'platforms.name'),
                AllowedFilter::exact('genres', 'genres.name'),
            ])
            ->defaultSort('-created_at')
            ->allowedSorts([
                AllowedSort::field('created', 'created_at'),
                AllowedSort::field('popular', 'popularity_rank'),
                AllowedSort::field('score', 'score_rank'),
            ])
            ->paginate(8)
            ->appends(request()->query());

        $developers = Developer::orderBy('name')->get(['id', 'name']);
        $genres = Genre::orderBy('name')->get(['id', 'name']);
        $platforms = Platform::orderBy('name')->get(['id', 'name']);

        return view('games.index', compact('games', 'developers', 'genres', 'platforms'));
    }

    /**
     * Show a game.
     */
    public function show(Game $game): View
    {
        $game->load([
            'reviews' => function ($query) {
                $query->with('user')->orderBy('created_at', 'desc')->limit(2);
            },
            'recommendations' => function ($query) {
                $query->with([
                    'user',
                    'game',
                    'playedGame'
                ])->orderBy('created_at', 'desc')->limit(2);
            }
        ]);

        $game->visit();

        return view('games.overview', compact('game'));
    }

    /**
     * Display game releases.
     */
    public function releases(Game $game)
    {
        $game->getReleasesGroupedByPlatform();

        return view('games.releases', compact('game'));        
    }

    /**
     * Display game reviews.
     */
    public function reviews(Game $game)
    {
        $reviews = $game->reviews()->orderBy('created_at', 'desc')->paginate(8);

        return view('games.reviews', compact('game', 'reviews'));        
    }

    /**
     * Display game recommendations.
     */
    public function recommendations(Game $game)
    {
        $recommendations = $game->recommendations()->orderBy('created_at', 'desc')->paginate(8);

        return view('games.recommendations', compact('game', 'recommendations'));        
    }
}
