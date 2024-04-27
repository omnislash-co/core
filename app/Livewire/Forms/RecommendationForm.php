<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Validation\Rule;
use App\Recommendation;

class RecommendationForm extends Form
{
    public ?Recommendation $recommendation = null;
    public $playedGameId = null;
    public $gameId = null;
    public $platformId = null;
    public $body = '';

    public function rules() 
    {
        return [
            'playedGameId' => 'required',
            'gameId' => [
                'required',
                'different:playedGameId',
                Rule::unique('recommendations', 'game_id')
                    ->where('played_game_id', $this->playedGameId)
                    ->where('user_id', Auth()->user()->id)->ignore($this->recommendation)
            ],
            'platformId' => 'required|numeric',
            'body' => 'required|min:500',
        ];
    }

    public function validationAttributes() 
    {
        return [
            'body' => 'recommendation',
            'playedGameId' => 'played game',
            'gameId' => 'game',
            'platformId' => 'platform',
        ];
    }

    public function messages() 
    {
        return [
            'gameId.different' => 'The games must be different.',
            'gameId.unique' => 'A recommendation already exists for this game.',
            'platformId.numeric' => 'The :attribute field is required.',
            'playedGameId.required' => 'The game field is required.',
        ];
    }

    public function store()
    {
        return Recommendation::create([
            'user_id' => Auth()->user()->id,
            'played_game_id' => $this->playedGameId,
            'game_id' => $this->gameId,
            'platform_id' => $this->platformId,
            'body' => $this->body,
        ]);
    }

    public function update()
    {
        $this->recommendation?->update([
            'body' => $this->body,
        ]);
    }
}
