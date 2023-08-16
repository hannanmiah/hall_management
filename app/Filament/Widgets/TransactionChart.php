<?php

namespace App\Filament\Widgets;

use App\Enums\Casts\TransactionStatus;
use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Transactions This year';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $feeData = Trend::query(Transaction::query()->where('status', TransactionStatus::CREDITED))
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();
        $expenseData = Trend::query(Transaction::query()->where('name', TransactionStatus::DEBITED))
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();
        $pendingData = Trend::query(Transaction::query()->where('status', TransactionStatus::PENDING))
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        return [
            'labels' => $feeData->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M')),
            'datasets' => [
                [
                    'label' => 'Credit',
                    'data' => $feeData->map(fn (TrendValue $value) => $value->aggregate),
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'lineTension' => 0.1,
                ],
                [
                    'label' => 'Debit',
                    'data' => $expenseData->map(fn (TrendValue $value) => $value->aggregate),
                    'fill' => false,
                    'borderColor' => 'rgb(255, 99, 132)',
                    'lineTension' => 0.1,
                ],
                [
                    'label' => 'Pending',
                    'data' => $pendingData->map(fn (TrendValue $value) => $value->aggregate),
                    'fill' => false,
                    'borderColor' => 'rgb(255, 205, 86)',
                    'lineTension' => 0.1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
