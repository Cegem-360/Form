<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\NotionService;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class NotionUpload extends Component
{
    #[Validate('required|string|max:255')]
    public string $név = '';

    #[Validate('nullable|email')]
    public string $email = '';

    #[Validate('nullable|string')]
    public string $telefon = '';

    #[Validate('nullable|numeric')]
    public ?float $ár = null;

    #[Validate('nullable|string')]
    public string $megjegyzés = '';

    public string $message = '';

    public bool $success = false;

    public function submit(NotionService $notionService): void
    {
        $this->validate();

        $data = [
            'Név' => $this->név,
            'Email' => $this->email ?: null,
            'Telefonszám' => $this->telefon ?: null,
            'Ár' => $this->ár,
            'Megjegyzés' => $this->megjegyzés ?: null,
        ];

        // Üres értékek eltávolítása
        $data = array_filter($data, fn (float|string|null $value): bool => $value !== null && $value !== '');

        // Most nem kell database ID-t megadni, ha van alapértelmezett config-ban
        $result = $notionService->createSimpleEntry($data);

        if ($result['success']) {
            $this->success = true;
            $this->message = 'Sikeresen feltöltve a Notion-ba! Page ID: '.$result['page_id'];
            $this->reset(['név', 'email', 'telefon', 'ár', 'megjegyzés']);
        } else {
            $this->success = false;
            $this->message = 'Hiba történt: '.$result['error'];
        }
    }

    public function render()
    {
        return view('livewire.notion-upload');
    }
}
