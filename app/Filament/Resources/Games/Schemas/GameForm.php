<?php

namespace App\Filament\Resources\Games\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class GameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->readOnly(),
                TextInput::make('initial_release_year')
                    ->required()
                    ->numeric()
                    ->minValue(1980)
                    ->length(4),
                MarkdownEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('icon')
                    ->required()
                    ->image()
                    ->directory('games/icons')
                    ->imagePreviewHeight('250'),
                FileUpload::make('cover')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4.75:1'
                    ])
                    ->directory('games/covers')
                    ->imagePreviewHeight('250'),
            ]);
    }
}
