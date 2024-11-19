<?php

namespace App\Modules\Gif\Infrastructure;

use App\Shared\Controller;
use Illuminate\Http\Request;
use App\Modules\Gif\Application\SearchGifs;
use App\Modules\Gif\Application\GetGifById;
use App\Modules\Gif\Application\SaveFavoriteGif;


class GifController extends Controller
{
    protected $searchGifs;
    protected $getGifById;
    protected $saveFavoriteGif;

    public function __construct(SearchGifs $searchGifs, GetGifById $getGifById, SaveFavoriteGif $saveFavoriteGif)
    {
        $this->searchGifs = $searchGifs;
        $this->getGifById = $getGifById;
        $this->saveFavoriteGif = $saveFavoriteGif;
    }

    public function searchGifs(Request $request)
    {
        try {
            $query = $request->input('query');
            $limit = $request->input('limit', 25);
            $offset = $request->input('offset', 0);

            $results = $this->searchGifs->execute($query, $limit, $offset);

            return response()->json($results, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function getGifById($id)
    {
        try {
            $result = $this->getGifById->execute($id);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function saveFavoriteGif(string $id, Request $request)
    {
        try {
            $data = $request->validate([
                'alias' => 'required|string',
            ]);

            $userId = $request->user()->id;

            $favoriteGif = $this->saveFavoriteGif->execute($id, $data['alias'], $userId);

            return response()->json($favoriteGif, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
