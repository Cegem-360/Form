@if (isset($data['name']) &&
        isset($data['email']) &&
        isset($data['phone']) &&
        isset($data['consent']) &&
        $data['name'] &&
        $data['email'] &&
        $data['phone'] &&
        $data['consent']
)
    {{ $this->orderAction }}
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
