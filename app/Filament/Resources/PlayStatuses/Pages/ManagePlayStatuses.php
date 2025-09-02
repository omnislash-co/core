<?php

namespace App\Filament\Resources\PlayStatuses\Pages;

use App\Filament\Resources\PlayStatuses\PlayStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePlayStatuses extends ManageRecords
{
    protected static string $resource = PlayStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
