<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionVisibilityResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class QuestionVisibilityForm
{
    public static function configure(Schema $schema): Schema
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

                Toggle::make('have_product_catalog_visible')
                    ->required(),
                Toggle::make('product_catalog_visible')
                    ->required(),
                Toggle::make('tone_of_website_visible')
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
}
