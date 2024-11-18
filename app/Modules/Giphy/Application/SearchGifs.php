<?php

namespace App\Modules\Giphy\Application;

use GuzzleHttp\Client;

class SearchGifs
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.giphy.com/v1/']);
    }

    public function execute($query, $limit = 25, $offset = 0)
    {
        $response = $this->client->get('gifs/search', [
            'query' => [
                'api_key' => env('GIPHY_API_KEY'),
                'q' => $query,
                'limit' => $limit,
                'offset' => $offset,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
