<x-app-layout title="Edit Recommendation">

    <div class="section container measure">
        <div class="dialog" aria-labelledby="dialog-title">
            <header class="dialog__header">
                <h1 class="h3" id="dialog-title">Edit Recommendation</h1>
            </header>
            <div class="dialog__body stack gap-xl">
                <div class="content">
                    <blockquote>
                        "If you liked <span class="color-accent weight-bold">{{ $recommendation->playedGame->title }}</span>, you may also like <span class="color-accent weight-bold">{{ $recommendation->game->title }}</a> ({{ $recommendation->platform->name }})"
                    </blockquote>
                </div>
                <livewire:recommendations.edit :$recommendation />
            </div>
        </div>
    </div>

</x-app-layout>