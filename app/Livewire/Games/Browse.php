<?php

namespace App\Livewire\Games;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

use App\Game;

class Browse extends Component
{
    use WithPagination;

    public $search = '';
    // public $filters = [];

    #[Computed] 
    public function games()
    {
        return Game::with([
                'developers',
                'genres',
            ])
            ->where('title', 'like', ("%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.games.browse');
    }

    public function updated()
    {
        $this->resetPage();
    }
}
