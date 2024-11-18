<?php

namespace App\Modules\Giphy\Application;

use GuzzleHttp\Client;

class GetGifById
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.giphy.com/v1/']);
    }

    public function execute($id)
    {
        $response = $this->client->get("gifs/$id", [
            'query' => [
                'api_key' => env('GIPHY_API_KEY'),
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
