<?php

namespace App\Filament\Resources\DateTypeResource\Pages;

use App\Filament\Resources\DateTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDateTypes extends ManageRecords
{
    protected static string $resource = DateTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
