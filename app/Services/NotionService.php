<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use FiveamCode\LaravelNotionApi\Entities\Page;
use FiveamCode\LaravelNotionApi\Exceptions\LaravelNotionAPIException;
use InvalidArgumentException;
use Log;
use Notion;

final class NotionService
{
    public function __construct(
        private ?string $defaultDatabaseId = null
    ) {
        $this->defaultDatabaseId = $defaultDatabaseId ?? config('notion.databases.quotes');
    }

    /**
     * Oldal létrehozása egy adatbázisban
     */
    public function createPageInDatabase(?string $databaseId, Page $page): array
    {
        try {
            $dbId = $this->getDatabaseId($databaseId);

            // Oldal létrehozása az adatbázisban
            $response = Notion::pages()->createInDatabase($dbId, $page);

            if (config('notion.error_handling.log_errors')) {
                Log::info('Notion page created successfully', [
                    'database_id' => $dbId,
                    'page_id' => $response->getId(),
                    'title' => $response->getTitle(),
                ]);
            }

            return [
                'success' => true,
                'data' => $response,
                'page_id' => $response->getId(),
                'title' => $response->getTitle(),
            ];
        } catch (LaravelNotionAPIException $e) {
            if (config('notion.error_handling.log_errors')) {
                Log::error('Notion API error: '.$e->getMessage());
            }

            if (config('notion.error_handling.throw_on_error')) {
                throw $e;
            }

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            if (config('notion.error_handling.log_errors')) {
                Log::error('General error in Notion service: '.$e->getMessage());
            }

            if (config('notion.error_handling.throw_on_error')) {
                throw $e;
            }

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Egyszerű oldal létrehozása parent page alatt
     */
    public function createChildPage(string $parentPageId, string $title): array
    {
        try {
            // Új Page objektum létrehozása
            $page = new Page();
            $page->setTitle('title', $title);

            $response = Notion::pages()->createInPage($parentPageId, $page);

            return [
                'success' => true,
                'data' => $response,
                'page_id' => $response->getId(),
                'title' => $response->getTitle(),
            ];
        } catch (LaravelNotionAPIException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Adatbázis lekérdezése
     */
    public function queryDatabase(string $databaseId): array
    {
        try {
            $response = Notion::database($databaseId)->query();

            return [
                'success' => true,
                'data' => $response,
            ];
        } catch (LaravelNotionAPIException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Oldal frissítése
     */
    public function updatePage(Page $page): array
    {
        try {
            $response = Notion::pages()->update($page);

            return [
                'success' => true,
                'data' => $response,
            ];
        } catch (LaravelNotionAPIException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Form adatok Notion-ba mentése
     */
    public function saveFormQuoteToNotion($requestQuote, ?string $databaseId = null): array
    {
        try {
            $page = new Page();

            // Ügyféladatok (Title mező)
            $page->setTitle('Név', $requestQuote->name ?? 'Ismeretlen ügyfél');

            // Email mező
            if (! empty($requestQuote->email)) {
                $page->setEmail('Email', $requestQuote->email);
            }

            // Telefon mező
            if (! empty($requestQuote->phone)) {
                $page->setPhoneNumber('Telefonszám', $requestQuote->phone);
            }

            // Weboldal típus
            if ($requestQuote->websiteType) {
                $page->setSelect('Weboldal típus', $requestQuote->websiteType->name);
            }

            // Teljes ár
            if (! empty($requestQuote->total_price)) {
                $page->setNumber('Teljes ár', (float) $requestQuote->total_price);
            }

            // Státusz
            $page->setSelect('Státusz', config('notion.defaults.status', 'Új ajánlatkérés'));

            // Létrehozás dátuma
            if ($requestQuote->created_at) {
                $page->setDate('Létrehozva', $requestQuote->created_at);
            }

            return $this->createPageInDatabase($databaseId, $page);

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Egyszerű adatok feltöltése Notion adatbázisba
     */
    public function createSimpleEntry(array $data, ?string $databaseId = null): array
    {
        try {
            $page = new Page();

            // Dinamikusan adjuk hozzá a mezőket a data array alapján
            foreach ($data as $fieldName => $value) {
                if (is_string($value)) {
                    $page->setText($fieldName, $value);
                } elseif (is_numeric($value)) {
                    $page->setNumber($fieldName, (float) $value);
                } elseif (is_bool($value)) {
                    $page->setCheckbox($fieldName, $value);
                }
            }

            return $this->createPageInDatabase($databaseId, $page);

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Notion oldal lekérése ID alapján
     */
    public function getPage(string $pageId): array
    {
        try {
            $page = Notion::pages()->find($pageId);

            return [
                'success' => true,
                'data' => $page,
                'title' => $page->getTitle(),
                'id' => $page->getId(),
            ];
        } catch (LaravelNotionAPIException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get default database ID if none provided
     */
    private function getDatabaseId(?string $databaseId = null): string
    {
        return $databaseId ?? $this->defaultDatabaseId ?? throw new InvalidArgumentException('Database ID is required');
    }
}
