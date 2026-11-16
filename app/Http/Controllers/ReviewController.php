<?php

namespace App\Http\Controllers;

use App\Review;
use App\Game;
use App\Platform;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reviews = QueryBuilder::for(Review::class)
            ->with(['user', 'game', 'platform'])
            ->allowedFilters(
                AllowedFilter::exact('games', 'game.title'),
                AllowedFilter::exact('platforms', 'platform.name'),
            )
            ->defaultSort('-created_at')
            ->allowedSorts(
                AllowedSort::field('created', 'created_at'),
                AllowedSort::field('score', 'score'),
            )
            ->paginate(8)
            ->appends(request()->query());

        $games = Game::orderBy('title')->get(['id', 'title']);
        $platforms = Platform::orderBy('name')->get(['id', 'name']);

        return view('reviews.index', compact('reviews', 'games', 'platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $games = Game::orderBy('title')->get(['id', 'title']);
        $platforms = [];

        if (old('game', request('game'))) {
            $platforms = Game::find(old('game', request('game')))->platforms()->orderBy('name')->get(['id', 'name']);
        }

        return view('reviews.create', compact('games', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $validated = $request->validated();

        $review = Review::create([
            'user_id' => auth()->user()->id,
            'game_id' => $validated['game'],
            'platform_id' => $validated['platform'],
            'summary' => $validated['summary'],
            'body' => $validated['body'],
            'score' => $validated['score']
        ]);

        return redirect()->action(
            [ReviewController::class, 'show'], [$review]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): View
    {
        $review->load(['game', 'platform', 'user']);
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Review $review): View
    {
        if ($request->user()->cannot('update', $review)) {
            abort(403);
        }

        $review->load(['game', 'platform']);
        $platforms = Game::find($review->game->id)->platforms()->orderBy('name')->get(['id', 'name']);

        return view('reviews.edit', compact('review', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $validated = $request->validated();

        $review->update([
            'platform_id' => $validated['platform'],
            'summary' => $validated['summary'],
            'body' => $validated['body'],
            'score' => $validated['score']
        ]);

        return redirect()->action(
            [ReviewController::class, 'show'], [$review]
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
