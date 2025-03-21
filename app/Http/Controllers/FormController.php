<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class FormController extends Controller
{
    public function expired()
    {
        return view('form.expired');
    }
}
