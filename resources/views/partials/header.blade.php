@php
    $quotes = array(
        // "Because, you are... a puppet.", // FF7
        "This guy are sick.", // FF7
        "Listen to my story. This... may be our last chance.", // FFX
    );
    $key = array_rand($quotes);
    $randomQuote = $quotes[$key];
@endphp

<header class="navigation" role="banner">
    <div class="container row gap-xl" style="min-height: 130px">
        <x-logo />

        <a href="{{ route('games.index') }}" class="no-underline hide-md-down">
            <div class="stack rotate-img-on-hover">
                <img class="card" src="{{ url('images/layout/games.png') }}" role="img" alt="Games" width="175px" style="box-shadow: var(--shadow-md)" />
                <div class="row justify-end" style="margin-top: -20px; margin-right: -15px; z-index: var(--z-index-overlay)">
                    <span class="card bg-accent-soft p-sm text-xs weight-medium">Games</span>
                </div>
            </div>
        </a>

        <a href="{{ route('waterhole.home') }}" class="no-underline hide-lg-down">
            <div class="stack rotate-img-on-hover">
                <img class="card" src="{{ url('images/layout/community.png') }}" role="img" alt="Community" width="175px" style="box-shadow: var(--shadow-md);" />
                <div class="row justify-end" style="margin-top: -16px; margin-right: -15px; z-index: var(--z-index-overlay)">
                    <span class="card bg-accent-soft p-sm text-xs weight-medium">Community</span>
                </div>
            </div>
        </a>

        <div class="row push-end">
            @components(resolve(App\Extend\HeaderNavigation::class)->components())
        </div>
    </div>

    <div class="bg-fill" style="border-top: 1px solid var(--color-fill); border-bottom: 1px solid var(--color-fill);">
        <div class="container">
            <div class="row wrap gap-xs" style="padding-top: var(--space-xs); padding-bottom: var(--space-xs);">
                <span class="badge bg-accent hide-md-down">
                    @icon('tabler-circle-arrow-right-f')
                    More
                </span>
                <a href="{{ route('games.index') }}" class="btn btn--transparent btn--narrow text-xs hide-lg-up">Games</a>
                <a href="{{ route('waterhole.home') }}" class="btn btn--transparent btn--narrow text-xs hide-xl-up">Community</a>
                <a href="{{ route('reviews.index') }}" class="btn btn--transparent btn--narrow text-xs">Reviews</a>
                <a href="{{ route('recommendations.index') }}" class="btn btn--transparent btn--narrow text-xs">Recommendations</a>
                <span class="badge bg-accen push-end hide-sm">
                    @icon('tabler-quote-f')
                    <i>{{ $randomQuote }}</i>
                </span>
            </div>
        </div>
    </div>
</header>