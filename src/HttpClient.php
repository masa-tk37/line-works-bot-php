<?php

namespace Apricot\LineWorks;

use GuzzleHttp\Client;

class HttpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var array
     */
    private $headers;

    public function __construct($consumerKey, $token = null)
    {
        $this->client = new Client();
        $this->headers = [
            'consumerKey' => $consumerKey,
        ];
        if (! is_null($token)) {
            $this->setToken($token);
        }
    }

    public function setToken($token) {
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }

    public function post($uri, array $data)
    {
        return $this->client->post($uri, [
            'headers' => $this->headers,
            'json' => $data,
        ]);
    }
}
