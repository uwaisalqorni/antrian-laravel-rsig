<?php

namespace App\Filament\Resources\PoliResource\Pages;

use App\Filament\Resources\PoliResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePolis extends ManageRecords
{
    protected static string $resource = PoliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
