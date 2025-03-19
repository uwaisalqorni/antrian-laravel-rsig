<?php

namespace App\Exports;

use App\Models\Antrian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminates\Support\Facades\Schema;

class AntrianExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Antrian::all();
            // ->join('polis', 'antrians.poli_id', '=', 'polis.id')
            // ->join('lokets', 'antrians.loket_id', '=', 'lokets.id')
            // ->select([
            //     'id',
            //     'polis.name',
            //     'lokets.name',
            //     'antrians.number',
            //     'antrians.status',
            //     'antrians.called_at',
            //     'antrians.served_at',
            //     'antrians.canceled_at',
            //     'antrians.finished_at',
           // ]);
    }

    public function headings(): array
    {
        return ([
            'id',
            'Poli',
            'Loket',
            'Nomor Urut',
            'Status',
            'Waktu Panggil',
            'Waktu Dilayani',
            'Batal',
            'Waktu Selesai'
        ]);
    }
}
