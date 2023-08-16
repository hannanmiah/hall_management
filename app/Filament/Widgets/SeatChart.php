<?php

namespace App\Filament\Widgets;

use App\Models\Seat;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SeatChart extends ChartWidget
{
    protected static ?string $heading = 'Seats By Year';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Trend::model(Seat::class)
            ->between(start: now()->startOfYear()->subYears(2), end: now()->endOfYear())
            ->perYear()
            ->count();

        return [
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
            'datasets' => [
                [
                    'label' => 'Seats',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ],
                    'hoverOffset' => 4,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
