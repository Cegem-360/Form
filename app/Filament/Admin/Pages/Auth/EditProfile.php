<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages\Auth;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

final class EditProfile extends \Filament\Auth\Pages\EditProfile
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
