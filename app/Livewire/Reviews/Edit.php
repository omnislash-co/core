<?php

namespace App\Livewire\Reviews;

use Livewire\Component;
use App\Livewire\Forms\ReviewForm;
use App\Review;

class Edit extends Component
{
    public ReviewForm $form;

    public function mount(Review $review)
    {
        $this->form->review = $review;
        $this->form->gameId = $review->game->id;
        $this->form->platformId = $review->platform->id;
 
        $this->form->fill( 
            $review->only('body', 'summary', 'score'), 
        ); 
    }

    public function save()
    {
        $this->form->validate();
        $this->authorize('update', $this->form->review); 
        $this->form->update();

        session()->flash('success', 'Review successfully updated!');

        return redirect()->route('reviews.show', [$this->form->review]);
    }

    public function cancel()
    {
        return redirect()->route('reviews.show', [$this->form->review]);
    }

    public function render()
    {
        return view('livewire.reviews.edit');
    }
}
