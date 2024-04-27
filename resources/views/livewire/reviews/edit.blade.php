<form wire:submit="save">
    <div class="stack gap-lg stacked-fields">

        <div class="field">
            <label class="field__label">Review</label>
            <div class="grow stack gap-xs">
                <x-waterhole::text-editor name="form.body" class="input" :value="$form->body" wire:model="form.body" />
                <div class="text-xs color-danger">@error('form.body') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Summary</label>
            <div class="grow stack gap-xs">
                <textarea placeholder="Write a short summary about your review (Maximum 255 characters)" wire:model="form.summary"></textarea>
                <div class="text-xs color-danger">@error('form.summary') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="field">
            <label class="field__label">Score</label>
            <div class="grow stack gap-xs">
                <input type="number" min="0" max="100" placeholder="0-100" wire:model="form.score" />
                <div class="text-xs color-danger">@error('form.score') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="row gap-sm">
            <button class="btn btn--wide bg-accent" type="submit" wire:loading.attr="disabled">
                Update
            </button>
            <button class="btn btn--wide" type="button" wire:click="cancel">
                Cancel
            </button>
        </div>

    </div>
</form>
