<div>
    <form class="max-w-6xl p-4 mx-auto bg-white rounded shadow-md">
        {{ $this->form }}
    </form>
    @if (isset($data['name']) &&
            isset($data['email']) &&
            isset($data['phone']) &&
            $data['name'] &&
            $data['email'] &&
            $data['phone']
    )
        <x-filament::button wire:click="order" type="button" class="mt-4" color="primary" icon="heroicon-o-paper-airplane"
            size="lg" spinner="submit" spinner-color="white">
            {{ __('Order') }}
        </x-filament::button>

        @guest
            <x-filament::button wire:click="registerAndOrder" type="button" class="mt-4" color="primary"
                icon="heroicon-s-user-plus" size="lg" spinner="submit" spinner-color="white">
                {{ __('Register And Order') }}
            </x-filament::button>
        @endguest

        <x-filament::button wire:click="submitAndSendEmail" type="button" class="mt-4" color="primary"
            icon="heroicon-s-envelope" size="lg" spinner="submit" spinner-color="white">
            {{ __('Submit and send to me in Email') }}
        </x-filament::button>
    @endif

    <x-filament-actions::modals />
</div>
