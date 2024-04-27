<?php

namespace App\Livewire\Games;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Recommendation;
use App\Game;

class Recommendations extends Component
{
    use WithPagination;

    public Game $game;
    
    #[Computed] 
    public function recommendations()
    {
        return Recommendation::with(['user', 'game', 'playedGame'])
            ->where('played_game_id', $this->game->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.games.recommendations');
    }
}
