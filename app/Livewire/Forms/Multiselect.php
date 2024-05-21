<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Multiselect extends Component
{
    #[Locked]
    public Collection $options;

    #[Url(history: true, keep: true)]
    public $selected = [];

    public string $label;

    public $search = '';

    public $showOptions = false;

    protected function queryString()
    {
        return [
            'selected' => [
                'as' => strtolower($this->label),
            ],
        ];
    }

    #[Computed] 
    public function filtered()
    {
        $filtered = $this->options;

        if ($this->search) 
        {
            $filtered = $filtered->filter(function ($option) {
                return Str::contains(Str::lower($option->name), Str::lower($this->search));
            });
        }

        return $filtered;
    }

    public function toggleOptions($status)
    {
        $this->showOptions = $status;
    }

    public function getOptionName($id)
    {
        $option = $this->options->first(function ($option) use($id) {
            return $option->id == $id;
        });

        return $option->name;
    }

    public function isSelected($id)
    {        
        return collect($this->selected)->contains($id);
    }

    public function add($id)
    {
        if ($this->isSelected($id))
        {
            $this->remove($id);
        } 
        else 
        {
            $this->selected[] = $id;
            $this->dispatch('update', selected: $this->selected);
        }

    }

    public function remove($id)
    {
        $selected = collect($this->selected);
        $selected = $selected->reject($id);
        $this->selected = $selected->all();

        $this->dispatch('update', selected: $this->selected);
    }

    #[On('clear-selected')] 
    public function clearSelected()
    {
        $this->selected = [];
        $this->dispatch('update', selected: $this->selected);
    }

    public function render()
    {
        return view('livewire.forms.multiselect');
    }
}
