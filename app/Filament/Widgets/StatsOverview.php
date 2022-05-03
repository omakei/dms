<?php

namespace App\Filament\Widgets;

use App\Models\Attendant;
use App\Models\Department;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Patients', Patient::count())
                ->description(Patient::where('created_at','>=', now()->startOfDay())->count().' increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([
                    Patient::where('created_at','>=', now()->startOfDay())->count()
                    , 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Card::make('Attendants', Attendant::count())
                ->description(Attendant::where('created_at','>=', now()->startOfDay())->count().' increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10,])
                ->color('success'),
            Card::make('Departments', Department::count())
                ->description(Department::where('created_at','>=', now()->startOfDay())->count().' increase')
                ->descriptionIcon('heroicon-s-trending-up')
                 ->chart([7, 2, 10,])
                ->color('success'),

        ];
    }
}
