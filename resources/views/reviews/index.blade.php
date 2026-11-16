<x-layout title="Reviews">
    
    <section class="section">
        <div class="container stack gap-gutter" 
            data-controller="element filters" 
            data-element-hidden-class="visually-hidden" 
            data-action="slim-select:after-change->filters#submit 
                turbo:frame-render->filters#checkParams 
                filters:has-filters->element#show"
            >
            
            <form action="{{ route('reviews.index') }}" method="GET">
                <div class="stack gap-sm">
                    <div class="row justify-between">
                        <h2>Reviews</h2>
                        <div class="row gap-sm">
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
                                    <button @class(['menu-item', 'is-active' => request('sort') == '-score' ]) name="sort" value="-score" type="submit" role="menuitem">
                                        @icon('tabler-star')
                                        Score
                                    </button>
                                    <button @class(['menu-item', 'is-active' => request('sort') == '-created' || !request('sort') ]) name="sort" value="-created" type="submit" role="menuitem">
                                        @icon('tabler-clock')
                                        Recently Added
                                    </button>
                                </ui-menu>
                            </ui-popup>

                            <a class="btn bg-accent" href="{{ route('reviews.create') }}">Write a Review</a>
                        </div>
                    </div>

                    <div class="content visually-hidden" data-element-target="element">
                        <blockquote>
                            <div class="grid gap-sm full-width" style="--grid-min: 50ch;">
                                <x-forms.slim-select-filters label="Games" :options="$games" valueKey="title" contentKey="title" />
                                <x-forms.slim-select-filters label="Platforms" :options="$platforms"/>
                            </div>                    
                        </blockquote>
                    </div>

                    <button hidden id="apply-filters" type="submit" data-filters-target="button">Apply Filters</button>
                </div>
            </form>

            @if (count($reviews)>0)
                <div class="game-cards grid gap-md">
                    @foreach ($reviews as $review)
                        <x-cards.review-game-img :$review />
                    @endforeach
                </div>
                {{ $reviews->links() }}
            @else
                <div class="placeholder">
                    @icon('tabler-note', ['class' => 'placeholder__icon'])
                    <h4>No Reviews</h4>
                </div>
            @endif

        </div>
    </section>

</x-app-layout>