<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\LanguageFileResource\Pages;

use App\Filament\Admin\Resources\LanguageFileResource;
use App\Models\LanguageFile;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class ListLanguageFiles extends ListRecords
{
    protected static string $resource = LanguageFileResource::class;

    protected function getTableQuery(): ?Builder
    {
        return null;
    }

    protected function getTableRecords(): array
    {
        return LanguageFile::all()->map(function (LanguageFile $file) {
            $record = (object) [
                'locale' => $file->locale,
                'path' => $file->path,
                'entries_count' => $file->entries_count . ' entries',
            ];

            // Add a way to identify the record for actions
            $record->id = $file->locale;

            return $record;
        })->toArray();
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return new class implements Paginator {
            public function url($page) { return ''; }
            public function appends($key, $value = null) { return $this; }
            public function fragment($fragment = null) { return $this; }
            public function links($view = null, $data = []) { return ''; }
            public function render($view = null, $data = []) { return ''; }
            public function items() { return []; }
            public function firstItem() { return 1; }
            public function lastItem() { return 3; }
            public function perPage() { return 10; }
            public function currentPage() { return 1; }
            public function hasPages() { return false; }
            public function hasMorePages() { return false; }
            public function count() { return 3; }
            public function isEmpty() { return false; }
            public function isNotEmpty() { return true; }
            public function onFirstPage() { return true; }
            public function onLastPage() { return true; }
            public function getIterator(): \ArrayIterator { return new \ArrayIterator([]); }
        };
    }
}