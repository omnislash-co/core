<x-layout title="{{ $review->game->title }} Review">

    <section class="section">
        <div class="container with-sidebar">
            <div class="stack gap-gutter">
                <div class="stack gap-md">
                    <img class="game-icon hide-lg-up" src="{{ Storage::url('games/icons/'.$review->game->icon) }}" alt="{{ $review->game->title }}">
                    <h2>
                        <a href="{{ route('games.show', $review->game->slug) }}">{{ $review->game->title }}</a> Review
                    </h2>
                    <div>
                        <span class="badge">
                            @icon('tabler-device-gamepad')
                            {{ $review->platform->name }}
                        </span>
                    </div>
                    <div class="card card__row hide-lg-up">
                        <x-waterhole::attribution
                            :user="$review->user"
                            :date="$review->created_at"
                        />
                    </div>
                    @can('update', $review)
                        <a class="btn hide-lg-up" href="{{ route('reviews.edit', $review->id) }}">
                            @icon('tabler-edit')
                            Edit
                        </a>
                    @endcan
                    <div class="content">
                        {!! Str::markdown($review->body, [
                            'html_input' => 'strip',
                            'allow_unsafe_links' => false,
                        ]) !!}
                    </div>
                </div>

                <div class="card row align-center gap-md p-md">
                    <div class="rounded bg-accent p-lg text-xxl weight-bold text-center" style="min-width: 160px;">
                        {{ $review->score }}%
                    </div>
                    <div class="content">
                        {{ $review->summary }}
                    </div>
                </div>
            </div>

            <nav class="sidebar sidebar--sticky hide-md-down" style="top: 0;">
                <div class="stack grow gap-md">
                    <img class="game-icon" src="{{ Storage::url('games/icons/'.$review->game->icon) }}" alt="{{ $review->game->title }}">
                    <div class="card card__row">
                        <x-waterhole::attribution
                            :user="$review->user"
                            :date="$review->created_at"
                        />
                    </div>
                    @can('update', $review)
                        <a class="btn" href="{{ route('reviews.edit', $review->id) }}">
                            @icon('tabler-edit')
                            Edit
                        </a>
                    @endcan
                </div>
            </nav>
        </div>
    </section>

</x-layout>