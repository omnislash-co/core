<x-layout title="{{ $recommendation->game->title }} Recommendation">

    <section class="section">
        <div class="container with-sidebar">
            <div class="stack gap-md">
                <img class="game-icon hide-lg-up" src="{{ Storage::url('games/icons/'.$recommendation->game->icon) }}" alt="{{ $recommendation->game->title }}">
                <h2>
                    <a href="{{ route('games.show', $recommendation->game->slug) }}">{{ $recommendation->game->title }}</a> Recommendation
                </h2>
                <div class="card card__row hide-lg-up">
                    <x-waterhole::attribution
                        :user="$recommendation->user"
                        :date="$recommendation->created_at"
                    />
                </div>
                @can('update', $recommendation)
                    <a class="btn hide-lg-up" href="{{ route('recommendations.edit', $recommendation->id) }}">
                        @icon('tabler-edit')
                        Edit
                    </a>
                @endcan
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

            <nav class="sidebar sidebar--sticky hide-md-down" style="top: 0;">
                <div class="stack grow gap-md">
                    <img class="game-icon" src="{{ Storage::url('games/icons/'.$recommendation->game->icon) }}" alt="{{ $recommendation->game->title }}">
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
        </div>
    </section>

</x-layout>