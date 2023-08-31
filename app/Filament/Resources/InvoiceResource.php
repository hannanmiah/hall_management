<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'default' => 1,
                    'lg' => 2,
                ])->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->placeholder('Select User')
                        ->relationship('user', 'name')
                        ->required()->live(),
                    Forms\Components\Select::make('transactions')
                        ->label('Transactions')
                        ->placeholder('Select Transactions')
                        ->multiple()
                        ->options(function (Forms\Get $get) {
                            $transactions = Transaction::with('user')->where('user_id', $get('user_id'))->get();
                            $trIds = $transactions->map(function ($transaction) {
                                return $transaction->toJson();
                            })->toArray();
                            $trValues = $transactions->map(function ($transaction) {
                                return $transaction->name->value.' - '.$transaction->amount.'-'.$transaction->reference;
                            })->toArray();

                            return array_combine($trIds, $trValues);

                        })
                        ->required()
                        ->hidden(fn (Forms\Get $get) => ! filled($get('user_id')))
                        ->live(),
                    Forms\Components\MarkdownEditor::make('comment'),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transactions')
                    ->formatStateUsing(function ($state) {
                        $transactions = json_decode($state);
                        $trValues = ['<ul class="flex flex-col space-y-4">'];
                        foreach ($transactions as $transaction) {
                            $trValues[] = '<li class="text-xs text-primary-500 dark:text-white"> <span class="bg-gray-50 dark:bg-transparent border rounded p-2">'.$transaction->name.' - '.$transaction->amount.'-'.$transaction->reference.'</span></li>';
                        }
                        $trValues[] = '</ul>';

                        return implode('', $trValues);
                    })->html(),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('comment'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('print')
                    ->label('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Invoice $record) => route('invoice.pdf', ['invoice' => $record]))->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
