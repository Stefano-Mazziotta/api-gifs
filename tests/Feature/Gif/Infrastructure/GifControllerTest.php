<?php

namespace Tests\Feature\Http\Controllers;

use App\Modules\Gif\Application\GetGifById;
use App\Modules\Gif\Application\SearchGifs;
use App\Modules\Gif\Application\SaveFavoriteGif;
use App\Modules\Gif\Infrastructure\GifController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class GifControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_gif_by_id_returns_successful_response()
    {
        $gifId = '123';
        $expectedGif = ['id' => $gifId, 'title' => 'Funny Gif'];

        $getGifById = $this->createMock(GetGifById::class);
        $searchGifs = $this->createMock(SearchGifs::class);
        $saveFavoriteGif = $this->createMock(SaveFavoriteGif::class);

        $getGifById->method('execute')->with($gifId)->willReturn($expectedGif);

        $controller = new GifController($searchGifs, $getGifById, $saveFavoriteGif);
        $response = $controller->getGifById($gifId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($expectedGif, $response->getData(true));
    }

    public function test_get_gif_by_id_returns_error_response_when_exception_thrown()
    {
        $gifId = '123';

        $getGifById = $this->createMock(GetGifById::class);
        $searchGifs = $this->createMock(SearchGifs::class);
        $saveFavoriteGif = $this->createMock(SaveFavoriteGif::class);

        $getGifById->method('execute')->with($gifId)->willThrowException(new \Exception('Gif not found'));

        $controller = new GifController($searchGifs, $getGifById, $saveFavoriteGif);
        $response = $controller->getGifById($gifId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals(['error' => 'Gif not found'], $response->getData(true));
    }
}
