<div>
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
        @auth
            {{ $this->orderAction }}
        @else
            {{ $this->registerAndSendAction }}
            {{ $this->orderAndRegisterAction }}
        @endauth

        {{ $this->sendEmailToMeAction }}
    @endif
</div>
