<?php

namespace App\Services;

use App\Models\Loket;
use App\Models\Antrian;
use App\Models\Poli;

class QueueService
{

    public function addQueue($poliId)
    {
        $number = $this->generateNumber($poliId);

        return Antrian::create([
            'poli_id' => $poliId,
            'number' => $number,
            'status' => 'waiting',
        ]);
    }

    public function generateNumber($poliId)
    {
        $poli = Poli::findOrFail($poliId);

        $lastQueue = Antrian::where('poli_id', $poliId)
            ->orderByDesc('id')
            ->first();

        $currentDate = now()->format('Y-m-d');

        $lastQueueDate = $lastQueue ? $lastQueue->created_at->format('Y-m-d') : null;

        $isSameDate = $currentDate === $lastQueueDate;

        $lastQueueNumber = $lastQueue ? intval(
            substr($lastQueue->number, strlen($poli->prefix))
        ) : 0;

        $maximumNumber = pow(10, $poli->urutan) - 1;

        $isMaximumNumber = $lastQueueNumber === $maximumNumber;

        if ($isSameDate && !$isMaximumNumber) {
            $newQueueNumber = $lastQueueNumber + 1;
        } else {
            $newQueueNumber = 1;
        }

        return $poli->prefix . str_pad($newQueueNumber, $poli->urutan, "0", STR_PAD_LEFT);
    }

    public function getNextQueue($loketId)
    {
        $loket = Loket::findOrFail($loketId);

        return Antrian::where('status', 'waiting')
            ->where('poli_id', $loket->poli_id)
            ->where(function($query) use ($loketId) {
                $query->whereNull('loket_id')->orWhere('loket_id', $loketId);
            })
            ->orderBy('id')
            ->first();
    }

    public function callNextQueue($loketId)
    {
        $nextQueue = $this->getNextQueue($loketId);

        if ($nextQueue && !$nextQueue->loket_id) {
            $nextQueue->update([
                'loket_id' => $loketId,
                'called_at' => now()
            ]);
        }

        return $nextQueue;
    }

    public function serveQueue(Antrian $antrian)
    {
        if ($antrian->status !== 'waiting') {
            return;
        }

        $antrian->update([
            'status' => 'serving',
            'served_at' => now()
        ]);
    }

    public function finishQueue(Antrian $antrian)
    {
        if ($antrian->status !== 'serving') {
            return;
        }

        $antrian->update([
            'status' => 'finished',
            'finished_at' => now()
        ]);
    }

    public function cancelQueue(Antrian $antrian)
    {
        if ($antrian->status !== 'waiting') {
            return;
        }

        $antrian->update([
            'status' => 'canceled',
            'canceled_at' => now()
        ]);
    }
}
