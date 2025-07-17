<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages\CreateFormQuestionVisibility;
use App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages\EditFormQuestionVisibility;
use App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages\ListFormQuestionVisibilities;
use App\Models\FormQuestionVisibility;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class FormQuestionVisibilityResource extends Resource
{
    protected static ?string $model = FormQuestionVisibility::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationParentItem = 'Projects';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('form_question_id')
                    ->relationship('formQuestion', 'id')
                    ->required(),
                Toggle::make('token_visible')
                    ->required(),
                Toggle::make('company_name_visible')
                    ->required(),
                Toggle::make('contact_name_visible')
                    ->required(),
                Toggle::make('contact_email_visible')
                    ->required(),
                Toggle::make('contact_phone_visible')
                    ->required(),
                Toggle::make('contact_position_visible')
                    ->required(),
                Toggle::make('have_exist_website_visible')
                    ->required(),
                Toggle::make('exist_website_url_visible')
                    ->required(),
                Toggle::make('is_exact_deadline_visible')
                    ->required(),
                Toggle::make('deadline_visible')
                    ->required(),
                Toggle::make('formating_milestone_visible')
                    ->required(),
                Toggle::make('visual_feeling_visible')
                    ->required(),
                Toggle::make('have_exist_design_visible')
                    ->required(),
                Toggle::make('design_files_visible')
                    ->required(),
                Toggle::make('inspire_websites_visible')
                    ->required(),
                Toggle::make('banned_elements_visible')
                    ->required(),
                Toggle::make('primary_color_visible')
                    ->required(),
                Toggle::make('secondary_color_visible')
                    ->required(),
                Toggle::make('additional_colors_visible')
                    ->required(),
                Toggle::make('prefered_font_types_visible')
                    ->required(),
                Toggle::make('own_company_images_visible')
                    ->required(),
                Toggle::make('use_video_or_animation_visible')
                    ->required(),
                Toggle::make('own_company_videos_visible')
                    ->required(),
                Toggle::make('main_pages_visible')
                    ->required(),
                Toggle::make('other_pages_visible')
                    ->required(),
                Toggle::make('have_product_catalog_visible')
                    ->required(),
                Toggle::make('product_catalog_visible')
                    ->required(),
                Toggle::make('tone_of_website_visible')
                    ->required(),
                Toggle::make('other_tone_of_website_visible')
                    ->required(),
                Toggle::make('need_multi_language_visible')
                    ->required(),
                Toggle::make('languages_for_website_visible')
                    ->required(),
                Toggle::make('call_to_actions_visible')
                    ->required(),
                Toggle::make('have_blog_visible')
                    ->required(),
                Toggle::make('exist_blog_count_visible')
                    ->required(),
                Toggle::make('importance_of_seo_visible')
                    ->required(),
                Toggle::make('have_payed_advertising_visible')
                    ->required(),
                Toggle::make('other_expectation_or_request_visible')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('formQuestion.id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('token_visible')
                    ->boolean(),
                IconColumn::make('company_name_visible')
                    ->boolean(),
                IconColumn::make('contact_name_visible')
                    ->boolean(),
                IconColumn::make('contact_email_visible')
                    ->boolean(),
                IconColumn::make('contact_phone_visible')
                    ->boolean(),
                IconColumn::make('contact_position_visible')
                    ->boolean(),
                IconColumn::make('have_exist_website_visible')
                    ->boolean(),
                IconColumn::make('exist_website_url_visible')
                    ->boolean(),
                IconColumn::make('is_exact_deadline_visible')
                    ->boolean(),
                IconColumn::make('deadline_visible')
                    ->boolean(),
                IconColumn::make('formating_milestone_visible')
                    ->boolean(),
                IconColumn::make('visual_feeling_visible')
                    ->boolean(),
                IconColumn::make('have_exist_design_visible')
                    ->boolean(),
                IconColumn::make('design_files_visible')
                    ->boolean(),
                IconColumn::make('inspire_websites_visible')
                    ->boolean(),
                IconColumn::make('banned_elements_visible')
                    ->boolean(),
                IconColumn::make('primary_color_visible')
                    ->boolean(),
                IconColumn::make('secondary_color_visible')
                    ->boolean(),
                IconColumn::make('additional_colors_visible')
                    ->boolean(),
                IconColumn::make('prefered_font_types_visible')
                    ->boolean(),
                IconColumn::make('own_company_images_visible')
                    ->boolean(),
                IconColumn::make('use_video_or_animation_visible')
                    ->boolean(),
                IconColumn::make('own_company_videos_visible')
                    ->boolean(),
                IconColumn::make('main_pages_visible')
                    ->boolean(),
                IconColumn::make('other_pages_visible')
                    ->boolean(),
                IconColumn::make('have_product_catalog_visible')
                    ->boolean(),
                IconColumn::make('product_catalog_visible')
                    ->boolean(),
                IconColumn::make('tone_of_website_visible')
                    ->boolean(),
                IconColumn::make('other_tone_of_website_visible')
                    ->boolean(),
                IconColumn::make('need_multi_language_visible')
                    ->boolean(),
                IconColumn::make('languages_for_website_visible')
                    ->boolean(),
                IconColumn::make('call_to_actions_visible')
                    ->boolean(),
                IconColumn::make('have_blog_visible')
                    ->boolean(),
                IconColumn::make('exist_blog_count_visible')
                    ->boolean(),
                IconColumn::make('importance_of_seo_visible')
                    ->boolean(),
                IconColumn::make('have_payed_advertising_visible')
                    ->boolean(),
                IconColumn::make('other_expectation_or_request_visible')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListFormQuestionVisibilities::route('/'),
            'create' => CreateFormQuestionVisibility::route('/create'),
            'edit' => EditFormQuestionVisibility::route('/{record}/edit'),
        ];
    }
}
