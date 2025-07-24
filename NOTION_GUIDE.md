# Notion API Használati Útmutató (Service Provider verzió)

## Beállítás

A projekt most teljes Service Provider architektúrával van felépítve:

1. **Service Provider**: `NotionServiceProvider` regisztrálja a service-t
2. **Config fájl**: `config/notion.php` központi konfigurációval
3. **Dependency Injection**: Automatikus injektálás controller-ekben és Livewire-ben
4. **Facade**: `NotionFacade` egyszerű statikus használathoz
5. **Logging**: Automatikus hibakezelés és naplózás

### Környezeti változók (.env)

```env
# Notion API konfiguráció
NOTION_API_TOKEN="your-notion-api-token"

# Notion adatbázis ID-k (opcionális - alapértelmezett adatbázisokhoz)
NOTION_QUOTES_DATABASE_ID="your-quotes-database-id"
NOTION_CUSTOMERS_DATABASE_ID="your-customers-database-id"
NOTION_PROJECTS_DATABASE_ID="your-projects-database-id"

# Hibakezelés
NOTION_LOG_ERRORS=true
NOTION_THROW_ON_ERROR=false
```

## Használati módok

### 1. Dependency Injection (Ajánlott)

#### Controller-ben:
```php
use App\Services\NotionService;

class MyController extends Controller
{
    public function __construct(
        private NotionService $notionService
    ) {}

    public function store()
    {
        $data = ['Név' => 'Teszt', 'Email' => 'test@example.com'];
        $result = $this->notionService->createSimpleEntry($data);
        // Database ID automatikusan a config-ból jön
    }
}
```

#### Livewire-ben:
```php
class MyComponent extends Component
{
    public function submit(NotionService $notionService)
    {
        $data = [...];
        $result = $notionService->createSimpleEntry($data);
    }
}
```

### 2. Facade használata (Gyors megoldás)

```php
use App\Facades\NotionFacade;

// Egyszerű adatok feltöltése
$result = NotionFacade::createSimpleEntry([
    'Név' => 'Teszt Ügyfél',
    'Email' => 'test@example.com'
]);

// RequestQuote mentése
$result = NotionFacade::saveFormQuoteToNotion($requestQuote);
```

### 3. Service Locator (Ha szükséges)

```php
$notionService = app(NotionService::class);
$result = $notionService->createSimpleEntry($data);
```

## Konfigurációs lehetőségek

### Alapértelmezett database ID beállítása

```php
// config/notion.php
'databases' => [
    'quotes' => env('NOTION_QUOTES_DATABASE_ID'),
    'customers' => env('NOTION_CUSTOMERS_DATABASE_ID'),
],
```

### Szolgáltatás specifikus database használata

```php
// Alapértelmezett database (config-ból)
$result = $notionService->createSimpleEntry($data);

// Specifikus database
$result = $notionService->createSimpleEntry($data, 'custom-database-id');
```

## Új funkciók

### Automatikus naplózás
- Sikeres feltöltések logolva a Laravel log-ba
- Hibák automatikusan naplózva
- Konfigurálható a `config/notion.php`-ban

### Hibakezelés
- Graceful error handling alapértelmezetten
- `NOTION_THROW_ON_ERROR=true` esetén exception dobás
- Részletes hibaüzenetek

### Config publikálása
```bash
php artisan vendor:publish --tag=notion-config
```

## Tesztelés

### Unit teszt példa:
```php
use App\Services\NotionService;

public function test_notion_upload()
{
    $mock = $this->mock(NotionService::class);
    $mock->shouldReceive('createSimpleEntry')
         ->once()
         ->andReturn(['success' => true, 'page_id' => 'test-id']);
    
    // Teszt logika...
}
```

### Feature teszt példa:
```php
public function test_notion_endpoint()
{
    $this->post('/notion/create-page', [
        'név' => 'Teszt',
        'email' => 'test@example.com'
    ])->assertJson(['success' => true]);
}
```

## Események és Queue

### Job-ban való használat:
```php
use App\Services\NotionService;

class ProcessNotionUpload implements ShouldQueue
{
    public function handle(NotionService $notionService): void
    {
        $result = $notionService->createSimpleEntry($this->data);
        
        if (!$result['success']) {
            $this->fail('Notion upload failed: ' . $result['error']);
        }
    }
}
```

### Event listener:
```php
class SendToNotion
{
    public function __construct(
        private NotionService $notionService
    ) {}

    public function handle(RequestQuoteCreated $event): void
    {
        $this->notionService->saveFormQuoteToNotion($event->requestQuote);
    }
}
```

## Előnyök a Service Provider megközelítésnek

1. **Központi konfiguráció**: Minden beállítás egy helyen
2. **Dependency Injection**: Laravel container automatikusan kezeli
3. **Singleton pattern**: Egy példány az egész alkalmazásban
4. **Tesztelhetőség**: Könnyű mockolni és tesztelni
5. **Facade támogatás**: Egyszerű statikus használat
6. **Automatikus regisztráció**: Laravel automatikusan betölti
7. **Config publikálás**: Testreszabható konfigurációk

Ez a megközelítés sokkal professzionálisabb és Laravel-szerűbb!
