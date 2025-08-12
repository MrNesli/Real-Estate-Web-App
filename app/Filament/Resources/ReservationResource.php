<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Property;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('property_id')
                    ->default(1)
                    ->reactive()
                    ->relationship('property', 'address')
                    ->required(),
                Forms\Components\DatePicker::make('start')
                    ->reactive()
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->minDate(function (Get $get): string {
                        $property = Property::find($get('property_id'));
                        return $property->available_from;
                    })
                    ->maxDate(function (Get $get): string {
                        $property = Property::find($get('property_id'));
                        return $get('end') ?? $property->available_to;
                    })
                    ->required(),
                Forms\Components\DatePicker::make('end')
                    ->reactive()
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->minDate(function (Get $get): string {
                        $property = Property::find($get('property_id'));
                        return $get('start') ?? $property->available_from;
                    })
                    ->maxDate(function (Get $get): string {
                        $property = Property::find($get('property_id'));
                        return $property->available_to;
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('property.address'),
                Tables\Columns\TextColumn::make('start'),
                Tables\Columns\TextColumn::make('end'),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
