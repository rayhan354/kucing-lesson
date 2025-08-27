<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Courses', Course::count())
                ->description('Number of available courses')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            Stat::make('Pending Transactions', Transaction::where('status', 'pending')->count() ?? 0)
                ->description('Transactions needing review')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
            Stat::make('Total Users', User::count())
                ->description('Registered users and mentors')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}