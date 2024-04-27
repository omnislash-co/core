@props(['review'])

<div class="card row p-md gap-md overlay-container">
    <div style="flex-basis: 64px;">
        <x-waterhole::avatar :user="$review->user" link style="width: 64px"/>
    </div>
    <div class="stack grow gap-sm text-xs">
        <p class="content">
            {{ Str::limit($review->summary, 100, '...')  }}
            <a href="{{ route('reviews.show', $review->id) }}" class="has-overlay no-underline">Read more</a>
        </p>
        <div class="row justify-between">
            <div class="row wrap gap-xxs justify-end">
                <span class="badge">
                    {{ $review->user->name }}
                </span>
                <span class="badge">
                    {{ $review->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="row wrap gap-xxs justify-end">
                <span class="badge bg-accent">
                    @icon('tabler-star')
                    {{ $review->score }}%
                </span>
            </div>
        </div>
    </div>
</div>