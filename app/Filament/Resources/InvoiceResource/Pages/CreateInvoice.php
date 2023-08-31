<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $newTransactions = collect($data['transactions'])->map(function ($transaction) {
            return json_decode($transaction, true);
        });

        $data['transactions'] = $newTransactions->toJson();
        $total = $newTransactions->sum('amount');
        $data['total'] = $total;

        return $data;
    }
}
