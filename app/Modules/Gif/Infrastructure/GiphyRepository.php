<?php

namespace App\Modules\Gif\Infrastructure;

use App\Modules\Auth\Domain\Models\User;
use App\Modules\Gif\Domain\GifRepositoryInterface;
use App\Modules\Gif\Domain\Models\Gif;
use GuzzleHttp\Client;

class GiphyRepository implements GifRepositoryInterface
{
    private $client;
    private $apiKey;
    private $baseUrl;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = config('services.giphy.api_key');
        $this->baseUrl = config('services.giphy.base_url');
    }

    public function searchGifs(string $query, int $limit = 25, int $offset = 0)
    {
        $response = $this->client->get($this->baseUrl . '/search', [
            'query' => [
                'api_key' => $this->apiKey,
                'q' => $query,
                'limit' => $limit,
                'offset' => $offset
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getGifById(string $id)
    {
        $response = $this->client->get($this->baseUrl . "/" . $id, [
            'query' => [
                'api_key' => $this->apiKey
            ]
        ]);

        $content = json_decode($response->getBody()->getContents(), true);
        if (!$content['data']['id'] == $id) {
            throw new \Exception('Gif not found');
        }

        return $content;
    }

    public function SaveFavoriteGif(string $gifId, string $alias, int $userId)
    {

        // verify if user has already saved this gif
        $user = User::find($userId);

        $localGif = Gif::where('gif_id', $gifId)->first();

        if (!isset($localGif)) {
            $externalGif = $this->getGifById($gifId);

            if (!isset($externalGif['data'])) {
                throw new \Exception('Gif not found');
            }

            $externalGifData = $externalGif['data'];

            $localGif = Gif::create([
                'gif_id' => $gifId,
                'title' => $alias,
                'url' => $externalGifData['images']['original']['url'],
            ]);
        }

        if ($user->favoriteGifs()->where('user_favorite_gifs.gif_id', $localGif->id)->exists()) {
            throw new \Exception('Gif already saved');
        }

        // create a relation between user and gif
        $user->favoriteGifs()->attach($localGif->id);

        return $localGif;
    }
}
