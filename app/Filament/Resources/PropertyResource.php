<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('price_in_euros')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('parking_spaces')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('bathrooms')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('living_rooms')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('available_from')
                    ->reactive()
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->minDate(now())
                    ->required(),
                Forms\Components\DatePicker::make('available_to')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->minDate(fn (Get $get) => $get('available_from'))
                    ->required(),
                Forms\Components\Select::make('available')
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('preview_image_src')
                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                    ->disk('public_uploads')
                    ->directory('images')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('price_in_euros'),
                Tables\Columns\TextColumn::make('parking_spaces'),
                Tables\Columns\TextColumn::make('bathrooms'),
                Tables\Columns\TextColumn::make('living_rooms'),
                Tables\Columns\TextColumn::make('available_from'),
                Tables\Columns\TextColumn::make('available_to'),
                Tables\Columns\TextColumn::make('available'),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
