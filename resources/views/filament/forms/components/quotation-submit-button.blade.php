<div>
    @if (isset($data['consent']) && isset($data['privacy_policy']) && $data['consent'] && $data['privacy_policy'])

        @auth
            {{ $this->orderAction }}
            {{ $this->createRequestQuoteAction }}
        @else
            @if (isset($data['name']) &&
                    isset($data['email']) &&
                    isset($data['phone']) &&
                    $data['name'] &&
                    $data['email'] &&
                    $data['phone']
            )
                {{ $this->registerAndSendAction }}
                {{ $this->registerAndOrderAction }}
            @endif
        @endauth

        @isset($data['email'])
            {{ $this->sendEmailToMeAction }}
        @endisset

    @endif

</div>
