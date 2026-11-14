<header class="navigation" role="banner">
    <div class="container row gap-xl" style="min-height: 130px">
        <x-logo />

        <a href="{{ route('games.index') }}" class="no-underline hide-lg-down">
            <div class="stack rotate-img-on-hover">
                <img class="card" src="{{ url('images/layout/games.png') }}" role="img" alt="Games" width="175px" style="box-shadow: var(--shadow-md)" />
                <div class="row justify-end" style="margin-top: -20px; margin-right: -15px; z-index: var(--z-index-overlay)">
                    <span class="card bg-accent-soft p-sm text-xs weight-medium">Games</span>
                </div>
            </div>
        </a>

        <a href="{{ route('reviews.index') }}" class="no-underline hide-lg-down">
            <div class="stack rotate-img-on-hover">
                <img class="card" src="{{ url('images/layout/reviews.png') }}" role="img" alt="Reviews" width="175px" style="box-shadow: var(--shadow-md)" />
                <div class="row justify-end" style="margin-top: -20px; margin-right: -15px; z-index: var(--z-index-overlay)">
                    <span class="card bg-accent-soft p-sm text-xs weight-medium">Reviews</span>
                </div>
            </div>
        </a>

        <a href="{{ route('recommendations.index') }}" class="no-underline hide-lg-down">
            <div class="stack rotate-img-on-hover">
                <img class="card" src="{{ url('images/layout/recommendations.png') }}" role="img" alt="Recommendations" width="175px" style="box-shadow: var(--shadow-md)" />
                <div class="row justify-end" style="margin-top: -20px; margin-right: -15px; z-index: var(--z-index-overlay)">
                    <span class="card bg-accent-soft p-sm text-xs weight-medium">Recommendations</span>
                </div>
            </div>
        </a>

        <div class="row gap-sm hide-xl-up hide-sm">
            <a href="{{ route('games.index') }}" class="btn btn--outline">Games</a>
            <a href="{{ route('reviews.index') }}" class="btn btn--outline">Reviews</a>
            <a href="{{ route('recommendations.index') }}" class="btn btn--outline">Recommendations</a>
        </div>
    </div>
</header>
