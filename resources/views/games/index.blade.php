<x-app-layout title="Games">
    
    <div class="section container" 
        data-controller="game-filters" 
        data-game-filters-hidden-class="hidden" 
        data-action="slim-select:after-change->game-filters#submit turbo:frame-render->game-filters#checkParams"
        >
        <div class="stack gap-gutter">
            <h2>Games</h2>

            <form action="{{ route('games.index') }}" method="GET">
                <div class="stack gap-sm">
                    <div class="row gap-sm">
                        <div class="input-container grow">
                            @icon('tabler-search', ['class' => 'no-pointer'])
                            <input type="text" name="filter[title]" value="{{ request('filter.title') }}" placeholder="Search">
                            <span>
                                <button class="btn btn--icon btn--sm btn--transparent" type="submit">
                                    @icon('tabler-arrow-right')
                                </button>
                            </span>
                        </div>

                        <button class="btn btn--narrow bg-accent" type="button" data-action="game-filters#toggle">
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
                            <button @class(['menu-item', 'is-active' => request('sort') == 'popular' ]) name="sort" value="popular" type="submit" role="menuitem">
                                @icon('tabler-heart')
                                Popularity
                            </button>
                            <button @class(['menu-item', 'is-active' => request('sort') == 'score' ]) name="sort" value="score" type="submit" role="menuitem">
                                @icon('tabler-star')
                                Average Score
                            </button>
                            <button @class(['menu-item', 'is-active' => request('sort') == '-created' || !request('sort') ]) name="sort" value="-created" type="submit" role="menuitem">
                                @icon('tabler-clock')
                                Recently Added
                            </button>
                            </ui-menu>
                        </ui-popup>
                    </div>

                    <div class="content hidden" data-game-filters-target="panel">
                        <blockquote>
                            <div class="grid gap-sm full-width" style="--grid-min: 25ch;">
                                <x-forms.slim-select-filters label="Developers" :options="$developers"/>
                                <x-forms.slim-select-filters label="Genres" :options="$genres"/>
                                <x-forms.slim-select-filters label="Platforms" :options="$platforms"/>
                                <x-forms.slim-select-filters label="Series" :options="$series"/>
                            </div>                    
                        </blockquote>
                    </div>

                    <button hidden id="apply-filters" type="submit" data-game-filters-target="button">Apply Filters</button>
                </div>
            </form>

            <div class="stack gap-gutter">
                @if ($games->count() > 0)
                    <div class="game-cards grid gap-md">
                        @foreach ($games as $game)
                            <x-cards.game :$game />
                        @endforeach
                    </div>
                    <div style="margin-top: var(--space-md)">
                        {{ $games->links() }}
                    </div>
                @else
                    <div class="alert bg-warning-soft">
                        No games found.
                    </div>
                @endif                
            </div>
        </div>
    </div>

</x-app-layout>