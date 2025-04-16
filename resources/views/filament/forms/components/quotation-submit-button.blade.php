@if (isset($data['name']) &&
        isset($data['email']) &&
        isset($data['phone']) &&
        isset($data['consent']) &&
        isset($data['privacy_policy']) &&
        $data['name'] &&
        $data['email'] &&
        $data['phone'] &&
        $data['consent'] &&
        $data['privacy_policy']
)
    {{ $this->orderAction }}

    @guest
        {{ $this->orderAndRegisterAction }}
    @endguest

    {{ $this->sendEmailToMeAction }}
@endif
