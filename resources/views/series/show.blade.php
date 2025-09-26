<x-app-layout title="{{ $series->name }} Series">

    <div class="section container">
        <section class="stack gap-gutter">
            <div class="row justify-between">
                <h2>{{ $series->name }}</h2>
                <a class="btn bg-accent" href="{{ route('series.index') }}">View All Series</a>
            </div>

            <section class="with-sidebar">
                <nav class="sidebar stack gap-gutter">
                    <div class="card p-md stack gap-xs">
                        <div>
                            <h3 class="nav-heading">Sidebar content</h3>
                        </div>
                    </div>                    
                </nav>

                <div>
                    <div class="card p-sm text-xs">
                        <div class="row">
                            <div class="p-sm weight-bold" style="flex: 5">Title</div>
                            <div class="p-sm weight-bold text-center" style="flex: 1">Score Rank</div>
                            <div class="p-sm weight-bold text-center" style="flex: 1">Popularity</div>
                        </div>
                        @foreach ($games as $game)
                            <div class="row align-center list-entry tooltip-container">
                                <img class="tooltip-icon game-icon" src="{{ Storage::url('games/icons/'.$game->icon) }}">
                                <div class="stack grow gap-xs p-sm" style="flex: 5">
                                    <a class="h4 color-accent" href="{{ route('games.show', $game->slug) }}">{{ $game->title }}</a>
                                    <div class="row wrap gap-xxs">
                                        @foreach ($game->developers as $developer)
                                            <span class="badge">
                                                {{ $developer->name }}
                                            </span>
                                        @endforeach
                                        <span class="badge">
                                            @icon('tabler-calendar-filled')
                                            {{ $game->initial_release_year }}
                                        </span>
                                        @foreach ($game->genres as $genre)
                                            <span class="badge">
                                                @icon('tabler-tag')
                                                {{ $genre->acronym }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="p-sm text-center" style="flex: 1">{{ $game->score_rank }}</div>
                                <div class="p-sm text-center" style="flex: 1">{{ $game->popularity_rank }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </section>
    </div>

</x-app-layout>