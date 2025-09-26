<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

final class LanguageFile
{
    public string $locale;
    public string $path;
    public array $content;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
        $this->path = lang_path("{$locale}.json");
        $this->content = $this->loadContent();
    }

    public static function all(): Collection
    {
        $locales = ['hu', 'en', 'de'];

        return collect($locales)->map(fn($locale) => new static($locale));
    }

    public static function find(string $locale): ?static
    {
        if (in_array($locale, ['hu', 'en', 'de'])) {
            return new static($locale);
        }

        return null;
    }

    public function save(): bool
    {
        $json = json_encode($this->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return File::put($this->path, $json) !== false;
    }

    public function updateContent(array $newContent): bool
    {
        $this->content = $newContent;
        return $this->save();
    }

    private function loadContent(): array
    {
        if (!File::exists($this->path)) {
            return [];
        }

        $content = File::get($this->path);
        return json_decode($content, true) ?? [];
    }

    public function getKey(): string
    {
        return $this->locale;
    }

    public function getJsonContentAttribute(): string
    {
        return json_encode($this->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function setJsonContentAttribute(string $value): void
    {
        $this->content = json_decode($value, true) ?? [];
    }

    public function getEntriesCountAttribute(): int
    {
        return count($this->content);
    }
}
