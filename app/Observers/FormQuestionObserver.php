<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\FormQuestion;
use Illuminate\Support\Facades\Storage;

final class FormQuestionObserver
{
    /**
     * Handle the FormQuestion "deleted" event.
     */
    public function deleted(FormQuestion $formQuestion): void
    {
        // Delete the logo file
        if ($formQuestion->logo) {
            Storage::disk('local')->delete($formQuestion->logo);
        }

        // Delete the design files
        if ($formQuestion->design_files) {
            foreach ($formQuestion->design_files as $file) {
                Storage::disk('local')->delete($file);
            }
        }

        if ($formQuestion->own_company_images) {
            foreach ($formQuestion->own_company_images as $file) {
                Storage::disk('local')->delete($file);
            }
        }

        if ($formQuestion->own_company_videos) {
            foreach ($formQuestion->own_company_videos as $file) {
                Storage::disk('local')->delete($file);
            }
        }

        // Delete any other files associated with the model
        // Add similar logic for other file fields if necessary
    }
}
