<div>
    <form class="max-w-6xl p-4 mx-auto bg-white rounded shadow-md">
        {{ $this->form }}
        {{--  @if (isset($data['name']) && isset($data['email']) && isset($data['phone']) && isset($data['consent']) && isset($data['privacy_policy']) && $data['name'] && $data['email'] && $data['phone'] && $data['consent'] && $data['privacy_policy'])
            {{ $this->orderAction }}

            @guest
                {{ $this->orderAndRegisterAction }}
            @endguest

            {{ $this->sendEmailToMeAction }}
        @endif --}}
    </form>

    <x-filament-actions::modals />

</div>
