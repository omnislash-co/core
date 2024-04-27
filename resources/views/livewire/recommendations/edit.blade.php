<form wire:submit="save">
    <div class="stack gap-lg stacked-fields">

        <div class="field">
            <label class="field__label">Recommendation</label>
            <div class="grow stack gap-xs">
                <x-waterhole::text-editor name="form.body" class="input" :value="$form->body" wire:model="form.body" />
                <div class="text-xs color-danger">@error('form.body') {{ $message }} @enderror</div>
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