<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable =
        [
            'name',
            'prefix',
            'urutan',
            'is_active'
        ];
}
