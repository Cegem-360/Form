<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Domain;
use App\Models\FormQuestion;

class DomainObserver
{
    public function created(Domain $domain)
    {
        FormQuestion::create([
            'domain_id' => $domain->id,
            'main_pages' => [
                [
                    'name' => 'Home',
                    'description' => 'This is the Home page of the website',
                ],
                [
                    'name' => 'About',
                    'description' => 'This is the About page of the website',
                ],
                [
                    'name' => 'Contact',
                    'description' => 'This is the Contact page of the website',
                ],
                [
                    'name' => 'Services',
                    'description' => 'This is the Services page of the website',
                ],
                [
                    'name' => 'Blog',
                    'description' => 'This is the Blog page of the website',
                ],
            ],
        ]);
    }
}
