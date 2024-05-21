<?php

namespace App\Livewire\Reviews;

use Livewire\Component;
use App\Livewire\Forms\ReviewForm;
use App\Game;

class Create extends Component
{
    public $search = '';
    public ?Game $game;
    public ReviewForm $form;
    public $showOptions = false;

    public function getGames() 
    {
        return Game::with('platforms')->where('title', 'like', ("%{$this->search}%"))->limit(10)->get(['id', 'title']);
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

    public function save()
    {
        $this->form->validate();
        $review = $this->form->store();
        session()->flash('success', 'Review successfully created!');

        return redirect()->route('reviews.show', [$review]);
    }

    public function render()
    {
        $games = [];
        if (strlen($this->search)>=1) {
            $games = $this->getGames();
        }
        return view('livewire.reviews.create', compact('games'));
    }
}
