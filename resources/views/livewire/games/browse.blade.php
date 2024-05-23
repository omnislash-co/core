<div class="stack gap-gutter">
    
    <div class="stack gap-sm" x-data="{ open: false }" x-init="{{ $this->hasFilters() }} ? open=true : '';">
        <div class="row gap-sm">
            <div class="input-container grow">
                @icon('tabler-search', ['class' => 'no-pointer'])
                <input type="text" placeholder="Search" wire:model.live.debounce="search">
            </div>

            <button class="btn btn--narrow bg-accent" @click="open = !open">
                @icon('tabler-filter')
                <span class="hide-md-down">
                    Filters
                </span>
            </button>

            <ui-popup placement="bottom-end">
                <button class="btn btn--narrow">
                    @icon('tabler-sort-descending')
                    <span class="hide-md-down">
                        Sort
                    </span>
                </button>
              
                <ui-menu class="menu" hidden>
                  <button @class(['menu-item', 'is-active' => $sort->name === 'POPULAR' ]) wire:click="setSort('POPULAR')" role="menuitem">
                    @icon('tabler-heart')
                    Popularity
                  </button>
                  <button @class(['menu-item', 'is-active' => $sort->name === 'SCORE' ]) wire:click="setSort('SCORE')" role="menuitem">
                    @icon('tabler-star')
                    Average Score
                  </button>
                  <button @class(['menu-item', 'is-active' => $sort->name === 'CREATED' ]) wire:click="setSort('CREATED')" role="menuitem">
                    @icon('tabler-clock')
                    Recently Added
                  </button>
                </ui-menu>
              </ui-popup>
        </div>

        <div 
            class="alert"
            x-cloak 
            x-transition 
            x-show="open">
            <div class="grid gap-sm full-width" style="--grid-min: 33ch;">
                <livewire:forms.multiselect :key="1" 
                    label="Developers" 
                    :options="$this->getDevelopers"
                    @update="updatQueryParams($event.detail.selected, 'developers')"
                     />
                <livewire:forms.multiselect :key="2" 
                    label="Genres" 
                    :options="$this->getGenres" 
                    @update="updatQueryParams($event.detail.selected, 'genres')" />
                <livewire:forms.multiselect :key="3" 
                    label="Platforms" 
                    :options="$this->getPlatforms" 
                    @update="updatQueryParams($event.detail.selected, 'platforms')" />
            </div>
        </div>
    </div>

    <div wire:loading.delay> 
        <x-waterhole::spinner class="spinner--block"/>
    </div>

    <div wire:loading.delay.class="visually-hidden" wire:key="{{ $this->games->count() }}">
        @if ($this->games->count() > 0)
            <div class="game-cards grid gap-md">
                @foreach ($this->games as $game)
                    <x-cards.game :$game wire:key="{{ $game->id }}" />
                @endforeach
            </div>
            <div style="margin-top: var(--space-md)">
                {{ $this->games->links() }}
            </div>
        @else
            <div class="alert bg-warning-soft">
                No games found.
            </div>
        @endif
    </div>
</div>