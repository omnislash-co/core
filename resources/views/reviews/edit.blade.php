<x-app-layout title="Edit Review">

    <div class="section container measure">
        <div class="dialog" aria-labelledby="dialog-title">
            <header class="dialog__header">
                <h1 class="h3" id="dialog-title">Edit Review</h1>
            </header>
            <div class="dialog__body stack gap-xl">
                <div class="content">
                    <blockquote>
                        {{ $review->game->title }} ({{ $review->platform->acronym }})
                    </blockquote>
                </div>
                <livewire:reviews.edit :$review />
            </div>
        </div>
    </div>

</x-app-layout>
