<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Throwable;

final class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'permissions:sync {--clean : Remove permissions not present in generated set}';

    /**
     * The console command description.
     */
    protected $description = 'Synchronise permissions from configuration and models (lightweight fallback)';

    public function handle(Filesystem $fs): int
    {
        $this->info('Starting permissions:sync');

        $cfg = config('filament-spatie-roles-permissions.generator', []);

        $modelDirs = $cfg['model_directories'] ?? [app_path('Models')];
        $affixes = array_values($cfg['permission_affixes'] ?? []);
        $guardNames = $cfg['guard_names'] ?? [$cfg['default_guard_name'] ?? 'web'];
        $customPermissions = $cfg['custom_permissions'] ?? [];

        // Collect model basenames from configured directories
        $models = [];
        foreach ($modelDirs as $dir) {
            if (! $fs->isDirectory($dir)) {
                continue;
            }

            $files = $fs->allFiles($dir);
            foreach ($files as $file) {
                if ($file->getExtension() !== 'php') {
                    continue;
                }

                $models[] = Str::studly($file->getBasename('.php'));
            }
        }

        // Build permission names
        $names = [];
        foreach ($models as $modelName) {
            foreach ($affixes as $affix) {
                // default naming mirrors the package's typical behaviour: "{affix} {ModelName}"
                $names[] = mb_trim($affix.' '.$modelName);
            }
        }

        // Merge custom permissions
        foreach ($customPermissions as $perm) {
            $names[] = (string) $perm;
        }

        $names = array_values(array_unique(array_filter($names)));

        if ($names === []) {
            $this->line('No permissions generated from config/model directories.');
            if (! empty($customPermissions)) {
                $this->line('Custom permissions were provided but empty after filtering.');
            }

            return self::SUCCESS;
        }

        $created = 0;
        try {
            foreach ($guardNames as $guard) {
                foreach ($names as $name) {
                    $perm = Permission::firstOrCreate(['name' => $name, 'guard_name' => $guard]);
                    if ($perm->wasRecentlyCreated ?? false) {
                        $created++;
                    }
                }
            }
        } catch (Throwable $throwable) {
            // DB not ready (migrations not run) or similar - don't fail the whole process
            $this->warn('Could not persist permissions to DB: '.$throwable->getMessage());
            $this->warn('permissions:sync completed in dry-run mode.');
            $this->info('Generated permissions (count): '.count($names));

            return self::SUCCESS;
        }

        $this->info('Permissions synced. Created: '.$created.', Total generated: '.count($names));

        if ($this->option('clean')) {
            try {
                $existing = Permission::all();
                $toRemove = $existing->reject(fn (Permission $p): bool => in_array($p->name, $names, true));
                $deleted = 0;
                foreach ($toRemove as $rem) {
                    $rem->delete();
                    $deleted++;
                }

                $this->info('Cleaned up permissions not in generated set: '.$deleted);
            } catch (Throwable $e) {
                $this->warn('Could not perform clean: '.$e->getMessage());
            }
        }

        return self::SUCCESS;
    }
}
