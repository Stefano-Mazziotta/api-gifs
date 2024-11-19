<?php

namespace Tests\Unit\Gif\UseCases;

use App\Modules\Gif\Application\GetGifById;
use App\Modules\Gif\Domain\GifRepositoryInterface;
use PHPUnit\Framework\TestCase;

class GetGifByIdTest extends TestCase
{
    public function test_execute_returns_gif()
    {
        $gifId = 'gHQxuYpgykXW5rxewl';
        $expectedGif = ['id' => $gifId, 'title' => 'Funny Gif'];

        $gifRepository = $this->createMock(GifRepositoryInterface::class);
        $gifRepository->method('getGifById')->with($gifId)->willReturn($expectedGif);

        $getGifById = new GetGifById($gifRepository);
        $result = $getGifById->execute($gifId);

        $this->assertEquals($expectedGif, $result);
    }

    public function test_execute_throws_exception_when_gif_not_found()
    {
        $this->expectException(\Exception::class);

        $gifId = '123';

        $gifRepository = $this->createMock(GifRepositoryInterface::class);
        $gifRepository->method('getGifById')->with($gifId)->willThrowException(new \Exception('Gif not found'));

        $getGifById = new GetGifById($gifRepository);
        $getGifById->execute($gifId);
    }
}
