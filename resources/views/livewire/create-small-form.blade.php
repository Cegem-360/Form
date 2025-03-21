<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-5xl min-w-full min-h-screen p-6 bg-gray-200 rounded-lg shadow-md">
        <form wire:submit="create" class="space-y-4">
            {{ $this->form }}

            <div class="flex space-x-4">
                <button type="submit" class="px-4 py-2 mr-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    {{ __('filament-actions::modal.actions.submit.label') }}
                </button>
                <button type="button" wire:click="saveAsDraft"
                    class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    {{ __('Save as Draft') }}
                </button>
            </div>
        </form>
        <x-filament-actions::modals />
    </div>
</div>
