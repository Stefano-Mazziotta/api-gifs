<?php

namespace App\Modules\Gif\Infrastructure;

use App\Modules\Gif\Domain\GifRepositoryInterface;
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

    public function SaveFavoriteGif(int $gifId, string $alias, int $userId)
    {
        // Save the favorite gif to the database
    }
}
