<?php

namespace App\Modules\Giphy\Application;

use App\Modules\Giphy\Domain\Repositories\GifRepositoryInterface;

class GetGifById
{
    private $gifRepository;

    public function __construct(GifRepositoryInterface $gifRepository)
    {
        $this->gifRepository = $gifRepository;
    }

    public function execute(string $id)
    {
        return $this->gifRepository->getGifById($id);
    }
}
