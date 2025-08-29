<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Forms\Schemas\Steps;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;

final class Theme
{
    public static function make($visibility): Step
    {
        return Step::make('Theme')
            ->columns(3)
            ->schema([
                Toggle::make('have_exist_website')
                    ->columnSpan(1)
                    ->live()
                    ->inline()
                    ->visible($visibility?->have_exist_website_visible),
                Toggle::make('is_exact_deadline')
                    ->columnSpan(2)
                    ->live()
                    ->visible($visibility?->is_exact_deadline_visible),
                TextInput::make('exist_website_url')
                    ->visible(fn (Get $get): bool => $visibility?->exist_website_url_visible && $get('have_exist_website'))
                    ->url(),
                DatePicker::make('deadline')
                    ->visible(fn (Get $get): bool => $visibility?->deadline_visible && $get('is_exact_deadline')),
                MarkdownEditor::make('formating_milestone')
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('public')
                    ->visible($visibility?->formating_milestone_visible),
                MarkdownEditor::make('visual_feeling')
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('public')
                    ->visible($visibility?->visual_feeling_visible),
                TextInput::make('tone_of_website')
                    ->visible($visibility?->tone_of_website_visible)
                    ->maxLength(255),
                Toggle::make('have_exist_design')
                    ->columnSpanFull()
                    ->live()
                    ->visible($visibility?->have_exist_design_visible),
                FileUpload::make('design_files')
                    ->columnSpanFull()
                    ->visible(fn (Get $get): bool => $visibility?->design_files_visible && $get('have_exist_design'))
                    ->downloadable()
                    ->multiple()
                    ->disk('public')
                    ->directory('design_files')
                    ->visibility('public'),
                Repeater::make('banned_elements')
                    ->columnSpanFull()
                    ->visible($visibility?->banned_elements_visible)
                    ->defaultItems(3)
                    ->collapsible()
                    ->collapsed()
                    ->reorderableWithDragAndDrop()
                    ->schema([
                        Textarea::make('element')
                            ->columnSpanFull()
                            ->required(),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['element'] ?? null),
                Section::make(__('Colors and Fonts'))->columns(2)
                    ->columnSpanFull()
                    ->compact()
                    ->schema([
                        ColorPicker::make('primary_color')
                            ->translateLabel()
                            ->visible($visibility?->primary_color_visible),
                        ColorPicker::make('secondary_color')
                            ->translateLabel()
                            ->visible($visibility?->secondary_color_visible),
                        Repeater::make('additional_colors')
                            ->columnSpanFull()
                            ->visible($visibility?->additional_colors_visible)
                            ->defaultItems(3)
                            ->collapsible()
                            ->collapsed()
                            ->reorderableWithDragAndDrop()
                            ->schema([
                                ColorPicker::make('color')
                                    ->required(),
                                TextInput::make('description'),
                            ])
                            ->addActionLabel(__('New Color'))
                            ->itemLabel(fn (array $state): ?string => $state['description'] ?? null),
                    ]),
                Section::make(__('Font Types'))
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        Repeater::make('prefered_font_types')
                            ->columnSpanFull()
                            ->visible($visibility?->prefered_font_types_visible)
                            ->schema([
                                TextInput::make('font_type_name')
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->collapsible()
                            ->collapsed()
                            ->reorderableWithDragAndDrop()
                            ->addActionLabel(__('New Font'))
                            ->itemLabel(fn (array $state): ?string => $state['font_type_name'] ?? null),
                    ]),
            ]);
    }
}
