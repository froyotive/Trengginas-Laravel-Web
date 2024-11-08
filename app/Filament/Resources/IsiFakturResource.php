<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IsiFakturResource\Pages;
use App\Models\Isi_Faktur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IsiFakturResource extends Resource
{
    protected static ?string $model = Isi_Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationLabel = 'Isi Faktur';
    
    protected static ?string $modelLabel = 'Isi Faktur';
    protected static ?string $pluralModelLabel = 'Isi Faktur';
    
    
    protected static ?string $navigationGroup = 'Manajemen Faktur';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_faktur')
                    ->label('No SPK')
                    ->relationship('faktur', 'no_spk')
                    ->required(),
                Forms\Components\Select::make('id_vendor')
                    ->label('Nama Vendor')
                    ->relationship('vendor', 'nama_vendor')
                    ->required(),
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->label('Nama Barang'),
                Forms\Components\TextInput::make('banyak_unit')
                    ->required()
                    ->numeric()
                    ->label('Banyak Unit'),
                Forms\Components\TextInput::make('garansi')
                    ->required()
                    ->numeric()
                    ->label('Garansi'),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->label('Lokasi'),
                Forms\Components\Select::make('status_list')
                    ->required()
                    ->options([
                        'Belum dipesan' => 'Belum dipesan',
                        'Sudah dipesan' => 'Sudah dipesan',
                        'Barang sampai' => 'Barang sampai',
                        'Barang diserahkan ke user' => 'Barang diserahkan ke user',
                    ])
                    ->label('Status'),
                Forms\Components\DatePicker::make('jatuh_tempo')
                    ->required()
                    ->label('Jatuh Tempo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('faktur.no_spk')->label('No SPK'),
                Tables\Columns\TextColumn::make('vendor.nama_vendor')->label('Nama Vendor'),
                Tables\Columns\TextColumn::make('nama_barang')->label('Nama Barang'),
                Tables\Columns\TextColumn::make('banyak_unit')->label('Banyak Unit'),
                Tables\Columns\TextColumn::make('garansi')->label('Garansi'),
                Tables\Columns\TextColumn::make('lokasi')->label('Lokasi'),
                Tables\Columns\TextColumn::make('status_list')->label('Status'),
                Tables\Columns\TextColumn::make('jatuh_tempo')->label('Jatuh Tempo'),
            ])
            ->filters([
                // Define your table filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define your relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIsiFakturs::route('/'),
            'create' => Pages\CreateIsiFaktur::route('/create'),
            'edit' => Pages\EditIsiFaktur::route('/{record}/edit'),
        ];
    }
}