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
            'activities' => [
                ['name' => 'Web development'],
                ['name' => 'Web design'],
                ['name' => 'SEO'],
                ['name' => 'Content writing'],
            ],
            'main_pages' => [
                [
                    'name' => 'Főoldal',
                    'description' => 'This is the Főoldal page of the website',
                ],
                [
                    'name' => 'Rólunk',
                    'description' => 'This is the Rólunk page of the website',
                ],
                [
                    'name' => 'Kapcsolat',
                    'description' => 'This is the Kapcsolat page of the website',
                ],
                [
                    'name' => 'Szolgáltatások',
                    'description' => 'This is the Szolgáltatások page of the website',
                ],
            ],
        ]);
    }
}
