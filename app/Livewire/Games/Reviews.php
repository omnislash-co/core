<?php

namespace App\Livewire\Games;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Review;
use App\Game;

class Reviews extends Component
{
    use WithPagination;

    public Game $game;
    
    #[Computed] 
    public function reviews()
    {
        return Review::with('user')
            ->where('game_id', $this->game->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.games.reviews');
    }
}