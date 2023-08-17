<?php

namespace App\Filament\Resources;

use App\Enums\Casts\TransactionName;
use App\Enums\Casts\TransactionStatus;
use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->placeholder('Select User')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('name')
                    ->required()
                    ->enum(TransactionName::class)
                    ->options(TransactionName::class)->live(onBlur: true),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('method')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('reference')
                    ->visible(fn (Forms\Get $get): bool => filled($get('name')) && $get('name') === 'fee')
                    ->required(fn (Forms\Get $get): bool => filled($get('name')) && $get('name') === 'fee'),
                Forms\Components\Select::make('status')
                    ->options(TransactionStatus::class)
                    ->required()
                    ->enum(TransactionStatus::class),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->money('bdt')
                    ->sortable(),
                Tables\Columns\TextColumn::make('method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (TransactionStatus $state) => match ($state) {
                        TransactionStatus::DEBITED => 'danger',
                        TransactionStatus::CREDITED => 'primary',
                        default => 'warning',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(TransactionStatus::toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
