<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService extends Service
{
    use ConsumesExternalService;

    public function __construct() {
        parent::__construct('services.books.base_uri', 'services.books.secret');
        $this->requestUrl = 'books';
    }
}
