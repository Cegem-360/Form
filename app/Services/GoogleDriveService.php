<?php

declare(strict_types=1);

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Docs;
use Google\Service\Drive;
use Google\Service\Docs\BatchUpdateDocumentRequest;
use Google\Service\Docs\InsertTextRequest;
use Google\Service\Docs\Location;
use Google\Service\Docs\Request;
use Exception;

final class GoogleDriveService
{
    private GoogleClient $client;
    private Drive $driveService;
    private Docs $docsService;

    public function __construct()
    {
        $this->client = new GoogleClient();
        $this->setupClient();
        
        $this->driveService = new Drive($this->client);
        $this->docsService = new Docs($this->client);
    }

    /**
     * Create a Google Doc with project completion data and return the document URL
     */
    public function createProjectCompletionDocument(array $data): string
    {
        try {
            // Create a new Google Doc
            $document = $this->createDocument($data['title'] ?? 'Projekt Teljesítési Igazolás');
            
            // Insert content into the document
            $this->insertContentIntoDocument($document->getDocumentId(), $data);
            
            // Make the document publicly viewable (optional)
            $this->makeDocumentViewable($document->getDocumentId());
            
            // Return the Google Docs URL
            return "https://docs.google.com/document/d/{$document->getDocumentId()}/edit";
            
        } catch (Exception $e) {
            throw new Exception("Failed to create Google Doc: " . $e->getMessage());
        }
    }

    /**
     * Setup Google Client with credentials
     */
    private function setupClient(): void
    {
        // Check if Google Drive is enabled
        if (!config('services.google_drive.enabled')) {
            throw new Exception('Google Drive integration is disabled. Enable it in the settings.');
        }

        $this->client->setApplicationName(config('services.google_drive.application_name'));
        
        // Set up authentication
        $credentialsPath = config('services.google_drive.credentials_path');
        
        if (!file_exists($credentialsPath)) {
            throw new Exception('Google credentials file not found. Please upload the credentials file in the Google Drive settings.');
        }
        
        $this->client->setAuthConfig($credentialsPath);
        $this->client->addScope([
            Drive::DRIVE_FILE,
            Docs::DOCUMENTS,
        ]);
        
        // For server-to-server applications, you might want to use service account
        $this->client->useApplicationDefaultCredentials();
    }

    /**
     * Create a new Google Document
     */
    private function createDocument(string $title): \Google\Service\Docs\Document
    {
        $document = new \Google\Service\Docs\Document();
        $document->setTitle($title);
        
        return $this->docsService->documents->create($document);
    }

    /**
     * Insert content into the Google Document
     */
    private function insertContentIntoDocument(string $documentId, array $data): void
    {
        $content = $this->formatContentForGoogleDocs($data);
        
        $requests = [];
        
        // Insert text at the beginning of the document
        $requests[] = new Request([
            'insertText' => new InsertTextRequest([
                'location' => new Location(['index' => 1]),
                'text' => $content
            ])
        ]);
        
        $batchUpdateRequest = new BatchUpdateDocumentRequest([
            'requests' => $requests
        ]);
        
        $this->docsService->documents->batchUpdate($documentId, $batchUpdateRequest);
    }

    /**
     * Make document viewable by anyone with the link
     */
    private function makeDocumentViewable(string $documentId): void
    {
        $permission = new \Google\Service\Drive\Permission();
        $permission->setType('anyone');
        $permission->setRole('reader');
        
        $this->driveService->permissions->create($documentId, $permission);
    }

    /**
     * Format content for Google Docs
     */
    private function formatContentForGoogleDocs(array $data): string
    {
        $content = "PROJEKT TELJESÍTÉSI IGAZOLÁS\n\n";
        
        // Add project information
        if (isset($data['content']['sections'])) {
            foreach ($data['content']['sections'] as $section) {
                $content .= strtoupper($section['title']) . "\n";
                $content .= str_repeat("=", strlen($section['title'])) . "\n\n";
                
                if (is_array($section['content'])) {
                    foreach ($section['content'] as $key => $value) {
                        if (is_string($key)) {
                            $content .= $key . ": " . (is_array($value) ? implode(", ", $value) : $value) . "\n";
                        } else {
                            $content .= "• " . (is_array($value) ? implode(" - ", $value) : $value) . "\n";
                        }
                    }
                } else {
                    $content .= $section['content'] . "\n";
                }
                
                $content .= "\n";
            }
        }
        
        // Add footer
        if (isset($data['content']['footer'])) {
            $content .= "\n" . str_repeat("-", 50) . "\n";
            foreach ($data['content']['footer'] as $key => $value) {
                $content .= $key . ": " . $value . "\n";
            }
        }
        
        return $content;
    }
}
