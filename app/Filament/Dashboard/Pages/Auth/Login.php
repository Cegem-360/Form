<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

final class Login extends BasePage
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
}
