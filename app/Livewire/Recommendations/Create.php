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
    public $showPlayedOptions = false;
    public $showOptions = false;

    public function getGames(String $search) 
    {
        return Game::with('platforms')->where('title', 'like', ("%{$search}%"))->limit(10)->get(['id', 'title']);
    }

    public function setPlayedGame(Game $game) 
    {
        $this->showPlayedOptions = false;
        $this->playedSearch = '';
        $this->playedGame = $game;
        $this->form->playedGameId = $game->id;
    }

    public function unsetPlayedGame() 
    {
        $this->form->playedGameId = null;
        $this->playedGame = null;
    }

    public function setGame(Game $game) 
    {
        $this->showOptions = false;
        $this->search = '';
        $this->game = $game;
        $this->form->platformId = null;
        $this->form->gameId = $game->id;
    }

    public function unsetGame() 
    {
        $this->form->platformId = null;
        $this->form->gameId = null;
        $this->game = null;
    }

    public function toggleOptions($status)
    {
        $this->showOptions = $status;
    }

    public function togglePlayedOptions($status)
    {
        $this->showPlayedOptions = $status;
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
            $games = $this->getGames($this->search);
        }
        if (strlen($this->playedSearch)>=1) {
            $playedGames = $this->getGames($this->playedSearch);
        }
        
        return view('livewire.recommendations.create', compact('games', 'playedGames'));
    }
}
