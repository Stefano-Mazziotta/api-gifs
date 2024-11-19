<?php

namespace App\Modules\Gif\Application;

use App\Modules\Gif\Domain\GifRepositoryInterface;

class SaveFavoriteGif
{
    private $_gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->_gifRepository = $gifRepository;
    }

    public function execute(int $gifId, string $alias, int $userId)
    {
        return $this->_gifRepository->saveFavoriteGif($gifId, $alias, $userId);
    }
}
