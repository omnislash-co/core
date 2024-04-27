<x-app-layout title="{{ $recommendation->game->title }} Recommendation">

    <div class="section container stack gap-gutter">
        <section class="with-sidebar">
            <nav class="sidebar sidebar--sticky">
                <div class="stack grow gap-md">
                    <img class="rounded game-icon" src="{{ url('/storage/games/icons/'.$recommendation->game->icon) }}" alt="{{ $recommendation->game->title }}">
                    <h2 class="hide-lg-up">
                        <a href="{{ route('games.show', $recommendation->game->slug) }}">{{ $recommendation->game->title }}</a> Recommendation
                    </h2>
                    <div class="card card__row">
                        <x-waterhole::attribution
                            :user="$recommendation->user"
                            :date="$recommendation->created_at"
                        />
                    </div>
                    @can('update', $recommendation)
                        <a class="btn" href="{{ route('recommendations.edit', $recommendation->id) }}">
                            @icon('tabler-edit')
                            Edit
                        </a>
                    @endcan
                </div>
            </nav>
        
            <div class="stack gap-gutter">
                <div class="stack gap-md">
                    <h2 class="hide-md-down">
                        <a href="{{ route('games.show', $recommendation->game->slug) }}">{{ $recommendation->game->title }}</a> Recommendation
                    </h2>
                    <div class="card p-md text-center">
                        <p>
                            "If you liked <a href="{{ route('games.show', $recommendation->playedGame->slug) }}" class="weight-bold">{{ $recommendation->playedGame->title }}</a>, you may also like <a href="{{ route('games.show', $recommendation->game->slug) }}" class="weight-bold">{{ $recommendation->game->title }}</a> ({{ $recommendation->platform->name }})"
                        </p>
                    </div>
                    <div class="content">
                        {!! Str::markdown($recommendation->body, [
                            'html_input' => 'strip',
                            'allow_unsafe_links' => false,
                        ]) !!}
                    </div>
                </div>

            </div>
        </section>
    </div>

</x-app-layout>