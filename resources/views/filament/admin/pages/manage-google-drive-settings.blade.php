<x-filament::page>
    <form wire:submit="save">
        {{ $this->form }}
        
        <div class="mt-6">
            <x-filament::button type="submit" size="lg">
                Beállítások mentése
            </x-filament::button>
        </div>
    </form>
</x-filament::page>