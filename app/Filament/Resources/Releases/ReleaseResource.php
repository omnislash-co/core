<?php

namespace App\Filament\Resources\Releases;

use App\Filament\Resources\Releases\Pages\ManageReleases;
use App\Release;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class ReleaseResource extends Resource
{
    protected static ?string $model = Release::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Releases';

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('game_id')
                    ->relationship('game', 'title')
                    ->searchable()
                    ->live()
                    ->required(),
                Select::make('platform_id')
                    ->relationship(
                        'platform', 
                        'name',
                        fn(Builder $query, Get $get) => 
                            $query->join('game_platform', fn(JoinClause $join) =>
                                $join->on('platforms.id', '=', 'game_platform.platform_id')
                                     ->where('game_platform.game_id', '=', (int) $get('game_id'))
                        )
                    )
                    ->disabled(fn(Get $get) : bool => !filled($get('game_id')))
                    ->required(),
                Select::make('region_id')
                    ->relationship('region', 'name')
                    ->required(),
                Select::make('date_type_id')
                    ->relationship('dateType', 'name')
                    ->required(),
                DatePicker::make('date'),
                TextInput::make('alternate_title'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('game.title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('platform.name')
                    ->searchable(),
                TextColumn::make('region.name')
                    ->searchable(),
                TextColumn::make('dateType.name')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('alternate_title')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageReleases::route('/'),
        ];
    }
}
