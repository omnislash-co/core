<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\User;
use App\Game;
use App\Release;
use App\Developer;
use App\Genre;
use App\Platform;
use Carbon\Carbon;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user_count = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $game_count = Game::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $developer_count = Developer::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $platform_count = Platform::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $release_count = Release::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $genre_count = Genre::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        return [
            Stat::make('Users', User::all()->count())
                ->description("{$user_count} increase in last 30 days")
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Games', Game::all()->count())
                ->description("{$game_count} increase in last 30 days")
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Releases', Release::all()->count())
                ->description("{$release_count} increase in last 30 days")
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Developers', Developer::all()->count())
                ->description("{$developer_count} increase in last 30 days")
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Genres', Genre::all()->count())
                ->description("{$genre_count} increase in last 30 days")
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Platforms', Platform::all()->count())
                ->description("{$platform_count} increase in last 30 days")
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
