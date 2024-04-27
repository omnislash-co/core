<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Developer;
use App\Game;
use App\Platform;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Games', Game::all()->count()),
            Stat::make('Developers', Developer::all()->count()),
            Stat::make('Platforms', Platform::all()->count()),
        ];
    }
}
