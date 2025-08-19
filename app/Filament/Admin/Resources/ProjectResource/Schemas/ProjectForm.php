<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Schemas;

use App\Enums\ProjectStatus;
use App\Models\RequestQuote;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

final class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->preload()
                    ->relationship('user', 'name'),
                TextInput::make('company_name')
                    ->label('Company Name')
                    ->default(fn ($record) => $record?->user?->company_name)
                    ->disabled(),
                Select::make('request_quote_id')
                    ->preload()
                    ->live()
                    ->label('Quotation Name')
                    ->afterStateUpdated(function ($state, Set $set): void {
                        $requestQuote = RequestQuote::find($state);
                        $set('company_name', $requestQuote?->company_name);
                    })
                    ->relationship('requestQuote')
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s (%s)', $record->quotation_name, $record->company_name)),
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
                TextInput::make('completed_project_elements'),
                TextInput::make('project_not_contained_elements'),

                TextInput::make('solved_problems'),
                TextInput::make('garanty')
                    ->numeric(),
                DatePicker::make('garanty_end_date')->disabled(),
                Select::make('contact')
                    ->relationship('contact', 'name'),
                Select::make('support_pack_id')
                    ->relationship('supportPack', 'name'),
                /*   Select::make('contact_channel_id')
                    ->relationship('contactChannel', 'name'), */
            ]);
    }
}
