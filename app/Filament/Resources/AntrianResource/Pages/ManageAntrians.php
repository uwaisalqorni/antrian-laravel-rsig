<?php

namespace App\Filament\Resources\AntrianResource\Pages;

use App\Filament\Resources\AntrianResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Actions\Action;

class ManageAntrians extends ManageRecords
{
    protected static string $resource = AntrianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Export Excel')
                ->url(route('antrian-export'))
                ->color('danger'),
            Actions\CreateAction::make(),
        ];
    }
}
