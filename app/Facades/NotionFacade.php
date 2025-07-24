<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array createPageInDatabase(?string $databaseId, \FiveamCode\LaravelNotionApi\Entities\Page $page)
 * @method static array createChildPage(string $parentPageId, string $title)
 * @method static array queryDatabase(string $databaseId)
 * @method static array updatePage(\FiveamCode\LaravelNotionApi\Entities\Page $page)
 * @method static array saveFormQuoteToNotion($requestQuote, ?string $databaseId = null)
 * @method static array createSimpleEntry(array $data, ?string $databaseId = null)
 * @method static array getPage(string $pageId)
 */
final class NotionFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\NotionService::class;
    }
}
