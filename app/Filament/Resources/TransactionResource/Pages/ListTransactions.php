<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Enums\Casts\TransactionName;
use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),
            'fee' => ListRecords\Tab::make('Fee')->query(fn ($query) => $query->where('name', TransactionName::FEE)),
            'expense' => ListRecords\Tab::make('Expense')->query(fn ($query) => $query->where('name', TransactionName::EXPENSE)),
            'donation' => ListRecords\Tab::make('Donation')->query(fn ($query) => $query->where('name', TransactionName::DONATION)),
            'other' => ListRecords\Tab::make('Other')->query(fn ($query) => $query->where('name', TransactionName::OTHER)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make(),
        ];
    }
}
