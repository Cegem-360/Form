# RequestQuote automatikus Notion integráció - Használati útmutató

## Beállított megoldások

### 1. Observer megoldás (Aktív)
- **Fájl**: `app/Observers/RequestQuoteObserver.php`
- **Regisztrálva**: `AppServiceProvider.php`-ban
- **Működés**: Automatikus szinkron küldés Notion-ba minden új RequestQuote létrehozásakor

### 2. Queue Job (Háttérfeladat)
- **Fájl**: `app/Jobs/SendRequestQuoteToNotion.php`
- **Használat**: Aszinkron feldolgozáshoz
- **Előnyök**: Nem blokkolja a felhasználói felületet

### 3. Event/Listener (Alternatív)
- **Event**: `app/Events/RequestQuoteCreated.php`
- **Listener**: `app/Listeners/SendRequestQuoteToNotionListener.php`
- **Használat**: Ha event-driven architektúrát szeretnél

### 4. Trait (Univerzális)
- **Fájl**: `app/Traits/SendsToNotion.php`
- **Használat**: Több modellhez is alkalmazható

## Notion Mezők Mapping

A frissített `NotionService::saveFormQuoteToNotion` metódus az alábbi RequestQuote mezőket küldi a Notion-be:

### Alapvető adatok:
- **Név** (Title) - `name`
- **Email** (Email) - `email`
- **Telefonszám** (Phone Number) - `phone`
- **Ajánlat neve** (Text) - `quotation_name`

### Ügyfél információk:
- **Ügyfél típus** (Select) - `client_type` (Enum értéke)
- **Cég neve** (Text) - `company_name`
- **Cég címe** (Text) - `company_address`
- **Számlázási cím** (Text) - `billing_address`

### Projekt részletek:
- **Weboldal típus** (Select) - `websiteType->name`
- **Weboldal engine** (Select) - `website_engine`
- **Van grafika** (Checkbox) - `have_website_graphic`
- **Többnyelvű** (Checkbox) - `is_multilangual`
- **Alapértelmezett nyelv** (Select) - `default_language`
- **Nyelvek** (Multi-select) - `languages` (array)
- **Projekt leírás** (Text) - `project_description`

### Weboldal részletek:
- **Weboldal részletek** (Text) - `websites` array formázva

### Funkciók:
- **Funkciók** (Multi-select) - `requestQuoteFunctionalities` nevek
- **Funkciók ára** (Number) - Funkciók összesített ára

### Pénzügyi információk:
- **Teljes ár** (Number) - `total_price` (attribútum)
- **Alap ár (nyelvek nélkül)** (Number) - `getTotalPriceAttributeNoLanguages()`
- **Fizetési mód** (Select) - `payment_method`
- **Kifizetve** (Checkbox) - `is_payed`

### Időbélyegek:
- **Státusz** (Select) - Konfigurálható (alapértelmezett: "Új ajánlatkérés")
- **Létrehozva** (Date) - `created_at`
- **Frissítve** (Date) - `updated_at`

## Notion Adatbázis Beállítás

Győződjön meg róla, hogy a Notion adatbázisban az alábbi propertiák léteznek:

### Szükséges mezők:
1. **Név** (Title)
2. **Email** (Email)
3. **Telefonszám** (Phone Number)
4. **Ajánlat neve** (Text)
5. **Ügyfél típus** (Select) - Lehetséges értékek: "private", "company"
6. **Cég neve** (Text)
7. **Cég címe** (Text)
8. **Weboldal típus** (Select)
9. **Weboldal engine** (Select)
10. **Van grafika** (Checkbox)
11. **Többnyelvű** (Checkbox)
12. **Alapértelmezett nyelv** (Select)
13. **Nyelvek** (Multi-select)
14. **Fizetési mód** (Select)
15. **Projekt leírás** (Text)
16. **Számlázási cím** (Text)
17. **Kifizetve** (Checkbox)
18. **Teljes ár** (Number)
19. **Alap ár (nyelvek nélkül)** (Number)
20. **Weboldal részletek** (Text)
21. **Funkciók** (Multi-select)
22. **Funkciók ára** (Number)
23. **Státusz** (Select)
24. **Létrehozva** (Date)
25. **Frissítve** (Date)

## Aktiválás és konfiguráció

### 1. Observer aktiválása (Már kész)
Az Observer már regisztrálva van az `AppServiceProvider`-ben, ezért minden új RequestQuote automatikusan elküldi magát a Notion-ba.

### 2. Aszinkron feldolgozás bekapcsolása
Ha az Observer-ben szeretnéd aszinkron használni:

```php
// RequestQuoteObserver.php-ban
public function created(RequestQuote $requestQuote): void
{
    // Szinkron küldés helyett:
    // $this->sendToNotionSync($requestQuote);
    
    // Aszinkron küldés:
    SendRequestQuoteToNotion::dispatch($requestQuote);
}
```

### 3. Queue worker indítása (aszinkron használathoz)
```bash
php artisan queue:work
```

### 4. Event használata (ha Observer helyett)
Ha az Event/Listener megoldást szeretnéd:

1. Regisztráld az EventServiceProvider-ben:

```php
// EventServiceProvider.php
protected $listen = [
    RequestQuoteCreated::class => [
        SendRequestQuoteToNotionListener::class,
    ],
];
```

