<x-app-layout :title="'Library - '.$game->title">

    <turbo-frame id="modal">
        <div class="section container measure" style="width: 80vw">
            <div class="dialog" aria-labelledby="dialog-title">
                <div class="dialog__header">
                    <div class="row grow justify-between">
                        <h1 class="h3" id="dialog-title">Library - {{ $game->title }}</h1>
                        <a href="{{ url()->previous() }}" class="btn btn--icon" data-action="modal#hide">
                            @icon('tabler-x')
                        </a>
                    </div>
                </div>
                <div class="dialog__body">
                    <livewire:games.library :$game />
                </div>
            </div>
        </div>
    </turbo-frame>
    
</x-app-layout>