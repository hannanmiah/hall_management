<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeatResource\Pages;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeatResource extends Resource
{
    protected static ?string $model = Seat::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->placeholder('Select Student')
                    ->options(function () use ($form) {
                        $students = Student::query()->whereDoesntHave('seat')->get();

                        $students = $students->pluck('full_name', 'id');
                        if ($form->getRecord()?->exists && filled($form->getRecord()?->student)) {
                            $students->prepend($form->getRecord()->student->full_name, $form->getRecord()->student->id);
                        }

                        return $students;
                    })
                    ->nullable(),
                Forms\Components\Select::make('room_id')
                    ->label('Room')
                    ->placeholder('Select Room')
                    ->options(function () use ($form) {
                        $rooms = Room::query()->with('seats')->select(['id', 'name', 'capacity'])->get();

                        $rooms = $rooms->where('remaining', '>', 0)->pluck('name', 'id');
                        if ($form->getRecord()?->exists && filled($form->getRecord()?->room)) {
                            $rooms->prepend($form->getRecord()->room->name, $form->getRecord()->room->id);
                        }

                        return $rooms;
                    })
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->badge(fn ($state) => $state === 'N/A')
                    ->color(fn (string $state) => match ($state) {
                        'N/A' => 'danger',
                        default => 'grey',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'Allocated' => 'success',
                        'Unallocated' => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSeats::route('/'),
            'create' => Pages\CreateSeat::route('/create'),
            'edit' => Pages\EditSeat::route('/{record}/edit'),
        ];
    }
}
