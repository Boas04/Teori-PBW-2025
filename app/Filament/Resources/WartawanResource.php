<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WartawanResource\Pages;
use App\Filament\Resources\WartawanResource\RelationManagers;
use App\Models\Wartawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WartawanResource extends Resource
{
    protected static ?string $model = Wartawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('nama')
                ->required()
                ->maxLength(255)
                ->label('Nama')
                ->placeholder('Masukkan nama wartawan')
                ->helperText('Maksimal 255 karakter'),
                
            TextInput::make('email')
                ->required()
                ->label('Email')
                ->placeholder('Masukkan email wartawan')
                ->helperText('Masukkan alamat email yang valid'),
        ]);
}
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListWartawans::route('/'),
            'create' => Pages\CreateWartawan::route('/create'),
            'edit' => Pages\EditWartawan::route('/{record}/edit'),
        ];
    }
}
