<?php

namespace App\Filament\Widgets;

use App\Models\Seat;
use App\Models\Student;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $seatsEmpty = Seat::query()->doesntHave('student')->count();
        $studentsAllotted = Student::query()->has('seat')->count();
        $feePaid = Transaction::query()->where('name', 'fee')->sum('amount');
        // students allotted this year group by allotment month
        $studentsAllottedThisYear = Student::query()
            ->whereYear('allotment_date', now()->year)
            ->get()
            ->groupBy(function ($student) {
                return $student->allotment_date->format('F');
            })
            ->map(function ($students) {
                return $students->count();
            })->values()->toArray();

        return [
            Stat::make('Students Allotted', $studentsAllotted)
                ->description('This Year')
                ->chart($studentsAllottedThisYear),
            Stat::make('Seats Empty', $seatsEmpty),
            Stat::make('Fee Paid', $feePaid),
        ];
    }
}
