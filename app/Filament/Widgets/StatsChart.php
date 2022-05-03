<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;

class StatsChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 2;

    protected function getHeading(): string
    {
        return 'Bills';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Bills created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => [
                            'rgba(75, 192, 192, 1)',
                    ],

                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
