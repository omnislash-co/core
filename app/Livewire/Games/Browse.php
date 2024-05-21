<?php

namespace App\Livewire\Games;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Livewire\Forms\Multiselect;

use App\Game;
use App\Developer;
use App\Genre;
use App\Platform;

enum Sort: string
{
    case POPULAR = 'popularity_rank';
    case SCORE = 'score_rank';
    case CREATED = 'created_at';
}

class Browse extends Component
{
    use WithPagination;

    #[Url]
    public $developers = [];

    #[Url]
    public $genres = [];

    #[Url]
    public $platforms = [];

    public $search = '';
    
    public Sort $sort = Sort::CREATED;

    #[Computed] 
    public function games()
    {
        $builder = Game::with([
                'developers',
                'genres',
            ])
            ->where('title', 'like', ("%{$this->search}%"));

        if (is_array($this->developers) && count($this->developers) > 0 && $this->arrayIsNumeric($this->developers))
        {
            $builder = $builder->whereHas('developers', fn($q) => $q->whereIn('developers.id', $this->developers));
        }

        if (is_array($this->genres) && count($this->genres) > 0 && $this->arrayIsNumeric($this->genres))
        {
            $builder = $builder->whereHas('genres', fn($q) => $q->whereIn('genres.id', $this->genres));
        }

        if (is_array($this->platforms) && count($this->platforms) > 0 && $this->arrayIsNumeric($this->platforms))
        {
            $builder = $builder->whereHas('platforms', fn($q) => $q->whereIn('platforms.id', $this->platforms));
        }

        return $builder
            ->orderBy($this->sort->value, 'desc')
            ->paginate(8);
    }

    #[Computed] 
    public function getDevelopers()
    {
        return Developer::orderBy('name')->get(['id', 'name']);
    }

    #[Computed] 
    public function getGenres()
    {
        return Genre::orderBy('name')->get(['id', 'name']);
    }

    #[Computed] 
    public function getPlatforms()
    {
        return Platform::orderBy('name')->get(['id', 'name']);
    }

    public function updatQueryParams($value, $param)
    {
        $param === 'developers' ? $this->developers = $value : '';
        $param === 'genres' ? $this->genres = $value : '';
        $param === 'platforms' ? $this->platforms = $value : '';

        $this->resetPage();
    }

    public function setSort(String $value)
    {
        $sort = null;

        switch ($value) {
            case Sort::CREATED->name:
                $sort = Sort::CREATED;
                break;
            case Sort::SCORE->name:
                $sort = Sort::SCORE;
                break;
            default:
                $sort = Sort::POPULAR;
        }

        $this->sort = $sort;
    }

    public function arrayIsNumeric($array) 
    {
        foreach($array as $value) {
             if (!is_numeric($value)) {
                  return false;
             } 
        }
        return true;
    }

    public function hasFilters()
    {
        $status = false;

        count($this->developers) > 0 ? $status = true : '';
        count($this->genres) > 0 ? $status = true : '';
        count($this->platforms) > 0 ? $status = true : '';

        return $status;
    }

    public function clearFilters()
    {
        $this->dispatch('clear-selected')->to(Multiselect::class);
    }

    public function render()
    {
        return view('livewire.games.browse');
    }

    public function updated()
    {
        $this->resetPage();
    }
}
