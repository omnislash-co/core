<?php

namespace App\Filament\Resources\PlayStatusResource\Pages;

use App\Filament\Resources\PlayStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePlayStatuses extends ManageRecords
{
    protected static string $resource = PlayStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
