<div class="flex justify-center">
    <div class="w-full max-w-6xl">
        <form wire:submit="create">
            {{ $this->form }}

            <div class="flex space-x-4">
                <button type="submit" class="px-4 py-2 mr-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    {{ __('filament-actions::modal.actions.submit.label') }}
                </button>
                <button type="button" wire:click="update"
                    class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    {{ __('Save as Draft') }}
                </button>
            </div>
        </form>

        <x-filament-actions::modals />
    </div>
</div>
