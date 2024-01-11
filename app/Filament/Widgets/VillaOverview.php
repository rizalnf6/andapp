<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Villa;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class VillaOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getCards(): array
    {
        return [
            Card::make('Total Villa', Villa::count()),
            Card::make('Villa Added by Today', Villa::whereDate('created_at', today())->count()),
            Card::make('Total Users', User::count())
        ];
    }
}
