<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService extends Service
{
    use ConsumesExternalService;

    public function __construct() {
        parent::__construct('services.authors.base_uri', 'services.authors.secret');
        $this->requestUrl = 'authors';
    }
}
