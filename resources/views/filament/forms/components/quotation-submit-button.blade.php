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
        {{ $this->orderAndRegisterAction }}
    @endguest

    {{ $this->sendEmailToMeAction }}
@endif
