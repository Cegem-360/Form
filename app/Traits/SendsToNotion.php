<?php

declare(strict_types=1);

namespace App\Traits;

use App\Services\NotionService;
use Exception;
use Illuminate\Support\Facades\Log;

trait SendsToNotion
{
    /**
     * Elküldi a modelt a Notion-ba
     */
    public function sendToNotion(): void
    {
        try {
            $notionService = app(NotionService::class);

            if (method_exists($this, 'toNotionData')) {
                // Egyedi adatformátum a modelből
                $data = $this->toNotionData();
                $result = $notionService->createSimpleEntry($data, $this->getNotionDatabaseId());
            } else {
                // Alapértelmezett formátum
                $result = $this->sendDefaultToNotion($notionService);
            }

            if ($result['success']) {
                Log::info('Model sikeresen elküldve Notion-ba', [
                    'model' => get_class($this),
                    'model_id' => $this->id,
                    'notion_page_id' => $result['page_id'],
                ]);
            } else {
                Log::error('Model küldése sikertelen Notion-ba', [
                    'model' => get_class($this),
                    'model_id' => $this->id,
                    'error' => $result['error'],
                ]);
            }
        } catch (Exception $e) {
            Log::error('Hiba a model Notion küldésekor', [
                'model' => get_class($this),
                'model_id' => $this->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Boot the trait
     */
    protected static function bootSendsToNotion(): void
    {
        static::created(function ($model) {
            $model->sendToNotion();
        });
    }

    /**
     * Alapértelmezett Notion küldés
     */
    protected function sendDefaultToNotion(NotionService $notionService): array
    {
        $data = [
            'ID' => $this->id,
            'Létrehozva' => $this->created_at,
            'Frissítve' => $this->updated_at,
        ];

        return $notionService->createSimpleEntry($data, $this->getNotionDatabaseId());
    }

    /**
     * Notion adatbázis ID meghatározása
     */
    protected function getNotionDatabaseId(): ?string
    {
        // Override ezt a metódust a modelekben
        return null;
    }
}
