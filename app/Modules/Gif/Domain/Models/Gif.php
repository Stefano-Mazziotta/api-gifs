<?php

namespace App\Modules\Gif\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Gif extends Model
{
    // Table name
    protected $table = 'gifs';

    // Primary key
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    // Fillable fields
    protected $fillable = [
        'gif_id',
        'url',
        'title',
    ];

    // Hidden fields
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function users()
    {
        return $this->belongsToMany('App\Modules\Auth\Domain\Model\User', 'user_favorite_gifs', 'gif_id', 'user_id');
    }
}
