<?php

namespace App\Filament\Resources\RelationTypes\Pages;

use App\Filament\Resources\RelationTypes\RelationTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRelationTypes extends ManageRecords
{
    protected static string $resource = RelationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
