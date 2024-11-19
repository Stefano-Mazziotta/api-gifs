<?php

namespace App\Modules\Gif\Application;

use App\Modules\Gif\Domain\GifRepositoryInterface;

class SearchGifs
{
    private $_gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->_gifRepository = $gifRepository;
    }

    public function execute(string $query, int $limit = 25, int $offset = 0)
    {
        return $this->_gifRepository->searchGifs($query, $limit, $offset);
    }
}
