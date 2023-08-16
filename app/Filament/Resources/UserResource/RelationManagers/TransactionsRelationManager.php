<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Enums\Casts\TransactionName;
use App\Enums\Casts\TransactionStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('name')
                    ->required()
                    ->enum(TransactionName::class)
                    ->options(TransactionName::toArray())
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('method')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('reference')
                    ->visible(fn (Forms\Get $get): bool => filled($get('name')) && $get('name') === 'fee')
                    ->required(fn (Forms\Get $get): bool => filled($get('name')) && $get('name') === 'fee'),
                Forms\Components\Select::make('status')
                    ->enum(TransactionStatus::class)
                    ->options(TransactionStatus::toArray())
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric(),
                Tables\Columns\TextColumn::make('method'),
                Tables\Columns\TextColumn::make('reference')->date('M Y'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('description'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
