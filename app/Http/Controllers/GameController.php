<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Game;
use App\Library;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('games.index');
    }

    /**
     * Show a game.
     */
    public function show(Game $game): View
    {
        $game->loadCount(['reviews', 'recommendations', 'releases'])->load([
            'developers',
            'genres',
            'platforms' => fn ($query) => $query->with([
                'releases' => fn ($q) => $q->with('region')->where('game_id', $game->id)
            ])->get(),
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

        $user_library_count = 0;
        if (Auth()->user())
        {
            $user_library_count = Library::where([
                'game_id' => $game->id,
                'user_id' => Auth()->user()->id,
            ])->count();
        }

        return view('games.show', compact('game', 'user_library_count'));
    }

    /**
     * Update game rankings.
     */
    public static function updateRankings()
    {
        //Update score for all games
        Game::chunk(100, function ($games) {
            foreach ($games as $game) {
                $filtered = $game->libraries()->whereNotNull('score');
                $score = ($filtered->count() > 0 ? number_format(($filtered->avg('score') / 10) * 100, 0) : null);

                $game->update(['score' => $score]);
            }
        });

        //Update library_count for all games
        Game::withCount(['libraries' => function (Builder $query) {
                $query->select(DB::raw('count(distinct(user_id))'));
            }])->chunk(100, function ($games) {
            foreach ($games as $game) {
                $game->update(['library_count' => $game->libraries_count]);
            }
        });

        //Update score_rank for all games
        $scoreRank = 0;
        Game::orderBy('score', 'desc')->chunk(100, function ($games) use (&$scoreRank) {
            foreach ($games as $game) {
                $scoreRank++;
                $game->update(['score_rank' => $scoreRank]);
            }
        });

        //Update popularity_rank for all games
        $popularityRank = 0;
        Game::orderBy('library_count', 'desc')->chunk(100, function ($games) use (&$popularityRank) {
            foreach ($games as $game) {
                $popularityRank++;
                $game->update(['popularity_rank' => $popularityRank]);
            }
        });
    }
}
