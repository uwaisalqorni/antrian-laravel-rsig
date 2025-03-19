<?php

namespace App\Filament\Resources\LoketResource\Pages;

use App\Filament\Resources\LoketResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLokets extends ManageRecords
{
    protected static string $resource = LoketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
