<?php

namespace App\Livewire\Recommendations;

use Livewire\Component;
use App\Game;
use App\Livewire\Forms\RecommendationForm;

class Create extends Component
{
    public $search = '';
    public $playedSearch = '';
    public ?Game $playedGame;
    public ?Game $game;
    public RecommendationForm $form;

    public function getGames() {
        return Game::with('platforms')->where('title', 'like', ("%{$this->search}%"))->limit(7)->get(['id', 'title']);
    }

    public function setPlayedGame(Game $game) {
        $this->playedSearch = '';
        $this->playedGame = $game;
        $this->form->playedGameId = $game->id;
    }

    public function unsetPlayedGame() {
        $this->form->playedGameId = null;
        $this->playedGame = null;
    }

    public function setGame(Game $game) {
        $this->search = '';
        $this->game = $game;
        $this->form->platformId = null;
        $this->form->gameId = $game->id;
    }

    public function unsetGame() {
        $this->form->platformId = null;
        $this->form->gameId = null;
        $this->game = null;
    }

    public function save()
    {
        $this->form->validate();
        $recommendation = $this->form->store();
        session()->flash('success', 'Recommendation successfully created!');

        return redirect()->route('recommendations.show', [$recommendation]);
    }

    public function render()
    {
        $games = [];
        $playedGames = [];

        if (strlen($this->search)>=1) {
            $games = $this->getGames();
        }
        if (strlen($this->playedSearch)>=1) {
            $playedGames = $this->getGames();
        }
        
        return view('livewire.recommendations.create', compact('games', 'playedGames'));
    }
}
