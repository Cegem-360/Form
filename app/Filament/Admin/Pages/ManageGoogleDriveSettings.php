<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

/**
 * @property-read Schema $form
 */
final class ManageGoogleDriveSettings extends Page
{
    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cloud-arrow-up';

    protected static string|UnitEnum|null $navigationGroup = 'Beállítások';

    protected static ?string $title = 'Google Drive Beállítások';

    protected static ?string $navigationLabel = 'Google Drive';

    protected string $view = 'filament.admin.pages.manage-google-drive-settings';

    public function mount(): void
    {
        $this->form->fill($this->getSettingsData());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Google Drive API Beállítások')
                    ->description('Konfigurálja a Google Drive API integrációt a dokumentumok automatikus feltöltéséhez.')
                    ->schema([
                        Toggle::make('enabled')
                            ->label('Google Drive engedélyezése')
                            ->helperText('Ha ki van kapcsolva, a rendszer PDF letöltést fog használni.'),

                        FileUpload::make('credentials_file')
                            ->label('Google Service Account JSON')
                            ->helperText('Töltse fel a Google Service Account credentials JSON fájlját.')
                            ->acceptedFileTypes(['application/json'])
                            ->directory('google-credentials')
                            ->visibility('private')
                            ->disk('local'),

                        TextInput::make('application_name')
                            ->label('Alkalmazás neve')
                            ->default('Laravel Project Completion')
                            ->required(),

                        Textarea::make('instructions')
                            ->label('Beállítási útmutató')
                            ->default($this->getInstructions())
                            ->disabled()
                            ->rows(10),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Save settings to .env or configuration
        $this->saveSettings($data);

        Notification::make()
            ->success()
            ->title('Beállítások mentve!')
            ->body('A Google Drive beállítások sikeresen mentve lettek.')
            ->send();
    }

    private function getSettingsData(): array
    {
        return [
            'enabled' => config('services.google_drive.enabled', false),
            'application_name' => '"'.config('services.google_drive.application_name', 'Laravel Project Completion').'"',
            'credentials_file' => $this->getExistingCredentialsFile(),
        ];
    }

    private function getExistingCredentialsFile(): ?string
    {
        if (Storage::exists('google-credentials.json')) {
            return 'google-credentials.json';
        }

        return null;
    }

    private function saveSettings(array $data): void
    {
        // Handle credentials file
        if (isset($data['credentials_file']) && $data['credentials_file']) {
            $uploadedFile = $data['credentials_file'];

            // Move the uploaded file to the correct location
            if (is_array($uploadedFile) && isset($uploadedFile[0])) {
                $filename = $uploadedFile[0];
                Storage::move($filename, 'google-credentials.json');
            } elseif (is_string($uploadedFile)) {
                Storage::move($uploadedFile, 'google-credentials.json');
            }
        }

        // Update .env file
        $this->updateEnvFile([
            'GOOGLE_DRIVE_ENABLED' => $data['enabled'] ? 'true' : 'false',
            'GOOGLE_APPLICATION_NAME' => isset($data['application_name']) ? '"'.mb_trim($data['application_name'], '"').'"' : '"Laravel Project Completion"',
        ]);
    }

    private function updateEnvFile(array $values): void
    {
        $envPath = base_path('.env');

        if (! file_exists($envPath)) {
            return;
        }

        $envContent = file_get_contents($envPath);

        foreach ($values as $key => $value) {
            $pattern = sprintf('/^%s=.*$/m', $key);
            $replacement = sprintf('%s=%s', $key, $value);

            if (preg_match($pattern, $envContent)) {
                // Key exists, update it
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                // Key doesn't exist, add it
                $envContent .= PHP_EOL.$replacement;
            }
        }

        file_put_contents($envPath, $envContent);

        // Clear config cache so changes take effect
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
    }

    private function getInstructions(): string
    {
        return 'Google Drive API beállítás lépései:

1. Google Cloud Console beállítás:
   - Menj a Google Cloud Console-ra (https://console.cloud.google.com/)
   - Hozz létre egy projektet vagy válassz ki egy meglévőt
   - Engedélyezd a Google Drive API-t és Google Docs API-t

2. Service Account létrehozása:
   - Navigálj az "IAM & Admin" > "Service Accounts" menüpontra
   - Hozz létre egy új Service Account-ot
   - Adj neki Editor vagy Owner szerepkört

3. Credentials letöltése:
   - Kattints a Service Account-ra
   - Menj a "Keys" tabra
   - Hozz létre egy új JSON kulcsot
   - Töltsd le a JSON fájlt

4. JSON fájl feltöltése:
   - Töltsd fel a letöltött JSON fájlt a fenti mezőbe
   - Kapcsold be a Google Drive engedélyezését
   - Mentsd el a beállításokat

Biztonsági megjegyzések:
- A JSON fájl bizalmas információkat tartalmaz
- Soha ne oszd meg mással
- A fájl automatikusan titkosítva lesz tárolva';
    }
}
