<?php

namespace App\Modules\Giphy\Infrastructure;

use App\Controller;
use Illuminate\Http\Request;
use App\Modules\Giphy\Application\SearchGifs;
use App\Modules\Giphy\Application\GetGifById;
use App\Modules\Giphy\Application\SaveFavoriteGif;

class GiphyController extends Controller
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
        $query = $request->input('query');
        $limit = $request->input('limit', 25);
        $offset = $request->input('offset', 0);

        $results = $this->searchGifs->execute($query, $limit, $offset);

        return response()->json($results, 200);
    }

    public function getGifById($id)
    {
        $result = $this->getGifById->execute($id);

        return response()->json($result, 200);
    }

    public function saveFavoriteGif(Request $request)
    {
        $request->validate([
            'gif_id' => 'required|numeric',
            'alias' => 'required|string',
            'user_id' => 'required|numeric',
        ]);

        $favoriteGif = $this->saveFavoriteGif->execute($request->all());

        return response()->json($favoriteGif, 201);
    }
}
