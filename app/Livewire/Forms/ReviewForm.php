<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Review;

class ReviewForm extends Form
{
    public ?Review $review = null;
    public $gameId = null;
    public $platformId = null;
    public $body = '';
    public $summary = '';
    public $score = null;

    public function rules() 
    {
        return [
            'gameId' => 'required',
            'platformId' => [
                'required',
                'numeric',
                Rule::unique('reviews', 'platform_id')
                    ->where('game_id', $this->gameId)
                    ->where('user_id', Auth()->user()->id)->ignore($this->review)
            ],
            'body' => 'required|min:500',
            'summary' => 'required|min:50|max:255',
            'score' => 'required|numeric|between:0,100'
        ];
    }

    public function validationAttributes()
    {
        return [
            'body' => 'review',
            'gameId' => 'game',
            'platformId' => 'platform',
        ];
    }

    public function messages() 
    {
        return [
            'platformId.unique' => 'A review already exists for this platform.',
            'platformId.numeric' => 'The :attribute field is required.',
        ];
    }

    public function store()
    {
        return Review::create([
            'user_id' => Auth()->user()->id,
            'game_id' => $this->gameId,
            'platform_id' => $this->platformId,
            'summary' => $this->summary,
            'body' => $this->body,
            'score' => $this->score
        ]);
    }

    public function update()
    {
        $this->review?->update([
            'body' => $this->body,
            'summary' => $this->summary,
            'score' => $this->score,
        ]);
    }
}
