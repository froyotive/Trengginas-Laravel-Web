<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;
    protected static ?string $navigationIcon = 'heroicon-o-document';
    
    protected static ?string $navigationLabel = 'Faktur';
    
    protected static ?string $modelLabel = 'Faktur';
    protected static ?string $pluralModelLabel = 'Faktur';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Manajemen Faktur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_spk')->label('No. SPK'),
                Forms\Components\DatePicker::make('tgl_sk')->label('Tanggal'),
                Forms\Components\TextInput::make('user')->label('User'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_spk')->label('No. SPK'),
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }
}