<x-app-layout title="Create a Review">

    <div class="section container measure">
        <div class="dialog" aria-labelledby="dialog-title">
            <header class="dialog__header">
                <h1 class="h3" id="dialog-title">Create a Review</h1>
            </header>
            <div class="dialog__body">

                <form action="{{ route('reviews.store') }}" method="POST" data-turbo="false">
                    @csrf
                    <div class="stack gap-lg stacked-fields" 
                        data-controller="element loader search-params"
                        
                        data-search-params-param-key-value="game"
                        data-search-params-element-id-value="slim-select-game"
                        data-loader-hidden-class="hidden"

                        data-action="turbo:frame-render->loader#hide 
                        slim-select:after-change->search-params#addFromElement
                        search-params:added->loader#show
                        search-params:added->element#click">

                        <x-forms.slim-select 
                            label="Game"
                            name="game"
                            :options="$games"
                            value-key="id"
                            content-key="title" 
                        />

                        <a href="{{ route('reviews.create') }}" 
                            class="hidden" 
                            data-turbo-frame="platforms" 
                            data-search-params-target="anchor" 
                            data-element-target="element" 
                            data-turbo="true">
                            Fetch Platforms
                        </a>

                        <turbo-frame id="platforms" class="field">
                            <label class="field__label">Platform</label>
                            <x-waterhole::spinner class="spinner--block hidden" data-loader-target="spinner"/>

                            <div class="grow stack gap-xs" data-loader-target="content">
                                @if ($platforms)
                                    <select name="platform">
                                        <option value="">Select a platform</option>
                                        @foreach ($platforms as $platform)
                                            <option value="{{ $platform->id }}" @if ($platform->id == old('platform',request('platform'))) selected @endif>{{ $platform->name }}</option>
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
