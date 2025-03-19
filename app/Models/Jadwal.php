<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable =
        [
            'name',
            'start_time',
            'end_time',
            'urutan',
            'foto',
            'is_active'
        ];
}