2. A RequestQuote létrehozásakor indítsd el az eventet:

```php
// A RequestQuote létrehozásakor
$requestQuote = RequestQuote::create($data);
RequestQuoteCreated::dispatch($requestQuote);
```

## Tesztelés

### 1. Gyors teszt
Tinker segítségével tesztelhetjük a funkcionalitást:

```bash
php artisan tinker
```

```php
// Teszt RequestQuote létrehozása
$requestQuote = RequestQuote::factory()->create([
    'name' => 'Teszt Ügyfél',
    'email' => 'test@example.com',
    'phone' => '+36301234567'
]);

// Manuális küldés Notion-ba
$result = app(\App\Services\NotionService::class)->saveFormQuoteToNotion($requestQuote);
dd($result);
```

### 2. Teljes teszt Observer-rel
```php
// Új RequestQuote létrehozása automatikusan aktiválja az Observer-t
$requestQuote = RequestQuote::create([
    'name' => 'Automatikus Teszt',
    'email' => 'auto@test.com',
    'quotation_name' => 'Teszt Ajánlat',
    'client_type' => \App\Enums\ClientType::PRIVATE,
    'project_description' => 'Ez egy teszt projekt leírás'
]);
```

### 3. Queue Job tesztelése
```php
// Job kézi elindítása
\App\Jobs\SendRequestQuoteToNotion::dispatch($requestQuote);

// Queue feldolgozása
php artisan queue:work --once
```

## Konfiguráció

### .env fájl
```env
NOTION_API_SECRET=your_notion_integration_token
NOTION_REQUEST_QUOTE_DATABASE_ID=your_database_id
```

### config/notion.php
```php
return [
    'api_token' => env('NOTION_API_SECRET'),
    'databases' => [
        'request_quotes' => env('NOTION_REQUEST_QUOTE_DATABASE_ID'),
    ],
    'defaults' => [
        'status' => 'Új ajánlatkérés',
    ],
];
```

## Hibaelhárítás

### Gyakori hibák és megoldások

1. **"Property not found" hiba**
   - Ellenőrizd, hogy a Notion adatbázisban léteznek-e a megfelelő mezők
   - A mező nevek case-sensitive-ek!

2. **"Database not found" hiba**
   - Ellenőrizd a `NOTION_REQUEST_QUOTE_DATABASE_ID` környezeti változót
   - Győződj meg róla, hogy a Notion integration hozzáférhet az adatbázishoz

3. **"Invalid token" hiba**
   - Ellenőrizd a `NOTION_API_SECRET` környezeti változót
   - Újra generálhatsz egy új tokent a Notion integration beállításokban

### Debug mód bekapcsolása

```php
// Log-olás hozzáadása az Observer-hez
public function created(RequestQuote $requestQuote): void
{
    try {
        $result = app(\App\Services\NotionService::class)->saveFormQuoteToNotion($requestQuote);
        
        if ($result['success']) {
            \Log::info('RequestQuote successfully sent to Notion', [
                'request_quote_id' => $requestQuote->id,
                'notion_page_id' => $result['page_id'] ?? null
            ]);
        } else {
            \Log::error('Failed to send RequestQuote to Notion', [
                'request_quote_id' => $requestQuote->id,
                'error' => $result['error'] ?? 'Unknown error'
            ]);
        }
    } catch (\Exception $e) {
        \Log::error('Exception while sending RequestQuote to Notion', [
            'request_quote_id' => $requestQuote->id,
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
}
```

## Testreszabás és bővítés

### 1. Feltételes küldés
```php
// Observer módosítása csak bizonyos feltételek mellett
public function created(RequestQuote $requestQuote): void
{
    // Csak akkor küldjük el, ha megadott email címmel rendelkezik
    if ($requestQuote->email && $requestQuote->total_price > 0) {
        SendRequestQuoteToNotion::dispatch($requestQuote);
    }
}
```

### 2. Egyedi adatbázis használata
```php
// Különböző RequestQuote típusokhoz különböző adatbázisok
$databaseId = $requestQuote->websiteType?->name === 'Webshop' 
    ? config('notion.databases.webshop_quotes')
    : config('notion.databases.request_quotes');

$result = NotionFacade::saveFormQuoteToNotion($requestQuote, $databaseId);
```

### 3. További mezők hozzáadása
A `NotionService::saveFormQuoteToNotion` metódust bővítheted további mezőkkel:

```php
// Például user információk hozzáadása
if ($requestQuote->user) {
    $page->setText('Felhasználó neve', $requestQuote->user->name);
    $page->setEmail('Felhasználó email', $requestQuote->user->email);
}
```

## Összefoglalás

A RequestQuote automatikus Notion integráció most már teljes mértékben funkcionális és az összes RequestQuote mezőt küldi a Notion-ba. A rendszer rugalmas, támogatja mind a szinkron, mind az aszinkron feldolgozást, és könnyen testreszabható különböző igényekhez.

### Következő lépések:
1. Állítsd be a Notion API tokent és database ID-t a `.env` fájlban
2. Hozd létre a megfelelő mezőket a Notion adatbázisban
3. Teszteld a funkcionalitást egy új RequestQuote létrehozásával
4. Opcionálisan kapcsold be az aszinkron feldolgozást a jobb teljesítményért
