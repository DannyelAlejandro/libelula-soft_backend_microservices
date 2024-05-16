<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $formParams = [], $headers = []) : string
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret))
            $headers['Authorization'] = $this->secret;

        $aux = ($method == 'GET') ? 'query' : 'form_params';

        $options = [
            $aux => $formParams,
            'headers' => $headers
        ];

        $response = $client->request($method, $requestUrl, $options);

        return $response->getBody()->getContents();
    }
}
