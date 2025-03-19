<?php

namespace App\Filament\Pages;

use App\Models\Loket;
use Filament\Pages\Page;

class DashboardAntrianFarmasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Dashboard Antrian Farmasi';
    protected static string $layout = 'filament.layouts.base-farmasi';
    protected static string $view = 'filament.pages.dashboard-antrian-farmasi';

    public function getViewData(): array
    {
        return [
            'lokets' => Loket::with(['poli', 'activeQueue'])->get()
        ];
    }

}
