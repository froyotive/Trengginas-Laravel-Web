<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IsiFakturResource\Pages;
use App\Models\Isi_Faktur;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('id_faktur')
                            ->label('No SPK')
                            ->options(Faktur::pluck('no_spk', 'id_faktur'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (blank($state)) {
                                    $set('id_vendor', null);
                                }
                            }),

                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('id_vendor')
                                    ->label('Nama Vendor')
                                    ->relationship('vendor', 'nama_vendor')
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                                    
                                Forms\Components\TextInput::make('nama_barang')
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                                    
                                Forms\Components\TextInput::make('banyak_unit')
                                    ->numeric()
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                                    
                                Forms\Components\TextInput::make('garansi')
                                    ->numeric()
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                                    
                                Forms\Components\TextInput::make('lokasi')
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                                    
                                Forms\Components\Select::make('status_list')
                                    ->options([
                                        'Belum dipesan' => 'Belum dipesan',
                                        'Sudah dipesan' => 'Sudah dipesan', 
                                        'Barang sampai' => 'Barang sampai',
                                        'Barang diserahkan ke user' => 'Barang diserahkan ke user'
                                    ])
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                                    
                                Forms\Components\DatePicker::make('jatuh_tempo')
                                    ->required()
                                    ->visible(fn ($get) => filled($get('id_faktur'))),
                            ])->columns(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('faktur.no_spk')
                    ->label('No SPK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('vendor.nama_vendor')
                    ->label('Vendor'),
                Tables\Columns\TextColumn::make('nama_barang'),
                Tables\Columns\TextColumn::make('banyak_unit'),
                Tables\Columns\TextColumn::make('garansi'),
                Tables\Columns\TextColumn::make('lokasi'),
                Tables\Columns\TextColumn::make('status_list'),
                Tables\Columns\TextColumn::make('jatuh_tempo')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_faktur')
                    ->label('Filter by SPK')
                    ->relationship('faktur', 'no_spk')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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