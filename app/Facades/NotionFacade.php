<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\NotionService;
use FiveamCode\LaravelNotionApi\Entities\Page;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array createPageInDatabase(?string $databaseId, Page $page)
 * @method static array createChildPage(string $parentPageId, string $title)
 * @method static array queryDatabase(string $databaseId)
 * @method static array updatePage(Page $page)
 * @method static array saveFormQuoteToNotion($requestQuote, ?string $databaseId = null)
 * @method static array createSimpleEntry(array $data, ?string $databaseId = null)
 * @method static array getPage(string $pageId)
 */
final class NotionFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NotionService::class;
    }
}
