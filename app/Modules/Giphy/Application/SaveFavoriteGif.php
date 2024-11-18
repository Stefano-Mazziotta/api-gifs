<?php

namespace App\Modules\Giphy\Application;

use App\Modules\Giphy\Domain\Models\FavoriteGif;

class SaveFavoriteGif
{
    public function execute(array $data)
    {
        // $favoriteGif = FavoriteGif::create([
        //     'gif_id' => $data['gif_id'],
        //     'alias' => $data['alias'],
        //     'user_id' => $data['user_id'],
        // ]);

        // return $favoriteGif;

        return 0;
    }
}
