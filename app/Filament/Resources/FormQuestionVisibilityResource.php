<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FormQuestionVisibilityResource\Pages;
use App\Models\FormQuestionVisibility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormQuestionVisibilityResource extends Resource
{
    protected static ?string $model = FormQuestionVisibility::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('form_question_id')
                    ->relationship('formQuestion', 'id')
                    ->required(),
                Forms\Components\Toggle::make('token_visible')
                    ->required(),
                Forms\Components\Toggle::make('company_name_visible')
                    ->required(),
                Forms\Components\Toggle::make('contact_name_visible')
                    ->required(),
                Forms\Components\Toggle::make('contact_email_visible')
                    ->required(),
                Forms\Components\Toggle::make('contact_phone_visible')
                    ->required(),
                Forms\Components\Toggle::make('contact_position_visible')
                    ->required(),
                Forms\Components\Toggle::make('have_exist_website_visible')
                    ->required(),
                Forms\Components\Toggle::make('exist_website_url_visible')
                    ->required(),
                Forms\Components\Toggle::make('is_exact_deadline_visible')
                    ->required(),
                Forms\Components\Toggle::make('deadline_visible')
                    ->required(),
                Forms\Components\Toggle::make('formating_milestone_visible')
                    ->required(),
                Forms\Components\Toggle::make('visual_feeling_visible')
                    ->required(),
                Forms\Components\Toggle::make('have_exist_design_visible')
                    ->required(),
                Forms\Components\Toggle::make('design_files_visible')
                    ->required(),
                Forms\Components\Toggle::make('inspire_websites_visible')
                    ->required(),
                Forms\Components\Toggle::make('banned_elements_visible')
                    ->required(),
                Forms\Components\Toggle::make('primary_color_visible')
                    ->required(),
                Forms\Components\Toggle::make('secondary_color_visible')
                    ->required(),
                Forms\Components\Toggle::make('additional_colors_visible')
                    ->required(),
                Forms\Components\Toggle::make('prefered_font_types_visible')
                    ->required(),
                Forms\Components\Toggle::make('own_company_images_visible')
                    ->required(),
                Forms\Components\Toggle::make('use_video_or_animation_visible')
                    ->required(),
                Forms\Components\Toggle::make('own_company_videos_visible')
                    ->required(),
                Forms\Components\Toggle::make('main_pages_visible')
                    ->required(),
                Forms\Components\Toggle::make('other_pages_visible')
                    ->required(),
                Forms\Components\Toggle::make('have_product_catalog_visible')
                    ->required(),
                Forms\Components\Toggle::make('product_catalog_visible')
                    ->required(),
                Forms\Components\Toggle::make('tone_of_website_visible')
                    ->required(),
                Forms\Components\Toggle::make('other_tone_of_website_visible')
                    ->required(),
                Forms\Components\Toggle::make('need_multi_language_visible')
                    ->required(),
                Forms\Components\Toggle::make('languages_for_website_visible')
                    ->required(),
                Forms\Components\Toggle::make('call_to_actions_visible')
                    ->required(),
                Forms\Components\Toggle::make('have_blog_visible')
                    ->required(),
                Forms\Components\Toggle::make('exist_blog_count_visible')
                    ->required(),
                Forms\Components\Toggle::make('importance_of_seo_visible')
                    ->required(),
                Forms\Components\Toggle::make('have_payed_advertising_visible')
                    ->required(),
                Forms\Components\Toggle::make('other_expectation_or_request_visible')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('formQuestion.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('token_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('company_name_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('contact_name_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('contact_email_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('contact_phone_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('contact_position_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('have_exist_website_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('exist_website_url_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_exact_deadline_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('deadline_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('formating_milestone_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('visual_feeling_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('have_exist_design_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('design_files_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('inspire_websites_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('banned_elements_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('primary_color_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('secondary_color_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('additional_colors_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('prefered_font_types_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('own_company_images_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('use_video_or_animation_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('own_company_videos_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('main_pages_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('other_pages_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('have_product_catalog_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('product_catalog_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('tone_of_website_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('other_tone_of_website_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('need_multi_language_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('languages_for_website_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('call_to_actions_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('have_blog_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('exist_blog_count_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('importance_of_seo_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('have_payed_advertising_visible')
                    ->boolean(),
                Tables\Columns\IconColumn::make('other_expectation_or_request_visible')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormQuestionVisibilities::route('/'),
            'create' => Pages\CreateFormQuestionVisibility::route('/create'),
            'edit' => Pages\EditFormQuestionVisibility::route('/{record}/edit'),
        ];
    }
}
