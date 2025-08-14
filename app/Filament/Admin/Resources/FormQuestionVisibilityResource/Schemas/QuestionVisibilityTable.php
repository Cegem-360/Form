<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionVisibilityResource\Schemas;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class QuestionVisibilityTable
{
    public static function configure(Table $table): Table
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
}
