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

            // Ajánlat neve
            if (! empty($requestQuote->quotation_name)) {
                $page->setText('Ajánlat neve', $requestQuote->quotation_name);
            }

            // Ügyfél típus
            if ($requestQuote->client_type) {
                $page->setSelect('Ügyfél típus', $requestQuote->client_type->value);
            }

            // Cég neve (ha cég)
            if (! empty($requestQuote->company_name)) {
                $page->setText('Cég neve', $requestQuote->company_name);
            }

            // Cég címe
            if (! empty($requestQuote->company_address)) {
                $page->setText('Cég címe', $requestQuote->company_address);
            }

            // Weboldal típus
            if ($requestQuote->websiteType) {
                $page->setSelect('Weboldal típus', $requestQuote->websiteType->name);
            }

            // Weboldal engine
            if (! empty($requestQuote->website_engine)) {
                $page->setSelect('Weboldal engine', $requestQuote->website_engine);
            }

            // Van-e grafika
            $page->setCheckbox('Van grafika', $requestQuote->have_website_graphic ?? false);

            // Többnyelvű-e
            $page->setCheckbox('Többnyelvű', $requestQuote->is_multilangual ?? false);

            // Alapértelmezett nyelv
            if (! empty($requestQuote->default_language)) {
                $page->setSelect('Alapértelmezett nyelv', $requestQuote->default_language);
            }

            // Nyelvek (array formátumban)
            if (! empty($requestQuote->languages) && is_array($requestQuote->languages)) {
                $languageNames = [];
                try {
                    $languages = $requestQuote->getLanguages();
                    $languageNames = $languages->pluck('name')->toArray();
                } catch (Exception $e) {
                    // Ha nem sikerül betölteni a nyelveket, használjuk az ID-kat
                    $languageNames = $requestQuote->languages;
                }
                $page->setMultiSelect('Nyelvek', $languageNames);
            }

            // Fizetési mód
            if (! empty($requestQuote->payment_method)) {
                $page->setSelect('Fizetési mód', $requestQuote->payment_method);
            }

            // Projekt leírás
            if (! empty($requestQuote->project_description)) {
                $page->setText('Projekt leírás', $requestQuote->project_description);
            }

            // Számlázási cím
            if (! empty($requestQuote->billing_address)) {
                $page->setText('Számlázási cím', $requestQuote->billing_address);
            }

            // Kifizetve-e
            $page->setCheckbox('Kifizetve', $requestQuote->is_payed ?? false);

            // Teljes ár
            if (! empty($requestQuote->total_price)) {
                $page->setNumber('Teljes ár', (float) $requestQuote->total_price);
            }

            // Alap ár (nyelvek nélkül)
            try {
                $basePriceNoLanguages = $requestQuote->getTotalPriceAttributeNoLanguages();
                $page->setNumber('Alap ár (nyelvek nélkül)', (float) $basePriceNoLanguages);
            } catch (Exception $e) {
                // Ha nem sikerül kiszámolni, kihagyjuk
            }

            // Weboldal adatok (JSON formátumban, ha van)
            if (! empty($requestQuote->websites) && is_array($requestQuote->websites)) {
                $websitesText = '';
                foreach ($requestQuote->websites as $index => $website) {
                    $websitesText .= 'Weboldal '.($index + 1).":\n";
                    if (isset($website['length'])) {
                        $websitesText .= '- Méret: '.$website['length']."\n";
                    }
                    if (isset($website['required'])) {
                        $websitesText .= '- Szükséges: '.($website['required'] ? 'Igen' : 'Nem')."\n";
                    }
                    $websitesText .= "\n";
                }
                if ($websitesText) {
                    $page->setText('Weboldal részletek', mb_trim($websitesText));
                }
            }

            // Funkciók
            if ($requestQuote->requestQuoteFunctionalities) {
                try {
                    $functionalities = $requestQuote->requestQuoteFunctionalities()->get();
                    if ($functionalities->isNotEmpty()) {
                        $functionalityNames = $functionalities->pluck('name')->toArray();
                        $page->setMultiSelect('Funkciók', $functionalityNames);

                        // Funkciók teljes ára
                        $functionalitiesPrice = $functionalities->sum('price');
                        $page->setNumber('Funkciók ára', (float) $functionalitiesPrice);
                    }
                } catch (Exception $e) {
                    // Ha nem sikerül betölteni a funkciókat, kihagyjuk
                }
            }

            // Státusz
            $page->setSelect('Státusz', config('notion.defaults.status', 'Új ajánlatkérés'));

            // Létrehozás dátuma
            if ($requestQuote->created_at) {
                $page->setDate('Létrehozva', $requestQuote->created_at);
            }

            // Frissítés dátuma
            if ($requestQuote->updated_at) {
                $page->setDate('Frissítve', $requestQuote->updated_at);
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
