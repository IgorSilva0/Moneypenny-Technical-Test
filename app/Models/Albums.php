<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = [
        'artist_id',
        'artist_twitter',
        'artist_name',
        'name',
    ];
}
