<div>
    <x-filament::page>
        <x-filament::card>
            <x-filament::grid>
                <x-filament::grid.column>
                    <h2 class="mb-4 text-2xl font-bold">{{ $record->title }}</h2>
                    <p class="mb-4 text-gray-600">{{ $record->description }}</p>
                </x-filament::grid.column>

                <x-filament::grid.column>
                    <h3 class="mt-6 text-xl font-semibold">Question Details</h3>
                    <ul class="pl-5 mt-2 list-disc">
                        <li>Type: {{ $record->type }}</li>
                        <li>Required: {{ $record->is_required ? 'Yes' : 'No' }}</li>
                        <li>Options: {{ implode(', ', $record->options ?? []) }}</li>
                    </ul>
                    <h3 class="mt-6 text-xl font-semibold">Responses</h3>
                    <ul class="pl-5 mt-2 list-disc">
                        @foreach ($record->responses ?? [] as $response)
                            <li>{{ $response->content }} ({{ $response->created_at->format('Y-m-d H:i') }})</li>
                        @endforeach
                    </ul>
                </x-filament::grid.column>
                <x-filament::grid.column>
                    <h3 class="mt-6 text-xl font-semibold">Associated Forms</h3>
                    <ul class="pl-5 mt-2 list-disc">
                        @foreach ($record->forms ?? [] as $form)
                            <li>
                                <a href="{{ route('filament.dashboard.resources.form-questions.view', $form) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $form->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </x-filament::grid.column>
                <x-filament::grid.column>
                    <h3 class="mt-6 text-xl font-semibold">Related Questions</h3>
                    <ul class="pl-5 mt-2 list-disc">
                        @foreach ($record->relatedQuestions ?? [] as $relatedQuestion)
                            <li>
                                <a href="{{ route('filament.dashboard.resources.form-questions.view', $relatedQuestion) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $relatedQuestion->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </x-filament::grid.column>
                <x-filament::grid.column>
                    <h3 class="mt-6 text-xl font-semibold">Metadata</h3>
                    <ul class="pl-5 mt-2 list-disc">
                        <li>Created At: {{ $record->created_at->format('Y-m-d H:i') }}</li>
                        <li>Updated At: {{ $record->updated_at->format('Y-m-d H:i') }}</li>
                    </ul>
                </x-filament::grid.column>
                <x-filament::grid.column>
                    <h3 class="mt-6 text-xl font-semibold">Actions</h3>
                    <div class="flex mt-2 space-x-4">

                        <x-filament::button icon="heroicon-o-arrow-left" color="secondary" :url="route('filament.dashboard.resources.form-questions.index')">
                            Back to Questions
                        </x-filament::button>
                    </div>
                </x-filament::grid.column>
            </x-filament::grid>
        </x-filament::card>
        <div class="pt-4 mt-6 border-t border-gray-200">
            <x-filament::button icon="heroicon-o-arrow-left" color="secondary" :url="route('filament.dashboard.resources.form-questions.index')">
                Back to Questions
            </x-filament::button>
        </div>
    </x-filament::page>
</div>
