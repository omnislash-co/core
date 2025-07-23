<x-app-layout title="Create a Review">

    <div class="section container measure">
        <div class="dialog" aria-labelledby="dialog-title">
            <header class="dialog__header">
                <h1 class="h3" id="dialog-title">Create a Review</h1>
            </header>
            <div class="dialog__body">

                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <div class="stack gap-lg stacked-fields" 
                        data-controller="game-select" 
                        data-game-select-hidden-class="hidden"
                        data-action="turbo:frame-render->game-select#loaded">

                        <div class="field">
                            <label class="field__label">Game</label>
                            <div class="grow stack gap-xs">
                                <div class="input-container hidden" data-game-select-target="input" id="read-only">
                                    <div class="input"></div>
                                    <span>
                                        <button class="btn btn--icon btn--sm bg-danger-soft" type="button" data-action="click->game-select#unset">
                                            @icon('tabler-x')
                                        </button>
                                    </span>
                                </div>
                                <div style="position: relative;" data-game-select-target="input" id="search">
                                    <div class="input-container grow">
                                        @icon('tabler-search', ['class' => 'no-pointer'])
                                        <input type="text" name="search" placeholder="Search for a game"
                                            data-action="focus->game-select#showMenu blur->game-select#hideMenu input->game-select#search">
                                    </div>
                                    <div class="menu filters-menu text-sm hidden" data-game-select-target="menu">
                                        @forelse ($games as $item)
                                            <div class="nav-link" data-game-select-target="item" data-action="click->game-select#prep" id="{{ $item->id }}">{{ $item->title }}</div>
                                        @empty
                                            <div class="p-xs">No games found.</div>
                                        @endforelse
                                    </div>
                                </div>
                                <select class="hidden" name="game" data-game-select-target="select">
                                    <option value="">Select a game</option>
                                    @foreach ($games as $game)
                                        <option value="{{ $game->id }}" @if ($game->id == old('game')) selected @endif>{{ $game->title }}</option>
                                    @endforeach
                                </select>
                                <div class="text-xs color-danger">@error('game') {{ $message }} @enderror</div>
                            </div>
                            <a href="{{ route('reviews.create') }}" data-turbo-frame="platforms" data-game-select-target="anchor" class="hidden">FETCH</a>
                        </div>

                        <turbo-frame id="platforms" data-turbo-prefetch="false" class="field">
                            <label class="field__label">Platform</label>
                            <x-waterhole::spinner class="spinner--block hidden" data-game-select-target="loader"/>

                            <div class="grow stack gap-xs" data-game-select-target="results">
                                @if ($platforms)
                                    <select name="platform">
                                        <option value="">Select a platform</option>
                                        @foreach ($platforms as $platform)
                                            <option value="{{ $platform->id }}" @if ($platform->id == old('platform')) selected @endif>{{ $platform->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select disabled>
                                        <option>No game selected</option>
                                    </select>
                                @endif
                                <div class="text-xs color-danger">@error('platform') {{ $message }} @enderror</div>
                            </div>
                        </turbo-frame>

                        <div class="field">
                            <label class="field__label">Review</label>
                            <div class="grow stack gap-xs">
                                <x-waterhole::text-editor name="body" class="input" value="{{ old('body') }}" />
                                <div class="text-xs color-danger">@error('body') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label">Summary</label>
                            <div class="grow stack gap-xs">
                                <textarea placeholder="Write a short summary about your review (Maximum 255 characters)" name="summary">{{ old('summary') }}</textarea>
                                <div class="text-xs color-danger">@error('summary') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label">Score</label>
                            <div class="grow stack gap-xs">
                                <input type="number" min="0" max="100" placeholder="0-100" name="score" value="{{ old('score') }}" />
                                <div class="text-xs color-danger">@error('score') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn--wide bg-accent" type="submit">
                                Create
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
