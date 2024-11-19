<?php

namespace App\Modules\Giphy\Domain\Repositories;

interface GifRepositoryInterface
{
    public function searchGifs(string $query, int $limit = 25, int $offset = 0);
    public function getGifById(string $id);
}
