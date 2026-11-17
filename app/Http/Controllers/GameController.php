<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Game;
use App\Developer;
use App\Genre;
use App\Platform;
use App\Series;
use App\User;
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
            ->allowedFilters(
                AllowedFilter::partial('title'),
                AllowedFilter::exact('developers', 'developers.name'),
                AllowedFilter::exact('platforms', 'platforms.name'),
                AllowedFilter::exact('genres', 'genres.name'),
                AllowedFilter::exact('series', 'series.name'),
            )
            ->defaultSort('-created_at')
            ->allowedSorts(
                AllowedSort::field('created', 'created_at'),
                AllowedSort::field('popular', 'popularity_rank'),
                AllowedSort::field('score', 'score_rank'),
                AllowedSort::field('title', 'title'),
                AllowedSort::field('release', 'initial_release_year'),
            )
            ->paginate(8)
            ->appends(request()->query());

        $developers = Developer::orderBy('name')->get(['id', 'name']);
        $genres = Genre::orderBy('name')->get(['id', 'name']);
        $platforms = Platform::orderBy('name')->get(['id', 'name']);
        $series = Series::orderBy('name')->get(['id', 'name']);

        return view('games.index', compact('games', 'developers', 'genres', 'platforms', 'series'));
    }

    /**
     * Show a game.
     */
    public function show(Game $game): View
    {
        $game->load([
            'developers',
            'platforms.releases' => fn ($query) => $query
                ->with('region')
                ->where('game_id', $game->id),
            'genres',
            'series',
            'children',
            'parents',
            'reviews' => fn ($query) => $query
                ->with(['user', 'platform'])
                ->latest()
                ->limit(2),
            'recommendations' => fn ($query) => $query
                ->with(['user', 'game', 'platform', 'playedGame'])
                ->latest()
                ->limit(2),
        ]);

        $game->loadCount([
            'reviews',
            'recommendations',
            'releases',
            'children',
            'parents',
            'libraries as ratings_count' => fn ($query) => $query->whereNotNull('score'),
        ]);

        $game->visit();

        return view('games.show', compact('game'));
    }

    /**
     * Toggle user favorite.
     */
    public function toggleFavorite(Game $game)
    {
        $user = User::find(auth()->user()->id);
        $user->toggleFavorite($game);
        $message = $game->hasBeenFavoritedBy($user) ? "Added to favorites" : "Removed from favorites";

        return redirect()->back()->with('success', $message);      
    }
}
