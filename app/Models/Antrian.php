<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'poli_id',
        'loket_id',
        'number',
        'status',
        'called_at',
        'served_at',
        'canceled_at',
        'finished_at'
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function getFarmasiLabelAttribute()
    {
        if ($this->status === 'waiting') return "Menunggu";

        if ($this->status === 'serving') return "Dilayani";

        return '';
    }
}
