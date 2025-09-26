<?php

namespace App\Http\Controllers;

use App\Series;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $series = Series::withCount(['games'])->orderBy('name', 'asc')->get();

        $seriesByGamesCount = Series::withCount(['games'])->orderBy('games_count', 'desc')->limit(4)->get();

        return view('series.index', compact('series', 'seriesByGamesCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Series $series)
    {
        $games = $series->games()->with([
            'developers',
            'genres'
        ])->orderBy('title', 'asc')->paginate(20);

        return view('series.show', compact('series', 'games'));
    }
}
