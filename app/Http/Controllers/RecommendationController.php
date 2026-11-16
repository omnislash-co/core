<?php

namespace App\Http\Controllers;

use App\Recommendation;
use App\Game;
use App\Http\Requests\StoreRecommendationRequest;
use App\Http\Requests\UpdateRecommendationRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class RecommendationController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $recommendations = QueryBuilder::for(Recommendation::class)
            ->with(['user', 'game', 'playedGame'])
            ->allowedFilters(
                AllowedFilter::exact('games', 'playedGame.title'),
            )
            ->defaultSort('-created_at')
            ->allowedSorts(
                AllowedSort::field('created', 'created_at'),
            )
            ->paginate(8)
            ->appends(request()->query());

        $games = Game::orderBy('title')->get(['id', 'title']);

        return view('recommendations.index', compact('recommendations', 'games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $games = Game::orderBy('title')->get(['id', 'title']);
        $platforms = [];

        if (old('game', request('game'))) {
            $platforms = Game::find(old('game', request('game')))->platforms()->orderBy('name')->get(['id', 'name']);
        }

        return view('recommendations.create', compact('games', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecommendationRequest $request)
    {
        $validated = $request->validated();

        $recommendation = Recommendation::create([
            'user_id' => auth()->user()->id,
            'played_game_id' => $validated['played'],
            'game_id' => $validated['game'],
            'platform_id' => $validated['platform'],
            'body' => $validated['body'],
        ]);

        return redirect()->action(
            [RecommendationController::class, 'show'], [$recommendation]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Recommendation $recommendation): View
    {
        $recommendation->load(['game', 'platform', 'user', 'playedGame']);
        return view('recommendations.show', compact('recommendation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Recommendation $recommendation): View
    {
        if ($request->user()->cannot('update', $recommendation)) {
            abort(403);
        }
        
        $recommendation->load(['game', 'platform', 'playedGame']);
        $platforms = Game::find($recommendation->game->id)->platforms()->orderBy('name')->get(['id', 'name']);

        return view('recommendations.edit', compact('recommendation', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecommendationRequest $request, Recommendation $recommendation)
    {
        $validated = $request->validated();

        $recommendation->update([
            'body' => $validated['body'],
            'platform_id' => $validated['platform'],
        ]);

        return redirect()->action(
            [RecommendationController::class, 'show'], [$recommendation]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
