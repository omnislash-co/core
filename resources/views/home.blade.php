<x-app-layout title="Home">
    <section class="section">
        <div class="container stack gap-gutter">

            <section class="hero row gap-lg wrap justify-between">
                <div class="hero__welcome stack grow gap-sm">
                    <div class="oswald-stencil">
                        <div class="text-xxl">Welcome to</div>
                        <div class="color-accent" style="font-size: 4rem;">Omnislash!</div>
                    </div>
                    <div class="content">
                        <blockquote>Discover, track, review, recommend and discuss JRPG video games.</blockquote>
                    </div>
                </div>

                <div class="hero_icons row grow gap-md justify-center">
                    <div class="hero__icon card" style="transform: rotate(4deg); margin-top: 10px; margin-right: 3px">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-1.png') }}">
                    </div>
                    <div class="hero__icon card" style="transform: rotate(2deg);">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-2.png') }}">
                    </div>
                    <div class="hero__icon card" style="transform: rotate(-5deg); margin-top: 5px;">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-3.png') }}">
                    </div>
                </div>

                <div class="hero__stats row grow justify-center">
                    <div class="card bg-accent row gap-xl oswald-stencil" style="padding: var(--space-sm) var(--space-xl);">
                        <div class="stack align-center">
                            <div class="text-xl">{{ $gamesCount }} </div>
                            <div class="text-md">{{ Str::plural('Game', $gamesCount) }}</div>
                        </div>
                        <div class="stack align-center">
                            <div class="text-xl">{{ $usersCount }} </div>
                            <div class="text-md">{{ Str::plural('User', $usersCount) }}</div>
                        </div>
                        <div class="stack align-center">
                            <div class="text-xl">{{ $postsCount }} </div>
                            <div class="text-md">{{ Str::plural('Post', $postsCount) }}</div>
                        </div>
                    </div>
                </div>
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
                                    {{ $game->library_count ? $game->library_count : '0' }} {{ Str::plural('user', $game->library_count) }}
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
                        <div class="placeholder">
                            @icon('tabler-messages', ['class' => 'placeholder__icon'])
                            <h4>No Posts</h4>
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