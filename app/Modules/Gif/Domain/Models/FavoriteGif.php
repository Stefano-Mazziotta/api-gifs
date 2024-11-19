<?php

namespace App\Modules\Gif\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteGif extends Model
{
    // Table name
    protected $table = 'favorite_gifs';

    // Primary key
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    // Fillable fields
    protected $fillable = [
        'user_id',
        'gif_url',
        'title',
        'description'
    ];

    // Hidden fields
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
