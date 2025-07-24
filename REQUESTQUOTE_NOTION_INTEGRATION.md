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

1. Távolítsd el az Observer regisztrációját az `AppServiceProvider`-ből
2. Regisztráld az Event/Listener párost az `EventServiceProvider`-ben:

```php
// EventServiceProvider.php
protected $listen = [
    RequestQuoteCreated::class => [
        SendRequestQuoteToNotionListener::class,
    ],
];
```

3. A RequestQuote létrehozásakor indítsd el az eventet:

```php
// A GuestShowQuaotationForm.php-ban vagy ahol a RequestQuote létrejön
$requestQuote = RequestQuote::create($data);
RequestQuoteCreated::dispatch($requestQuote);
```

## Testreszabás

### NotionService bővítése RequestQuote-ra
A `saveFormQuoteToNotion` metódus már készen van a RequestQuote specifikus mezőkre:

- Név (Title)
- Email
- Telefonszám  
- Weboldal típus
- Teljes ár
- Státusz
- Létrehozás dátuma

### További mezők hozzáadása
Frissítsd a `NotionService::saveFormQuoteToNotion` metódust:

```php
// További mezők a Notion-ban
if (!empty($requestQuote->company_name)) {
    $page->setText('Cég neve', $requestQuote->company_name);
}

if (!empty($requestQuote->project_description)) {
    $page->setText('Projekt leírás', $requestQuote->project_description);
}

if (!empty($requestQuote->website_engine)) {
    $page->setSelect('Website Engine', $requestQuote->website_engine);
}
```

## Monitoring és hibakezelés

### Logok ellenőrzése
```bash
tail -f storage/logs/laravel.log | grep "RequestQuote"
```

### Queue hibák
```bash
php artisan queue:failed
php artisan queue:retry all
```

### Notion kapcsolat tesztelése
```bash
# Tesztelés a browser-ben
GET /notion/test-upload
```

## Környezeti változók
Győződj meg róla, hogy a `.env` fájlban be vannak állítva:

```env
NOTION_API_TOKEN="your-token"
NOTION_QUOTES_DATABASE_ID="your-database-id"
NOTION_LOG_ERRORS=true
```

## Produkció használatához

1. **Queue driver beállítása**:
```env
QUEUE_CONNECTION=redis  # vagy database
```

2. **Queue worker szolgáltatás**:
```bash
# Supervisor vagy systemd beállítása
php artisan queue:work --tries=3 --timeout=60
```

3. **Monitoring**:
- Laravel Horizon (Redis queue-hoz)
- Queue monitoring dashboard

Ez a megoldás most már automatikusan működik minden új RequestQuote létrehozásakor!
