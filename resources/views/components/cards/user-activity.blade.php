<div class="card row p-md gap-md">
    <div>
        <x-waterhole::user-link :user="$activity->user">
            <x-waterhole::avatar :user="$activity->user" link style="width: 48px"/>
        </x-waterhole::user-link>
    </div>
    <div class="stack grow gap-sm">
        <div class="text-xs">
            {{ $activity->playStatus->name }}: <a href="{{ route('games.show', $activity->game->slug) }}" class="weight-medium">{{ $activity->game->title }}</a>
        </div>
        <div class="row gap-xxs wrap">
            <a href="{{ $activity->user->url }}" class="badge bg-accent">
                @icon('tabler-user')
                {{ $activity->user->name }}
            </a>
            <span class="badge">
                {{ $activity->created_at->diffForHumans() }}
            </span>
            <span class="badge bg-warning-soft push-end">
                {{ $activity->platform->acronym }}
            </span>
        </div>
    </div>
</div>