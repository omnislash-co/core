<?php

namespace App\Livewire\Games;

use Livewire\Component;
use App\Game;
use App\User;
use Livewire\Attributes\Locked;

class Favourite extends Component
{
    public Game $game;
    
    #[Locked]
    public $status = false;

    public function mount()
    {
        if (Auth()->user()) {
            $this->status = User::find(Auth()->user()->id)->hasFavorited($this->game);
        }
    }

    public function toggle() {
        if (Auth()->user()) {
            User::find(Auth()->user()->id)->toggleFavorite($this->game);
            $this->status = !$this->status;
        } else {
            return redirect()->route('waterhole.login');
        }
    }

    public function render()
    {
        return view('livewire.games.favourite');
    }
}
