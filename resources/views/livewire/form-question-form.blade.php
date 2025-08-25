<div class="flex justify-center">
    <div class="w-full max-w-6xl">
        <form class="space-y-6">
            {{ $this->form }}

        </form>
        {{--  <div class="mt-6">
            @if (isset($data['consent']) && isset($data['privacy_policy']) && isset($data['consent_start']) && $data['consent'] && $data['privacy_policy'] && $data['consent_start'])
                <div class="flex gap-2">
                    {{ $this->updateAndCloseAction() }}

                    {{ $this->updateAndDraftAction() }}
                </div>
            @endif
            <x-filament-actions::modals />
        </div> --}}
    </div>
