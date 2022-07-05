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
                    'data' => [0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0],
                    'backgroundColor' => [
                            'rgba(75, 192, 192, 1)',
                    ],

                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
