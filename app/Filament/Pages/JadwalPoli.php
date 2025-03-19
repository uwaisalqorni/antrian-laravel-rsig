<?php

namespace App\Filament\Pages;

use App\Models\Jadwal;
use Filament\Pages\Page;

class JadwalPoli extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Dashboard Jadwal Poli';
    protected static string $view = 'filament.pages.jadwal-poli';
    protected static string $layout = 'filament.layouts.base-jadwal';

    public function getViewData(): array
    {
        return [
            'jadwals' => Jadwal::where('is_active', true)->get()
        ];
    }
}
