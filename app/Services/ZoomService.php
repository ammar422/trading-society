<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZoomService
{
    protected $client;
    protected $zoomClientId;
    protected $zoomClientSecret;
    protected $zoomAccountId;
    protected $zoomApiUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->zoomClientId = config('services.zoom.client_id');
        $this->zoomClientSecret = config('services.zoom.client_secret');
        $this->zoomAccountId = config('services.zoom.account_id');
        $this->zoomApiUrl = config('services.zoom.api_url');
    }
    
    public function getClient()
    {
        return $this->client;
    }

    public function getAccessToken()
    {
        $response = $this->client->post($this->zoomApiUrl, [
            'auth' => [$this->zoomClientId, $this->zoomClientSecret],
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => $this->zoomAccountId,
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return $data['access_token'];
    }
}
