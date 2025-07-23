<?php

namespace App\Http\Controllers;

use App\Review;
use App\Game;
use App\Platform;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
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
        $reviews = Review::with([
            'user',
            'game',
            'platform'
        ])->orderBy('created_at', 'desc')->paginate(8);

        return view('reviews.index', compact('reviews'));
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
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
