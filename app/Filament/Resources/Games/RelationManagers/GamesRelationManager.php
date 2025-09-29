<?php

namespace App\Filament\Resources\Games\RelationManagers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\Games\GameResource;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\RelationType;


class GamesRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    protected static ?string $relatedResource = GameResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('pivot.relationType.name'),
            ])
            ->headerActions([
                AttachAction::make()
                ->schema(fn (AttachAction $action): array => [
                    $action->getRecordSelect()
                        ->relationship(
                            'children', 
                            'title',
                            modifyQueryUsing: fn (Builder $query, RelationManager $livewire) => $query
                                ->whereNotIn('id', [
                                    $livewire->getOwnerRecord()->id,
                                    DB::table('game_relations')
                                        ->where('parent_game_id', '=', $livewire->getOwnerRecord()->id)
                                        ->pluck('child_game_id')->implode(', '),
                                    DB::table('game_relations')
                                        ->where('child_game_id', '=', $livewire->getOwnerRecord()->id)
                                        ->pluck('parent_game_id')->implode(', ')
                                ]),
                        ),
                    Select::make('relation_type_id')
                        ->options(RelationType::query()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Relation Type'),
                ]),
            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ]);
    }
}
