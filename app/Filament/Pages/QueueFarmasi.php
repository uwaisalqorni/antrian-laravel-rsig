<?php

namespace App\Filament\Pages;

use App\Models\Poli;
use App\Services\QueueService;
use App\Services\ThermalPrinterService;
use Filament\Pages\Page;

class QueueFarmasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static string $view = 'filament.pages.queue-farmasi';
    protected static string $layout = 'filament.layouts.base-farmasi';
    protected static ?string $navigationLabel = 'Farmasi Cetak Antrian';
    protected ThermalPrinterService $thermalPrinterService;
    protected QueueService $queueService;

    public function __construct()
    {
        $this->thermalPrinterService = app(ThermalPrinterService::class);

        $this->queueService = app(QueueService::class);
    }

    public function getViewData(): array
    {
        return [
            'polies' => Poli::where('is_active', true)->get()
        ];
    }

    public function print($poliId)
    {
        $newQueue = $this->queueService->addQueue($poliId);

        $text = $this->thermalPrinterService->createText([
            ['text' => 'Farmasi RSIG', 'align' => 'center'],
            ['text' => 'Jl. Hayam Wuruk No.66', 'align' => 'center'],
            ['text' => '-----------------', 'align' => 'center'],
            ['text' => 'NOMOR ANTRIAN', 'align' => 'center'],
            ['text' => $newQueue->poli->name, 'align' => 'center'],
            ['text' => $newQueue->number, 'align' => 'center', 'style' => 'double'],
            ['text' => $newQueue->created_at->format('d-m-Y H:i'), 'align' => 'center'],
            ['text' => '-----------------', 'align' => 'center'],
            ['text' => 'Mohon menunggu', 'align' => 'center']
        ]);

        $this->dispatch("print-start", $text);
    }
}
