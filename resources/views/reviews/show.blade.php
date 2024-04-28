<x-app-layout title="{{ $review->game->title }} Review">

    <div class="section container stack gap-gutter">
        <section class="with-sidebar">
            <nav class="sidebar sidebar--sticky">
                <div class="stack grow gap-md">
                    <img class="rounded game-icon" src="{{ Storage::url('games/icons/'.$review->game->icon) }}" alt="{{ $review->game->title }}">
                    <h2 class="hide-lg-up">
                        <a href="{{ route('games.show', $review->game->slug) }}">{{ $review->game->title }}</a> Review
                    </h2>
                    <div class="hide-lg-up">
                        <span class="badge">
                            @icon('tabler-device-gamepad')
                            {{ $review->platform->name }}
                        </span>
                    </div>
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
        
            <div class="stack gap-gutter">
                <div class="stack gap-md">
                    <h2 class="hide-md-down">
                        <a href="{{ route('games.show', $review->game->slug) }}">{{ $review->game->title }}</a> Review
                    </h2>
                    <div class="hide-md-down">
                        <span class="badge">
                            @icon('tabler-device-gamepad')
                            {{ $review->platform->name }}
                        </span>
                    </div>
                    <div class="content">
                        {!! Str::markdown($review->body, [
                            'html_input' => 'strip',
                            'allow_unsafe_links' => false,
                        ]) !!}
                    </div>
                </div>

                <div class="card row align-center gap-md p-md">
                    <div class="rounded bg-accent p-lg text-xxl weight-bold text-center" style="min-width: 150px;">
                        {{ $review->score }}%
                    </div>
                    <div class="content">
                        {{ $review->summary }}
                    </div>
                </div>

            </div>
        </section>
    </div>

</x-app-layout>