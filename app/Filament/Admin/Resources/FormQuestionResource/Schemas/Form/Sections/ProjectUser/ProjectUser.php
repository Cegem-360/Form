<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\ProjectUser;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;

final class ProjectUser
{
    public static function make(): Section
    {
        return Section::make('Project felhasználó')->columns(2)->schema([
            Select::make('project_id')
                ->relationship('project', 'name')
                ->searchable()
                ->preload()
                ->columns(2),
            Select::make('user_id')
                ->relationship('user', 'name')
                ->preload(),
        ]);
    }
}
