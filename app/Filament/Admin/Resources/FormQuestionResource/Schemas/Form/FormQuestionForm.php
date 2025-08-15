<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form;

use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\ProjectUser\ProjectUser;
use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs\Visibility;
use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs\Website;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

final class FormQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ProjectUser::make(),
                Tabs::make('Visibilities')
                    ->tabs([
                        Website::make(),
                        Visibility::make(),
                    ]),
            ])->columns(1);
    }
}
