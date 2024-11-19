<?php

namespace App\Modules\Gif\Application;

use App\Modules\Gif\Domain\GifRepositoryInterface;

class GetGifById
{
    private $_gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->_gifRepository = $gifRepository;
    }

    public function execute(string $id)
    {
        return $this->_gifRepository->getGifById($id);
    }
}
