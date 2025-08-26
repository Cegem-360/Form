<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

final class ProjectCompletionDocumentService
{
    public function __construct(
        private Project $project
    ) {}


    /**
     * Generate PDF document for project completion
     */
    public function generatePdf(): Response
    {
        $data = $this->prepareDocumentData();

        $pdf = Pdf::loadView('pdf.project-completion', $data);
        $pdf->setPaper('A4', 'portrait');
        // Use global configuration from config/dompdf.php which has convert_entities disabled

        $filename = 'project-completion-'.$this->project->id.'-'.now()->format('Y-m-d').'.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export document directly to Google Drive and return URL
     */
    public function exportForGoogleDocs(): string
    {
        return $this->createGoogleDoc();
    }

    /**
     * Create Google Doc and return the document URL
     */
    public function createGoogleDoc(): string
    {
        $data = $this->prepareGoogleDocsData();
        $googleDriveService = new GoogleDriveService();
        
        return $googleDriveService->createProjectCompletionDocument($data);
    }

    /**
     * Prepare data specifically for Google Docs creation
     */
    private function prepareGoogleDocsData(): array
    {
        $data = $this->prepareDocumentData();

        return [
            'title' => 'Projekt Teljesítési Igazolás - '.$this->project->name,
            'content' => $this->formatForGoogleDocs($data),
            'metadata' => [
                'project_id' => $this->project->id,
                'generated_at' => now()->toIso8601String(),
                'type' => 'project_completion_certificate',
            ],
        ];
    }

    /**
     * Format data for Google Docs export
     */
    private function formatForGoogleDocs(array $data): array
    {
        return [
            'sections' => [
                [
                    'title' => 'Projekt Információk',
                    'content' => [
                        'Projekt neve' => $data['project']->name,
                        'Projekt azonosító' => $data['project']->id,
                        'Kezdés dátuma' => $data['start_date']?->format('Y. m. d.'),
                        'Befejezés dátuma' => $data['completion_date']->format('Y. m. d.'),
                        'Projekt időtartama' => $data['project_duration'].' nap',
                        'Státusz' => $data['project']->status->value ?? 'Befejezett',
                    ],
                ],
                [
                    'title' => 'Ügyfél Adatok',
                    'content' => [
                        'Ügyfél neve' => $data['client']->name ?? 'N/A',
                        'Email' => $data['client']->email ?? 'N/A',
                        'Kapcsolattartó' => $data['contact_person']->name ?? 'N/A',
                    ],
                ],
                [
                    'title' => 'Teljesített Elemek',
                    'content' => $data['completed_elements'],
                ],
                [
                    'title' => 'Megoldott Problémák',
                    'content' => $data['solved_problems'],
                ],
                [
                    'title' => 'Nem Tartalmazott Elemek',
                    'content' => $data['not_contained_elements'],
                ],
                [
                    'title' => 'Garancia Információ',
                    'content' => $data['garanty_info'] ?? 'Nincs megadva',
                ],
                [
                    'title' => 'Support Csomag',
                    'content' => $data['support_pack'] ? [
                        'Csomag neve' => $data['support_pack']->name,
                        'Leírás' => $data['support_pack']->description,
                    ] : 'Nincs support csomag',
                ],
            ],
            'footer' => [
                'Dokumentum száma' => $data['document_number'],
                'Készítés dátuma' => $data['document_generated_at']->format('Y. m. d. H:i'),
            ],
        ];
    }

    /**
     * Save PDF to storage
     */
    public function savePdfToStorage(): string
    {
        $data = $this->prepareDocumentData();

        $pdf = Pdf::loadView('pdf.project-completion', $data);
        $pdf->setPaper('A4', 'portrait');
        // Use global configuration from config/dompdf.php which has convert_entities disabled

        $filename = 'project-completions/project-completion-'.$this->project->id.'-'.now()->format('Y-m-d-His').'.pdf';

        Storage::put($filename, $pdf->output());

        return $filename;
    }

    /**
     * Prepare data for document generation
     */
    private function prepareDocumentData(): array
    {
        $this->project->load([
            'user',
            'contact',
            'requestQuote',
            'order',
            'supportPack',
            'contactChannel',
        ]);

        // Create safe data array with UTF-8 cleaned values
        $data = [
            'project' => (object) [
                'id' => $this->project->id,
                'name' => $this->ensureUtf8Encoding($this->project->name ?? ''),
                'project_goal' => $this->ensureUtf8Encoding($this->project->project_goal ?? ''),
                'status' => $this->project->status,
            ],
            'client' => $this->project->user ? (object) [
                'name' => $this->ensureUtf8Encoding($this->project->user->name ?? ''),
                'email' => $this->ensureUtf8Encoding($this->project->user->email ?? ''),
            ] : null,
            'contact_person' => $this->project->contact ? (object) [
                'name' => $this->ensureUtf8Encoding($this->project->contact->name ?? ''),
            ] : null,
            'request_quote' => $this->project->requestQuote ? (object) [
                'company_name' => $this->ensureUtf8Encoding($this->project->requestQuote->company_name ?? ''),
            ] : null,
            'order' => $this->project->order,
            'support_pack' => $this->project->supportPack ? (object) [
                'name' => $this->ensureUtf8Encoding($this->project->supportPack->name ?? ''),
                'description' => $this->ensureUtf8Encoding($this->project->supportPack->description ?? ''),
            ] : null,
            'completion_date' => $this->project->end_date ?? now(),
            'start_date' => $this->project->start_date,
            'project_duration' => $this->calculateProjectDuration(),
            'completed_elements' => $this->ensureUtf8Encoding($this->project->completed_project_elements ?? []),
            'not_contained_elements' => $this->ensureUtf8Encoding($this->project->project_not_contained_elements ?? []),
            'solved_problems' => $this->ensureUtf8Encoding($this->project->solved_problems ?? []),
            'garanty_info' => $this->ensureUtf8Encoding($this->project->garanty ?? ''),
            'document_generated_at' => now(),
            'document_number' => $this->generateDocumentNumber(),
        ];

        return $data;
    }

    /**
     * Calculate project duration in days
     */
    private function calculateProjectDuration(): int
    {
        if (! $this->project->start_date) {
            return 0;
        }

        $endDate = $this->project->end_date ?? now();

        return (int) Carbon::parse($this->project->start_date)->diffInDays($endDate);
    }

    /**
     * Generate unique document number
     */
    private function generateDocumentNumber(): string
    {
        return sprintf(
            'PTI-%s-%s-%s',
            now()->format('Y'),
            mb_str_pad((string) $this->project->id, 6, '0', STR_PAD_LEFT),
            now()->format('md')
        );
    }

    /**
     * Ensure proper UTF-8 encoding for string values
     */
    private function ensureUtf8Encoding(mixed $value): mixed
    {
        if (is_string($value)) {
            // Just ensure it's valid UTF-8, don't be too aggressive
            $cleaned = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
            // Only remove null bytes which can cause issues
            $cleaned = str_replace("\0", '', $cleaned);

            return $cleaned !== '' ? $cleaned : 'N/A';
        }

        if (is_array($value)) {
            return array_map(fn ($item) => $this->ensureUtf8Encoding($item), $value);
        }

        if (is_object($value) && method_exists($value, '__toString')) {
            return $this->ensureUtf8Encoding((string) $value);
        }

        return $value;
    }

}
