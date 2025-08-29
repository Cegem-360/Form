<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Schemas;

use App\Enums\ProjectStatus;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
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
                Select::make('request_quote_id')
                    ->preload()
                    ->live()
                    ->label('Quotation Name')
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
                    ->live()
                    ->required(),
                RichEditor::make('project_goal')
                    ->columnSpanFull(),

                CheckboxList::make('requestQuoteFunctionalities')
                    ->columnSpanFull()
                    ->columns(4)
                    ->searchable(false)
                    ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Builder $query, Model $record) {
                        return $query->where('website_type_id', $record->requestQuote->website_type_id)?->notDefault();
                    })
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s', $record->name))
                    ->disabled(),
                RichEditor::make('solved_problems')
                    ->label(__('Project summary'))
                    ->columnSpanFull(),
                TextInput::make('garanty')
                    ->live()
                    ->label(__('Garanty (in months)'))
                    ->numeric(),
                DatePicker::make('garanty_end_date')
                    ->disabled()
                    ->live(),
                Select::make('support_pack_id')
                    ->preload()
                    ->relationship('supportPack', 'name'),

                Section::make('Weboldal adatok')
                    ->description('Az árajánlatban szereplő weboldal információk')
                    ->collapsed()
                    ->columnSpanFull()
                    ->schema([
                        ViewField::make('website_data_table')
                            ->hiddenLabel()
                            ->disabled()
                            ->view('filament.forms.components.website-data-table'),
                        ViewField::make('languages_data_table')
                            ->hiddenLabel()
                            ->disabled()
                            ->view('filament.forms.components.languages-data-table'),
                    ]),
            ]);
    }
}
