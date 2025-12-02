<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form;

use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\ProjectUser\ProjectUser;
use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs\Visibility;
use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\Sections\Visibilities\Tabs\Website;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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
                        Tab::make('Project functions')
                            ->icon('heroicon-o-rectangle-stack')
                            ->schema([
                                CheckboxList::make('project_functions')
                                    ->label(__('Project Functions'))
                                    ->options(function ($state, $component) {
                                        $model = $component->getRecord();
                                        $functionalities = $model?->projectQuoteFunctionalities();

                                        if ($functionalities !== null && $functionalities->isNotEmpty()) {
                                            return $functionalities->pluck('name', 'id')->toArray();
                                        }

                                        return [];
                                    })
                                    ->disabled(),
                            ]),
                    ]),
            ])->columns(1);
    }
}
