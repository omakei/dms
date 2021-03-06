<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class Prescription extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 3;

    protected function getHeading(): string
    {
        return 'Prescription';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Prescription created',
                    'data' => [0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 1)',
                    ],
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
