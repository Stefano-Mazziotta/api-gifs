<?php

namespace App\Modules\Giphy\Infrastructure;

use App\Modules\Giphy\Domain\Repositories\GifRepositoryInterface;
use GuzzleHttp\Client;

class GiphyRepository implements GifRepositoryInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function searchGifs(string $query, int $limit = 25, int $offset = 0)
    {
        $response = $this->client->get(config('services.giphy.base_url') . '/search', [
            'query' => [
                'api_key' => config('services.giphy.api_key'),
                'q' => $query,
                'limit' => $limit,
                'offset' => $offset
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getGifById(string $id)
    {
        $response = $this->client->get(config('services.giphy.base_url') . "/" . $id, [
            'query' => [
                'api_key' => config('services.giphy.api_key')
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
