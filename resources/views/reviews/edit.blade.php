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
                <form action="{{ route('reviews.update', $review) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="stack gap-lg stacked-fields">
                        <div class="field">
                            <label class="field__label">Platform</label>
                            <div class="grow stack gap-xs">
                                <select name="platform">
                                    <option value="">Select a platform</option>
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}" @if ($platform->id == old('platform',$review->platform->id)) selected @endif>{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-xs color-danger">@error('platform') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label">Review</label>
                            <div class="grow stack gap-xs">
                                <x-waterhole::text-editor name="body" class="input" value="{{ old('body', $review->body) }}" />
                                <div class="text-xs color-danger">@error('body') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label">Summary</label>
                            <div class="grow stack gap-xs">
                                <textarea placeholder="Write a short summary about your review (Maximum 255 characters)" name="summary">{{ old('summary', $review->summary) }}</textarea>
                                <div class="text-xs color-danger">@error('summary') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label">Score</label>
                            <div class="grow stack gap-xs">
                                <input type="number" min="0" max="100" placeholder="0-100" name="score" value="{{ old('score', $review->score) }}" />
                                <div class="text-xs color-danger">@error('score') {{ $message }} @enderror</div>
                            </div>
                        </div>

                        <div class="row gap-sm">
                            <button class="btn btn--wide bg-accent" type="submit">
                                Update
                            </button>
                            <a class="btn btn--wide" href="{{ route('reviews.show', $review) }}">
                                Cancel
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>
