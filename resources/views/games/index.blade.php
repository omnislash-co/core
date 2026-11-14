<x-layout title="Games">
    
    <div class="section container" 
        data-controller="element game-filters" 
        data-element-hidden-class="hidden" 
        data-action="slim-select:after-change->game-filters#submit 
            turbo:frame-render->game-filters#checkParams 
            game-filters:has-filters->element#show"
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

                        <button class="btn btn--narrow" type="button" data-action="element#toggle">
                            @icon('tabler-filter')
                            <ui-tooltip>Filters</ui-tooltip>
                        </button>

                        <ui-popup placement="bottom-end">
                            <button class="btn btn--narrow">
                                @icon('tabler-sort-descending')
                                <ui-tooltip>Sort</ui-tooltip>
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
                            <hr class="menu-divider" />
                            <button @class(['menu-item', 'is-active' => request('sort') == 'release' ]) name="sort" value="release" type="submit" role="menuitem">
                                @icon('tabler-calendar')
                                Initial Release
                            </button>
                            <button @class(['menu-item', 'is-active' => request('sort') == 'title' ]) name="sort" value="title" type="submit" role="menuitem">
                                @icon('tabler-sort-a-z')
                                Title
                            </button>
                            </ui-menu>
                        </ui-popup>
                    </div>

                    <div class="content hidden" data-element-target="element">
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

</x-layout>