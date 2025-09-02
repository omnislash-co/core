<?php

namespace App\Filament\Resources\DateTypes\Pages;

use App\Filament\Resources\DateTypes\DateTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDateTypes extends ManageRecords
{
    protected static string $resource = DateTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
