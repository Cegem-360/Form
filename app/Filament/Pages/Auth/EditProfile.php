<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\EditProfile as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'admin@admin.com',
            'password' => 'password',
            'remember' => true,
        ]);
    }

    protected function fillForm(): void
    {
        $data = $this->getUser()->attributesToArray();

        $this->callHook('beforeFill');

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);

        $this->callHook('afterFill');
    }
}
