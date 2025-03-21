<?php

declare(strict_types=1);

namespace App\Helper;

class ContentBuilder
{
    public function __construct(private string $content) {}

    public static function buildContent(string|int $id, array $data): string
    {
        $content = '';
        $content = match (true) {
            $id == 53 => self::buildContentToHomeHeroTitle($data['companyName']),
            $id == 58 => self::buildContentToHomeHeroDesciption(),
            default => $content,
        };

        return $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    // id: 53
    public static function buildContentToHomeHeroTitle(string $companyName = ''): string
    {
        return 'Címsorhoz tartalom ' . $companyName . ' maximum 50 karakter hosszúságban.';
    }

    // id: 58
    public static function buildContentToHomeHeroDesciption(string $shortContent = ''): string
    {
        return 'A címsorhoz a következő tartalom tartozik: ' . $shortContent;
    }
}
