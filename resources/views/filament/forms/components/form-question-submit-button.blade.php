<div>
    @if (isset($data['consent']) &&
            isset($data['privacy_policy']) &&
            isset($data['consent_start']) &&
            $data['consent'] &&
            $data['privacy_policy'] &&
            $data['consent_start']
    )
        <div class="flex gap-2">
            <x-filament::button type="submit" class="w-full" color="primary" wire:loading.attr="disabled"
                wire:target="updateAndClose">
                {{ __('Submit') }}
            </x-filament::button>

            <x-filament::button type="submit" class="w-full" color="primary" wire:loading.attr="disabled"
                wire:target="updateAndDraft">
                {{ __('Save as Draft') }}
            </x-filament::button>
        </div>
    @endif

</div>
