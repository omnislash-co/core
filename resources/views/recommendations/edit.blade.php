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
                <form action="{{ route('recommendations.update', $recommendation) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="stack gap-lg stacked-fields">
                        <div class="field">
                            <label class="field__label">Platform</label>
                            <div class="grow stack gap-xs">
                                <select name="platform">
                                    <option value="">Select a platform</option>
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}" @if ($platform->id == old('platform',$recommendation->platform->id)) selected @endif>{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-xs color-danger">@error('platform') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label">Recommendation</label>
                            <div class="grow stack gap-xs">
                                <x-waterhole::text-editor name="body" class="input" value="{{ old('body', $recommendation->body) }}" />
                                <div class="text-xs color-danger">@error('body') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="row gap-sm">
                            <button class="btn btn--wide bg-accent" type="submit">
                                Update
                            </button>
                            <a class="btn btn--wide" href="{{ route('recommendations.show', $recommendation) }}">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>