<x-app-layout title="Home">
    <div class="game-cover" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ Storage::url('images/layout/cover.png') }});">
    </div>

    <div class="wave-container">
        <svg class="wave" viewBox="0 0 1000 200" preserveAspectRatio="none" style="width: 100%; height: 100%;">
            <path
            d="M0,200 L0.0,100.0 C 6.3,103.3 18.8,109.8 25.0,113.1 C 31.3,116.2 43.8,122.3 50.0,125.4 C 56.3,128.1 68.8,133.4 75.0,136.1 C 81.3,138.2 93.8,142.5 100.0,144.6 C 106.3,146.0 118.8,148.9 125.0,150.3 C 131.3,151.0 143.8,152.3 150.0,152.9 C 156.3,152.7 168.8,152.4 175.0,152.2 C 181.3,151.2 193.8,149.2 200.0,148.2 C 206.3,146.4 218.8,142.9 225.0,141.2 C 231.3,138.8 243.8,134.1 250.0,131.7 C 256.3,128.8 268.8,123.1 275.0,120.2 C 281.3,117.0 293.8,110.7 300.0,107.5 C 306.3,104.2 318.8,97.6 325.0,94.3 C 331.3,91.1 343.8,84.6 350.0,81.4 C 356.3,78.5 368.8,72.6 375.0,69.7 C 381.3,67.3 393.8,62.4 400.0,59.9 C 406.3,58.1 418.8,54.4 425.0,52.6 C 431.3,51.5 443.8,49.3 450.0,48.2 C 456.3,47.9 468.8,47.3 475.0,47.0 C 481.3,47.5 493.8,48.7 500.0,49.2 C 506.3,50.5 518.8,53.2 525.0,54.5 C 531.3,56.5 543.8,60.6 550.0,62.6 C 556.3,65.2 568.8,70.5 575.0,73.1 C 581.3,76.1 593.8,82.2 600.0,85.2 C 606.3,88.5 618.8,95.0 625.0,98.2 C 631.3,101.5 643.8,108.1 650.0,111.4 C 656.3,114.5 668.8,120.8 675.0,123.9 C 681.3,126.6 693.8,132.1 700.0,134.8 C 706.3,137.0 718.8,141.4 725.0,143.6 C 731.3,145.1 743.8,148.2 750.0,149.7 C 756.3,150.4 768.8,151.9 775.0,152.7 C 781.3,152.6 793.8,152.5 800.0,152.4 C 806.3,151.5 818.8,149.8 825.0,148.9 C 831.3,147.3 843.8,144.0 850.0,142.3 C 856.3,140.0 868.8,135.4 875.0,133.1 C 881.3,130.3 893.8,124.6 900.0,121.8 C 906.3,118.7 918.8,112.3 925.0,109.2 C 931.3,105.9 943.8,99.3 950.0,96.0 C 956.3,92.8 968.8,86.3 975.0,83.1 C 981.3,80.1 993.8,74.2 1000.0,71.2 C 1006.3,68.7 1018.8,63.6 1025.0,61.1 L1000.0,200.0 L0,200.0Z"
            >
                <animate
                attributeName="d"
                dur="9.0s"
                repeatCount="indefinite"
                values="M0,200 L0.0,100.0 C 6.3,103.3 18.8,109.8 25.0,113.1 C 31.3,116.2 43.8,122.3 50.0,125.4 C 56.3,128.1 68.8,133.4 75.0,136.1 C 81.3,138.2 93.8,142.5 100.0,144.6 C 106.3,146.0 118.8,148.9 125.0,150.3 C 131.3,151.0 143.8,152.3 150.0,152.9 C 156.3,152.7 168.8,152.4 175.0,152.2 C 181.3,151.2 193.8,149.2 200.0,148.2 C 206.3,146.4 218.8,142.9 225.0,141.2 C 231.3,138.8 243.8,134.1 250.0,131.7 C 256.3,128.8 268.8,123.1 275.0,120.2 C 281.3,117.0 293.8,110.7 300.0,107.5 C 306.3,104.2 318.8,97.6 325.0,94.3 C 331.3,91.1 343.8,84.6 350.0,81.4 C 356.3,78.5 368.8,72.6 375.0,69.7 C 381.3,67.3 393.8,62.4 400.0,59.9 C 406.3,58.1 418.8,54.4 425.0,52.6 C 431.3,51.5 443.8,49.3 450.0,48.2 C 456.3,47.9 468.8,47.3 475.0,47.0 C 481.3,47.5 493.8,48.7 500.0,49.2 C 506.3,50.5 518.8,53.2 525.0,54.5 C 531.3,56.5 543.8,60.6 550.0,62.6 C 556.3,65.2 568.8,70.5 575.0,73.1 C 581.3,76.1 593.8,82.2 600.0,85.2 C 606.3,88.5 618.8,95.0 625.0,98.2 C 631.3,101.5 643.8,108.1 650.0,111.4 C 656.3,114.5 668.8,120.8 675.0,123.9 C 681.3,126.6 693.8,132.1 700.0,134.8 C 706.3,137.0 718.8,141.4 725.0,143.6 C 731.3,145.1 743.8,148.2 750.0,149.7 C 756.3,150.4 768.8,151.9 775.0,152.7 C 781.3,152.6 793.8,152.5 800.0,152.4 C 806.3,151.5 818.8,149.8 825.0,148.9 C 831.3,147.3 843.8,144.0 850.0,142.3 C 856.3,140.0 868.8,135.4 875.0,133.1 C 881.3,130.3 893.8,124.6 900.0,121.8 C 906.3,118.7 918.8,112.3 925.0,109.2 C 931.3,105.9 943.8,99.3 950.0,96.0 C 956.3,92.8 968.8,86.3 975.0,83.1 C 981.3,80.1 993.8,74.2 1000.0,71.2 C 1006.3,68.7 1018.8,63.6 1025.0,61.1 L1000.0,200.0 L0,200.0Z;
            M0,200 L0.0,100.0 C 6.3,96.7 18.8,90.2 25.0,86.9 C 31.3,83.8 43.8,77.7 50.0,74.6 C 56.3,71.9 68.8,66.6 75.0,63.9 C 81.3,61.8 93.8,57.5 100.0,55.4 C 106.3,54.0 118.8,51.1 125.0,49.7 C 131.3,49.1 143.8,47.8 150.0,47.1 C 156.3,47.3 168.8,47.6 175.0,47.8 C 181.3,48.8 193.8,50.8 200.0,51.8 C 206.3,53.5 218.8,57.0 225.0,58.8 C 231.3,61.2 243.8,65.9 250.0,68.3 C 256.3,71.2 268.8,76.9 275.0,79.8 C 281.3,83.0 293.8,89.3 300.0,92.5 C 306.3,95.8 318.8,102.4 325.0,105.7 C 331.3,108.9 343.8,115.4 350.0,118.6 C 356.3,121.5 368.8,127.4 375.0,130.3 C 381.3,132.8 393.8,137.7 400.0,140.1 C 406.3,141.9 418.8,145.6 425.0,147.4 C 431.3,148.5 443.8,150.7 450.0,151.8 C 456.3,152.1 468.8,152.7 475.0,153.0 C 481.3,152.4 493.8,151.4 500.0,150.8 C 506.3,149.5 518.8,146.8 525.0,145.5 C 531.3,143.5 543.8,139.4 550.0,137.4 C 556.3,134.8 568.8,129.5 575.0,126.9 C 581.3,123.9 593.8,117.8 600.0,114.8 C 606.3,111.5 618.8,105.0 625.0,101.8 C 631.3,98.5 643.8,91.9 650.0,88.6 C 656.3,85.5 668.8,79.2 675.0,76.1 C 681.3,73.4 693.8,67.9 700.0,65.2 C 706.3,63.0 718.8,58.6 725.0,56.4 C 731.3,54.9 743.8,51.8 750.0,50.3 C 756.3,49.5 768.8,48.0 775.0,47.3 C 781.3,47.4 793.8,47.5 800.0,47.6 C 806.3,48.5 818.8,50.2 825.0,51.1 C 831.3,52.8 843.8,56.1 850.0,57.7 C 856.3,60.0 868.8,64.6 875.0,66.9 C 881.3,69.7 893.8,75.4 900.0,78.2 C 906.3,81.3 918.8,87.7 925.0,90.8 C 931.3,94.1 943.8,100.7 950.0,104.0 C 956.3,107.2 968.8,113.7 975.0,116.9 C 981.3,119.9 993.8,125.8 1000.0,128.8 C 1006.3,131.3 1018.8,136.4 1025.0,138.9 L1000.0,200.0 L0,200.0Z;
            M0,200 L0.0,100.0 C 6.3,103.3 18.8,109.8 25.0,113.1 C 31.3,116.2 43.8,122.3 50.0,125.4 C 56.3,128.1 68.8,133.4 75.0,136.1 C 81.3,138.2 93.8,142.5 100.0,144.6 C 106.3,146.0 118.8,148.9 125.0,150.3 C 131.3,151.0 143.8,152.3 150.0,152.9 C 156.3,152.7 168.8,152.4 175.0,152.2 C 181.3,151.2 193.8,149.2 200.0,148.2 C 206.3,146.4 218.8,142.9 225.0,141.2 C 231.3,138.8 243.8,134.1 250.0,131.7 C 256.3,128.8 268.8,123.1 275.0,120.2 C 281.3,117.0 293.8,110.7 300.0,107.5 C 306.3,104.2 318.8,97.6 325.0,94.3 C 331.3,91.1 343.8,84.6 350.0,81.4 C 356.3,78.5 368.8,72.6 375.0,69.7 C 381.3,67.3 393.8,62.4 400.0,59.9 C 406.3,58.1 418.8,54.4 425.0,52.6 C 431.3,51.5 443.8,49.3 450.0,48.2 C 456.3,47.9 468.8,47.3 475.0,47.0 C 481.3,47.5 493.8,48.7 500.0,49.2 C 506.3,50.5 518.8,53.2 525.0,54.5 C 531.3,56.5 543.8,60.6 550.0,62.6 C 556.3,65.2 568.8,70.5 575.0,73.1 C 581.3,76.1 593.8,82.2 600.0,85.2 C 606.3,88.5 618.8,95.0 625.0,98.2 C 631.3,101.5 643.8,108.1 650.0,111.4 C 656.3,114.5 668.8,120.8 675.0,123.9 C 681.3,126.6 693.8,132.1 700.0,134.8 C 706.3,137.0 718.8,141.4 725.0,143.6 C 731.3,145.1 743.8,148.2 750.0,149.7 C 756.3,150.4 768.8,151.9 775.0,152.7 C 781.3,152.6 793.8,152.5 800.0,152.4 C 806.3,151.5 818.8,149.8 825.0,148.9 C 831.3,147.3 843.8,144.0 850.0,142.3 C 856.3,140.0 868.8,135.4 875.0,133.1 C 881.3,130.3 893.8,124.6 900.0,121.8 C 906.3,118.7 918.8,112.3 925.0,109.2 C 931.3,105.9 943.8,99.3 950.0,96.0 C 956.3,92.8 968.8,86.3 975.0,83.1 C 981.3,80.1 993.8,74.2 1000.0,71.2 C 1006.3,68.7 1018.8,63.6 1025.0,61.1 L1000.0,200.0 L0,200.0Z"
                />
            </path>
        </svg>
    </div>

    <section class="section" style="margin-top: -125px">
        <div class="container stack gap-gutter">

            <section class="hero row gap-lg wrap justify-between">
                <div class="hero__welcome stack grow gap-sm">
                    <div class="oswald-stencil">
                        <div class="text-xxl" style="color: var(--palette-emphasis-contrast)">Welcome to</div>
                        <div class="color-accent" style="font-size: 4rem;">Omnislash!</div>
                    </div>
                    <div class="content">
                        <blockquote>Discover, track, review, recommend and discuss JRPG video games.</blockquote>
                    </div>
                </div>

                <div class="hero__icons slide-in-icons row grow gap-md justify-center">
                    <div class="card" style="transform: rotate(4deg); margin-top: 10px; margin-right: 3px">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-dq8.png') }}">
                    </div>
                    <div class="card" style="transform: rotate(2deg);">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-vivi.png') }}">
                    </div>
                    <div class="card" style="transform: rotate(-5deg); margin-top: 5px;">
                        <img height="125px" src="{{ Storage::url('images/layout/hero-icon-rosalinde.png') }}">
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
                                    <a href="javascript:void(0)" role="button" class="tab" id="popular" data-tabs-target="tab" data-action="tabs#select">Popularity</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" role="button" class="tab" id="ranked" data-tabs-target="tab" data-action="tabs#select">Average Score</a>
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
                                                <div class="weight-medium">
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
                                                <div class="weight-medium">
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