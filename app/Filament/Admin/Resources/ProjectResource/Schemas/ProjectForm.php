<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Schemas;

use App\Enums\ProjectStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                Select::make('request_quote_id')
                    ->relationship('requestQuote', 'quotation_name'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Select::make('status')
                    ->label('Project Status')
                    ->options(ProjectStatus::class)
                    ->enum(ProjectStatus::class)
                    ->required(),
                RichEditor::make('project_goal')
                    ->columnSpanFull(),
                TextInput::make('original_project_goals'),
                TextInput::make('completed_project_elements'),
                TextInput::make('project_not_contained_elements'),
                TextInput::make('completed_elements'),
                TextInput::make('solved_problems'),
                TextInput::make('garanty')
                    ->numeric(),
                DatePicker::make('garanty_end_date'),
                Select::make('contact')
                    ->relationship('contact', 'name'),
                Select::make('support_pack_id')
                    ->relationship('supportPack', 'name'),
                Select::make('contact_channel_id')
                    ->relationship('contactChannel', 'name'),
            ]);
    }
}
