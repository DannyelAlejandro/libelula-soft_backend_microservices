<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

abstract class Service
{
    use ConsumesExternalService;

    public string $baseUri;
    
    public string $secret;

    public string $requestUrl;

    public function __construct(string $confService, string $secretService) {
        $this->baseUri = config($confService);
        $this->secret = config($secretService);
    }

    public function getItems($data = [])
    {
        return $this->performRequest('GET', $this->requestUrl, $data);
    }

    public function getItem($id)
    {
        return $this->performRequest('GET', $this->requestUrl.'/'.$id);
    }

    public function createItem($data)
    {
        return $this->performRequest('POST', $this->requestUrl, $data);
    }

    public function editItem($data, $id)
    {
        return $this->performRequest('PUT', $this->requestUrl.'/'.$id, $data);
    }

    public function deleteItem($id)
    {
        return $this->performRequest('DELETE', $this->requestUrl.'/'.$id);
    }
}
