<?php

namespace App\Http\Controllers;

use App\Game;
use App\Library;
use App\Replay;
use App\Http\Requests\StoreReplayRequest;
use App\Http\Requests\UpdateReplayRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReplayController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Game $game, Library $library)
    {
        Gate::authorize('create', [Replay::class, $library]);

        return view('library.replay.create', compact('game', 'library'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReplayRequest $request, Game $game, Library $library)
    {
        $validated = $request->validated();
        
        Replay::create([
            'library_id' => $library->id,
            'hours' => $validated['hours'],
            'hours_optional' => $validated['hours_optional'],
            'hours_complete' => $validated['hours_complete'],
            'notes' => $validated['notes']
        ]);

        return redirect()->action(
            [LibraryController::class, 'index'], [$game]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Replay $replay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game, Library $library, Replay $replay)
    {
        Gate::authorize('update', $replay);

        return view('library.replay.edit', compact('game', 'library', 'replay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReplayRequest $request, Game $game, Library $library, Replay $replay)
    {
        $validated = $request->validated();
        
        $replay->update([
            'hours' => $validated['hours'],
            'hours_optional' => $validated['hours_optional'],
            'hours_complete' => $validated['hours_complete'],
            'notes' => $validated['notes']
        ]);

        return redirect()->action(
            [LibraryController::class, 'index'], [$game]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game, Library $library, Replay $replay)
    {
        Gate::authorize('delete', $replay);

        Replay::destroy($replay->id); 

        return redirect()->action(
            [LibraryController::class, 'index'], [$game]
        );
    }
}
