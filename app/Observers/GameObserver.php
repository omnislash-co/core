<?php

namespace App\Observers;

use App\Game;
use Illuminate\Support\Facades\Storage;

class GameObserver
{
    /**
     * Handle the Game "created" event.
     */
    public function created(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "updated" event.
     */
    public function updated(Game $game): void
    {
        if ($game->isDirty('icon')) {
            Storage::disk('public')->delete('games/icons/'.$game->getOriginal('icon'));
        }
        if ($game->isDirty('cover')) {
            Storage::disk('public')->delete('games/covers/'.$game->getOriginal('cover'));
        }
    }

    public function saved(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "deleted" event.
     */
    public function deleted(Game $game): void
    {
        if (! is_null($game->icon)) {
            Storage::disk('public')->delete('games/icons/'.$game->icon);
        }
        if (! is_null($game->cover)) {
            Storage::disk('public')->delete('games/covers/'.$game->cover);
        }
    }

    /**
     * Handle the Game "restored" event.
     */
    public function restored(Game $game): void
    {
        //
    }

    /**
     * Handle the Game "force deleted" event.
     */
    public function forceDeleted(Game $game): void
    {
        //
    }
}
