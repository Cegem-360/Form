<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\FormQuestion;
use Illuminate\Contracts\View\View;

class FormSubmissionController extends Controller
{
    public function review(FormQuestion $form): View
    {
        // Get the form data from the session
        $formData = $form->toArray();

        // Return the view with the form data
        return view('form-review', ['formData' => $formData]);
    }
}
