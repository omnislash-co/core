<?php

namespace App\Filament\Resources\Games\Pages;

use App\Filament\Resources\Games\GameResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGame extends EditRecord
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['icon'] = 'games/icons/'.$data['icon'];

        if (!is_null($data['cover'])) {
            $data['cover'] = 'games/covers/'.$data['cover'];
        }
     
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['icon'] = basename($data['icon']);

        if (!is_null($data['cover'])) {
            $data['cover'] = basename($data['cover']);
        }
     
        return $data;
    }
}
