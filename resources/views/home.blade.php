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

                <div class="hero__icons slide-in-icons row grow gap-md justify-center">
                    <div class="card" style="transform: rotate(4deg); margin-top: 10px; margin-right: 3px">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-vivi.png') }}">
                    </div>
                    <div class="card" style="transform: rotate(2deg);">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-2.png') }}">
                    </div>
                    <div class="card" style="transform: rotate(-5deg); margin-top: 5px;">
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
                <h2>Trending</h2>
            
                <div class="game-cards grid gap-md">
                    @foreach ($trending as $game)
                        <x-cards.game :$game />
                    @endforeach
                </div>
            </section>

            @if (count($userActivities) > 0)
                <section class="stack gap-md">
                    <h2>Recent User Activity</h2>

                    <div class="grid gap-md" style="--grid-min: 33ch">
                        @foreach ($userActivities as $activity)
                            <x-cards.user-activity :$activity />
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="row wrap align-start align-stretch gap-gutter">
                <div class="stack gap-md grow" style="flex-basis: 35ch">
                    <h2>Rankings</h2>
                    
                    <div class="card p-md stack gap-md" data-controller="tabs" data-tabs-default-tab-value="popular" data-tabs-active-class="is-active" data-tabs-hidden-class="hidden">
                        <nav aria-label="ranked-tabs">
                            <ul class="tabs" role="list">
                                <li>
                                    <a href="javascript:void(0)" role="button" class="tab" id="popular" data-tabs-target="tab" data-action="tabs#select">Most Popular</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" role="button" class="tab" id="ranked" data-tabs-target="tab" data-action="tabs#select">Top Ranked</a>
                                </li>
                            </ul>
                        </nav>

                        <ui-menu id="popular" data-tabs-target="panel">
                            @foreach ($popular as $game)
                                <div class="row">
                                    <div class="oswald-stencil color-accent p-xs text-center" style="width: 40px">
                                        {{ $loop->iteration }}
                                    </div>
                                    <a class="menu-item text-xs" href="{{ route('games.show', $game->slug) }}">
                                        <div class="full-width">
                                            <div class="menu-item__title">
                                                {{ $game->title }}
                                            </div>
                                            <div class="menu-item__description row justify-between">
                                                <div>
                                                    {{ $game->developers->pluck('name')->implode(', ') }} | {{ $game->initial_release_year }}
                                                </div>
                                                <div>
                                                    {{ $game->library_count ? $game->library_count : '0' }} {{ Str::plural('user', $game->library_count) }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </ui-menu>

                        <ui-menu id="ranked" data-tabs-target="panel" class="hidden">
                            @foreach ($topRanked as $game)
                                <div class="row">
                                    <div class="oswald-stencil color-accent p-xs text-center" style="width: 40px">
                                        {{ $loop->iteration }}
                                    </div>
                                    <a class="menu-item text-xs" href="{{ route('games.show', $game->slug) }}">
                                        <div class="full-width">
                                            <div class="menu-item__title">
                                                {{ $game->title }}
                                            </div>
                                            <div class="menu-item__description row justify-between">
                                                <div>
                                                    {{ $game->developers->pluck('name')->implode(', ') }} | {{ $game->initial_release_year }}
                                                </div>
                                                <div>
                                                    {{ $game->score ? round($game->score).'%' : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </ui-menu>
                    </div>
                </div>
                <div class="stack gap-md grow" style="flex-basis: 60ch">
                    <h2>Recent Community Posts</h2>

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
                    <h2>Recent Reviews</h2>

                    <div class="game-cards grid gap-md">
                        @foreach ($reviews as $review)
                            <x-cards.review-game-img :$review />
                        @endforeach
                    </div>
                </section>
            @endif

            @if (count($recommendations) > 0)
                <section class="stack gap-md">
                    <h2>Recent Recommendations</h2>

                    <div class="game-cards grid gap-md">
                        @foreach ($recommendations as $recommendation)
                            <x-cards.recommendation :$recommendation />
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </section>

</x-app-layout>