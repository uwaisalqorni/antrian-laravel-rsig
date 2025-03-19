<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    protected $fillable = ['name', 'poli_id', 'jadwal_id','is_active'];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }

    public function activeQueue()
    {
        return $this->hasOne(Antrian::class)->whereIn('status', ['waiting','serving']);
    }

    public function getHasNextQueueAttribute() {
        return Antrian::where('poli_id', $this->poli_id)
            ->where('status', 'waiting')
            ->where(function($query){
                $query->where('loket_id', $this->id)
                    ->orWhereNull('loket_id');
            })->exists()
        && $this->is_available;
    }

    public function getIsAvailableAttribute()
    {
        $hasServingQueue = $this->antrian()->where('status', 'serving')->exists();

        return !$hasServingQueue && $this->is_active;
    }
}
