<x-layout title="Recommendations">
    
    <section class="section">
        <div class="container stack gap-gutter" 
            data-controller="element filters" 
            data-element-hidden-class="visually-hidden" 
            data-action="slim-select:after-change->filters#submit 
                turbo:frame-render->filters#checkParams 
                filters:has-filters->element#show"
            >
            
            <form action="{{ route('recommendations.index') }}" method="GET">
                <div class="stack gap-sm">
                    <div class="row justify-between">
                        <h2>Recommendations</h2>
                        <div class="row gap-sm">
                            <button class="btn btn--narrow" type="button" data-action="element#toggle">
                                @icon('tabler-filter')
                                <ui-tooltip>Filters</ui-tooltip>
                            </button>
{{-- 
                            <ui-popup placement="bottom-end">
                                <button class="btn btn--narrow">
                                    @icon('tabler-sort-descending')
                                    <ui-tooltip>Sort</ui-tooltip>
                                </button>
                            
                                <ui-menu class="menu" hidden>
                                    <button @class(['menu-item', 'is-active' => request('sort') == '-created' || !request('sort') ]) name="sort" value="-created" type="submit" role="menuitem">
                                        @icon('tabler-clock')
                                        Recently Added
                                    </button>
                                </ui-menu>
                            </ui-popup> --}}

                            <a class="btn bg-accent" href="{{ route('recommendations.create') }}">Write a Recommendation</a>
                        </div>
                    </div>

                    <div class="content visually-hidden" data-element-target="element">
                        <blockquote>
                            <div class="grid gap-sm full-width" style="--grid-min: 50ch;">
                                <x-forms.slim-select-filters label="Games" :options="$games" valueKey="title" contentKey="title" />
                            </div>                    
                        </blockquote>
                    </div>

                    <button hidden id="apply-filters" type="submit" data-filters-target="button">Apply Filters</button>
                </div>
            </form>

            @if (count($recommendations)>0)
                <div class="game-cards grid gap-md">
                    @foreach ($recommendations as $recommendation)
                        <x-cards.recommendation :$recommendation />
                    @endforeach
                </div>
                {{ $recommendations->links() }}
            @else
                <div class="placeholder">
                    @icon('tabler-thumb-up', ['class' => 'placeholder__icon'])
                    <h4>No Recommendations</h4>
                </div>
            @endif

        </div>
    </section>

</x-app-layout>