<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\Rule;
use Livewire\Form;
use App\Library as LibraryModel;

class LibraryForm extends Form
{
    public ?LibraryModel $entry = null;

    public $gameId;
    public $platformId;
    public $playStatusId;
    public $score;
    public $hours;
    public $notes;

    public function rules() 
    {
        return [
            'gameId' => 'required|numeric',
            'platformId' => [
                'required',
                'numeric',
                Rule::unique('libraries', 'platform_id')
                    ->where('game_id', $this->gameId)
                    ->where('user_id', Auth()->user()->id)->ignore($this->entry)
            ],
            'playStatusId' => 'required|numeric',
            'score' => 'nullable|numeric|between:0,10',
            'hours' => 'nullable|numeric|min:0',
            'notes' => 'max:255',
        ];
    }

    public function validationAttributes()
    {
        return [
            'gameId' => 'game',
            'platformId' => 'platform',
            'playStatusId' => 'play status',
        ];
    }

    public function messages() 
    {
        return [
            'platformId.unique' => 'A entry already exists for this platform.',
            'platformId.numeric' => 'The :attribute field is required.',
        ];
    }

    public function setEntry(int $id)
    {
        $this->entry = LibraryModel::find($id);

        $this->platformId = $this->entry?->platform?->id;
        $this->playStatusId = $this->entry?->playStatus?->id;
        $this->score = $this->entry?->score;
        $this->hours = $this->entry?->hours;
        $this->notes = $this->entry?->notes;
    }

    public function resetForm()
    {
        $this->reset('entry', 'platformId', 'playStatusId', 'score', 'hours', 'notes');
        $this->resetValidation();
    }

    public function store() 
    {
        return LibraryModel::create([
            'user_id' => Auth()->user()->id,
            'game_id' => $this->gameId,
            'platform_id' => $this->platformId,
            'play_status_id' => $this->playStatusId,
            'score' => $this->score,
            'hours' => $this->hours,
            'notes' => $this->notes,
        ]);
    }

    public function update()
    {
        $this->entry?->update([
            'platform_id' => $this->platformId,
            'play_status_id' => $this->playStatusId,
            'score' => $this->score,
            'hours' => $this->hours,
            'notes' => $this->notes,
        ]);
    }

    public function delete()
    {
        $this->entry?->delete();
    }
}
