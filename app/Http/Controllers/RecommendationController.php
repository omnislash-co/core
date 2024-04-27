<?php

namespace App\Http\Controllers;

use App\Recommendation;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $recommendations = Recommendation::with([
            'user',
            'game',
            'playedGame'
        ])->orderBy('created_at', 'desc')->paginate(8);

        return view('recommendations.index', compact('recommendations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('recommendations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('recommendations.edit', compact('recommendation'));
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
