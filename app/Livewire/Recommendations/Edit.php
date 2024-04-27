<?php

namespace App\Livewire\Recommendations;

use Livewire\Component;
use App\Recommendation;
use App\Livewire\Forms\RecommendationForm;

class Edit extends Component
{
    public RecommendationForm $form;

    public function mount(Recommendation $recommendation)
    {
        $this->form->recommendation = $recommendation;
        $this->form->playedGameId = $recommendation->playedGame->id;
        $this->form->gameId = $recommendation->game->id;
        $this->form->platformId = $recommendation->platform->id;

        $this->form->fill( 
            $recommendation->only('body'), 
        ); 
    }

    public function save()
    {
        $this->form->validate();
        $this->authorize('update', $this->form->recommendation);
        $this->form->update();

        session()->flash('success', 'Recommendation successfully updated!');

        return redirect()->route('recommendations.show', [$this->form->recommendation]);
    }

    public function cancel()
    {
        return redirect()->route('recommendations.show', [$this->form->recommendation]);
    }

    public function render()
    {
        return view('livewire.recommendations.edit');
    }
}
