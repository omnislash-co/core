<?php

namespace App\Livewire\Games;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\LibraryForm;
use App\Game;
use App\PlayStatus;
use App\Library as LibraryModel;

class Library extends Component
{
    public Game $game;
    public LibraryForm $form;
    public $editMode = false;

    public function mount() {
        $this->form->gameId = $this->game->id;
    }

    #[Computed] 
    public function playStatuses()
    {
        return PlayStatus::all();
    }

    #[Computed] 
    public function libraries()
    {
        return LibraryModel::with('platform', 'playStatus')->where([
            'user_id' => Auth()->user()->id,
            'game_id' => $this->game->id 
        ])->get();
    }

    public function setEntry(int $id) 
    {
        $this->form->setEntry($id);
        $this->resetValidation();
        $this->form->entry ? $this->editMode = true : null;
    }

    public function resetForm() {
        $this->editMode = false;
        $this->form->resetForm();
    }

    public function save()
    {
        $this->form->validate();

        if($this->editMode) {
            $this->authorize('update', $this->form->entry); 
            $this->form->update();
            $this->resetForm();

            session()->flash('success', 'Entry successfully updated!');
        } else {
            $this->form->store();
            $this->resetForm();
            session()->flash('success', 'Entry successfully created!');
        }

        // return redirect()->route('games.show', [$this->game->slug]);
    }

    public function delete()
    {
        $this->authorize('delete', $this->form->entry); 
        $this->form->delete();
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.games.library');
    }
}
