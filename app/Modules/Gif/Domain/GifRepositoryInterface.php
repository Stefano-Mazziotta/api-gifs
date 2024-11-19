<?php

namespace App\Modules\Gif\Domain;

interface GifRepositoryInterface
{
    public function searchGifs(string $query, int $limit = 25, int $offset = 0);
    public function getGifById(string $id);
    public function saveFavoriteGif(string $gifId, string $alias, int $userId);
}
