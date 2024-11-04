<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListVendorResource\Pages;
use App\Filament\Resources\ListVendorResource\RelationManagers;
use App\Models\ListVendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\List_Vendor;

class ListVendorResource extends Resource
{
    protected static ?string $model = List_Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_vendor')->label('Nama Vendor'),
                Forms\Components\TextInput::make('alamat_vendor')->label('Alamat Vendor'),
                Forms\Components\TextInput::make('no_vendor')->label('No. Vendor'),
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
            'index' => Pages\ListListVendors::route('/'),
            'create' => Pages\CreateListVendor::route('/create'),
            'edit' => Pages\EditListVendor::route('/{record}/edit'),
        ];
    }
}