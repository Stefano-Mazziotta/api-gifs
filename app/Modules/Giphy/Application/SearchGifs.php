<?php

namespace App\Modules\Giphy\Application;

use App\Modules\Giphy\Domain\Repositories\GifRepositoryInterface;

class SearchGifs
{
    private $gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->gifRepository = $gifRepository;
    }

    public function execute(string $query, int $limit = 25, int $offset = 0)
    {
        return $this->gifRepository->searchGifs($query, $limit, $offset);
    }
}
