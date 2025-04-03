<div>
    <form>
        {{ $this->form }}

    </form>
    <x-filament::button wire:click="order" type="button" class="mt-4" color="primary" icon="heroicon-o-paper-airplane"
        size="lg" spinner="submit" spinner-color="white">
        {{ __('Order') }}
    </x-filament::button>

    <x-filament::button wire:click="registerAndOrder" type="button" class="mt-4" color="primary"
        icon="heroicon-s-user-plus" size="lg" spinner="submit" spinner-color="white">
        {{ __('registerAndOrder') }}
    </x-filament::button>
    <x-filament::button wire:click="submitAndSendEmail" type="button" class="mt-4" color="primary"
        icon="heroicon-s-envelope" size="lg" spinner="submit" spinner-color="white">
        {{ __('submitAndSendEmail') }}
    </x-filament::button>
    <x-filament-actions::modals />
</div>
