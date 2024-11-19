<?php

namespace App\Modules\Log\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    // Table name
    protected $table = 'logs';

    // Primary key
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    // Fillable fields
    protected $fillable = [
        'user_id',
        'service',
        'request_body',
        'http_code',
        'response_body',
        'ip_address',
    ];

    // Hidden fields
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
