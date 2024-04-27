<x-app-layout title="Home">
    <section @class(['section', 'bg-character2' ])>
        <div class="container stack gap-gutter">

            <section class="hero row gap-xl wrap">
                <div class="hero__welcome grow stack gap-sm">
                    <h1 class="color-accent">Welcome to Omnislash!</h1>
                    <p>Discover, track, review, recommend and discuss JRPG style video games.</p>
                </div>
            
                <aside class="hero__statistics grow row gap-lg justify-center ">
                    <div class="badge bg-accent text-xs">
                        @icon('gameicon-shard-sword')
                        {{ $gamesCount }} {{ Str::plural('Game', $gamesCount) }}
                    </div>
                    <div class="badge bg-accent text-xs">
                        @icon('tabler-user')
                        {{ $usersCount }} {{ Str::plural('User', $usersCount) }}
                    </div>
                    <div class="badge bg-accent text-xs">
                        @icon('tabler-message')
                        {{ $postsCount }} {{ Str::plural('Post', $postsCount) }}
                    </div>
                </aside>
            </section>

            <section class="stack gap-md">
                <h3>Trending</h3>
            
                <div class="game-cards grid gap-sm">
                    @foreach ($trending as $game)
                        <x-cards.game :$game />
                    @endforeach
                </div>
            </section>

            @if (count($userActivities) > 0)
                <section class="stack gap-md">
                    <h3>Recent User Activity</h3>

                    <div class="grid gap-md" style="--grid-min: 33ch">
                        @foreach ($userActivities as $activity)
                            <x-cards.user-activity :$activity />
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="row wrap align-start align-stretch gap-gutter">
                <div class="stack gap-md grow" style="flex-basis: var(--sidebar-width)">
                    <h3>Most Popular</h3>

                    <ui-menu class="card text-xs p-xs">
                        @foreach ($popular as $game)
                            <a class="menu-item" href="{{ route('games.show', $game->slug) }}">
                                <span>
                                    <span class="menu-item__title">{{ $game->popularity_rank }}. {{ $game->title }}</span>
                                    <span class="menu-item__description">{{ $game->developers->pluck('name')->implode(', ') }} | {{ $game->initial_release_year }}</span>
                                </span>
                                <ui-tooltip>
                                    {{ $game->library_count }} {{ $game->library_count===1 ? 'user' : 'users' }}
                                </ui-tooltip>
                            </a>
                        @endforeach
                    </ui-menu>
                </div>
                <div class="stack gap-md grow" style="flex-basis: var(--sidebar-width)">
                    <h3>Top Ranked</h3>

                    <ui-menu class="card text-xs p-xs">
                        @foreach ($topRanked as $game)
                            <a class="menu-item" href="{{ route('games.show', $game->slug) }}">
                                <span>
                                    <span class="menu-item__title">{{ $game->score_rank }}. {{ $game->title }}</span>
                                    <span class="menu-item__description">{{ $game->developers->pluck('name')->implode(', ') }} | {{ $game->initial_release_year }}</span>
                                </span>
                                <ui-tooltip>
                                    {{ $game->score ? round($game->score).'%' : 'N/A' }}
                                </ui-tooltip>
                            </a>
                        @endforeach
                    </ui-menu>
                </div>
                <div class="stack gap-md grow" style="flex-basis: calc(3ch + 2 * var(--sidebar-width))">
                    <h3>Recent Community Posts</h3>

                    @if (count($posts) > 0)
                        <div class="card">
                            @foreach ($posts as $post)
                                <x-waterhole::post-list-item :post="$post" />
                            @endforeach
                        </div>
                    @else
                        <div class="alert bg-warning-soft">
                            No posts have been made.
                        </div>
                    @endif
                    @if (count($posts) == 3)
                        <a class="btn" href="{{ route('waterhole.home') }}">
                            View More
                        </a>
                    @endif
                </div>
            </section>

            @if (count($reviews) > 0)
                <section class="stack gap-md">
                    <h3>Recent Reviews</h3>

                    <div class="game-cards grid gap-sm">
                        @foreach ($reviews as $review)
                            <x-cards.review-game-img :$review />
                        @endforeach
                    </div>
                </section>
            @endif

            @if (count($recommendations) > 0)
                <section class="stack gap-md">
                    <h3>Recent Recommendations</h3>

                    <div class="game-cards grid gap-sm">
                        @foreach ($recommendations as $recommendation)
                            <x-cards.recommendation :$recommendation />
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </section>

</x-app-layout>