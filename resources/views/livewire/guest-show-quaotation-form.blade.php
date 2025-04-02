<div>
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit">
            Mentés
        </button>
    </form>

    <x-filament-actions::modals />
</div>
