<x-filament-panels::page>
    <x-filament::section>
        @foreach ($systemChatParameters as $systemChatParameter)
            <x-filament::modal id="edit-systemChatParameter-{{ $systemChatParameter->id }}" alignment="center">
                <x-slot name="heading">
                    Modal heading
                </x-slot>
                <x-slot name="trigger">
                    <x-filament::button wire:click="trigger({{ $systemChatParameter->id }})">
                        Open modal
                    </x-filament::button>
                </x-slot>
                <x-filament::input.wrapper>
                    <x-filament::input type="text" wire:model="name" />
                </x-filament::input.wrapper>
                <x-slot name="footerActions">
                    <x-filament::button wire:click="save({{ $systemChatParameter->id }})"
                        wire:key="$systemChatParameter->id">
                        Save modal
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        @endforeach

        <x-slot name="heading">
            User details
        </x-slot>

        {{-- Content --}}
    </x-filament::section>
</x-filament-panels::page>
