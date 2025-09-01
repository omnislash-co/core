<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Game;
use App\Library;
use App\PlayStatus;

class LibraryController extends Controller
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
    public function index(Game $game)
    {
        $libraries = Library::with([
            'platform',
            'playStatus'
        ])->where([
                ['game_id', '=', $game->id ],
                ['user_id', '=', auth()->user()->id ]
            ])->get();

        $playStatuses = PlayStatus::orderBy('id')->get(['id', 'name']);

        return view('games.library', compact('game', 'libraries', 'playStatuses'));       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Game $game)
    {
        $playStatuses = PlayStatus::orderBy('id')->get(['id', 'name']);

        return view('library.create', compact('game', 'playStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibraryRequest $request, Game $game)
    {
        $validated = $request->validated();

        Library::create([
            'user_id' => auth()->user()->id,
            'game_id' => $game->id,
            'platform_id' => $validated['platform'],
            'play_status_id' => $validated['playStatus'],
            'score' => $validated['score'],
            'hours' => $validated['hours'],
            'notes' => $validated['notes']
        ]);

        return redirect()->action(
            [LibraryController::class, 'index'], [$game]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Game $game, Library $library)
    {
        if ($request->user()->cannot('update', $library)) {
            abort(403);
        }

        $playStatuses = PlayStatus::orderBy('id')->get(['id', 'name']);

        return view('library.edit', compact('game', 'library', 'playStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLibraryRequest $request, Game $game, Library $library)
    {
        $validated = $request->validated();

        $library->update([
            'platform_id' => $validated['platform'],
            'play_status_id' => $validated['playStatus'],
            'score' => $validated['score'],
            'hours' => $validated['hours'],
            'notes' => $validated['notes']
        ]);

        return redirect()->action(
            [LibraryController::class, 'index'], [$game]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Game $game, Library $library)
    {
        if ($request->user()->cannot('delete', $library)) {
            abort(403);
        }

        Library::destroy($library->id); 

        return redirect()->action(
            [LibraryController::class, 'index'], [$game]
        );
    }
}
