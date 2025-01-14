<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IsiFakturResource\Pages;
use App\Models\Isi_Faktur;
use App\Models\Faktur;
use App\Models\List_Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;

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
        if ($form->getOperation() === 'view') {
            return $form->schema([
                Forms\Components\Section::make('Detail Faktur')
                    ->schema([
                        Forms\Components\Select::make('id_faktur')
                            ->label('No SPK')
                            ->options(function ($record) {
                                if ($record) {
                                    $faktur = Faktur::find($record->id_faktur);
                                    return $faktur ? [$faktur->id_faktur => $faktur->no_spk] : [];
                                }
                                return [];
                            })
                            ->disabled()
                            ->extraInputAttributes(['style' => 'background-color: white; color: black;'])
                            ->prefixIcon('heroicon-o-document-text'),

                        Forms\Components\TextInput::make('nama_barang')
                            ->label('Nama Barang')
                            ->disabled()
                            ->prefixIcon('heroicon-o-cube'),

                        Forms\Components\TextInput::make('banyak_unit')
                            ->label('Banyak Unit')
                            ->disabled()
                            ->prefixIcon('heroicon-o-hashtag'),

                        Forms\Components\DatePicker::make('garansi')
                            ->label('Garansi')
                            ->disabled()
                            ->prefixIcon('heroicon-o-calendar'),

                        Forms\Components\TextInput::make('lokasi')
                            ->label('Lokasi')
                            ->disabled()
                            ->prefixIcon('heroicon-o-map'),

                        Forms\Components\Select::make('id_vendor')
                            ->label('Nama Vendor')
                            ->options(function ($record) {
                                if ($record) {
                                    $vendor = List_Vendor::find($record->id_vendor);
                                    return $vendor ? [$vendor->id_vendor => $vendor->nama_vendor] : [];
                                }
                                return [];
                            })
                            ->disabled()
                            ->prefixIcon('heroicon-o-user-group'),

                        Forms\Components\TextInput::make('serial_number')
                            ->label('Serial Number')
                            ->disabled()
                            ->visible(fn($record) => $record->requires_serial_number === 'yes')
                            ->prefixIcon('heroicon-o-tag'),

                        Forms\Components\TextInput::make('harga_jual')
                            ->label('Harga Jual')
                            ->disabled()
                            ->formatStateUsing(function ($state) {
                                return 'IDR ' . number_format($state, 0, ',', '.');
                            })
                            ->prefixIcon('heroicon-o-currency-dollar'),

                        Forms\Components\TextInput::make('harga_beli')
                            ->label('Harga Beli')
                            ->disabled()
                            ->formatStateUsing(function ($state) {
                                return 'IDR ' . number_format($state, 0, ',', '.');
                            })
                            ->prefixIcon('heroicon-o-currency-dollar'),

                        Forms\Components\TextInput::make('status_list')
                            ->label('Status')
                            ->disabled()
                            ->prefixIcon('heroicon-o-check-circle'),

                        Forms\Components\DatePicker::make('jatuh_tempo')
                            ->label('Jatuh Tempo')
                            ->disabled()
                            ->prefixIcon('heroicon-o-calendar'),
                    ])
                    ->columns(2)
            ]);
        }
        if ($form->getOperation() === 'edit') {
            return $form->schema([
                Forms\Components\Section::make('Detail Faktur')
                    ->schema([
                        Forms\Components\Select::make('id_faktur')
                            ->label('No SPK')
                            ->options(Faktur::pluck('no_spk', 'id_faktur'))
                            ->required()
                            ->disabled()
                            ->prefixIcon('heroicon-o-document-text'),

                        Forms\Components\TextInput::make('nama_barang')
                            ->label('Nama Barang')
                            ->required()
                            ->prefixIcon('heroicon-o-cube'),

                        Forms\Components\TextInput::make('banyak_unit')
                            ->label('Banyak Unit')
                            ->numeric()
                            ->required()
                            ->prefixIcon('heroicon-o-hashtag'),

                        Forms\Components\DatePicker::make('garansi')
                            ->label('Garansi')
                            ->required()
                            ->prefixIcon('heroicon-o-calendar'),

                        Forms\Components\TextInput::make('lokasi')
                            ->label('Lokasi')
                            ->required()
                            ->prefixIcon('heroicon-o-map'),

                        Forms\Components\Select::make('id_vendor')
                            ->label('Nama Vendor')
                            ->options(List_Vendor::pluck('nama_vendor', 'id_vendor'))
                            ->required()
                            ->prefixIcon('heroicon-o-user-group'),

                        Forms\Components\Select::make('requires_serial_number')
                            ->label('Requires Serial Number')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No',
                            ])
                            ->required()
                            ->reactive()
                            ->prefixIcon('heroicon-o-check-circle'),

                        Forms\Components\TextInput::make('serial_number')
                            ->label('Serial Number')
                            ->nullable()
                            ->visible(fn($get) => $get('requires_serial_number') === 'yes')
                            ->prefixIcon('heroicon-o-tag'),

                        Forms\Components\TextInput::make('harga_jual')
                            ->label('Harga Jual')
                            ->numeric()
                            ->nullable()
                            ->prefixIcon('heroicon-o-currency-dollar'),

                        Forms\Components\TextInput::make('harga_beli')
                            ->label('Harga Beli')
                            ->numeric()
                            ->nullable()
                            ->prefixIcon('heroicon-o-currency-dollar'),

                        Forms\Components\Select::make('status_list')
                            ->label('Status')
                            ->options([
                                'Belum dipesan' => 'Belum dipesan',
                                'Sudah dipesan' => 'Sudah dipesan',
                                'Barang sampai' => 'Barang sampai',
                                'Barang diserahkan ke user' => 'Barang diserahkan ke user'
                            ])
                            ->required()
                            ->prefixIcon('heroicon-o-check-circle'),

                        Forms\Components\DatePicker::make('jatuh_tempo')
                            ->label('Jatuh Tempo')
                            ->required()
                            ->prefixIcon('heroicon-o-calendar'),
                    ])
                    ->columns(2)
            ]);
        }

        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('id_faktur')
                            ->label('No SPK')
                            ->options(Faktur::pluck('no_spk', 'id_faktur'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn($state, callable $set) => $set('total_items', null))
                            ->extraAttributes(['class' => 'form-control'])
                            ->placeholder('Pilih no SPK...')
                            ->prefixIcon('heroicon-o-document-text'),

                        Forms\Components\TextInput::make('total_items')
                            ->label('Jumlah Barang')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (filled($state)) {
                                    $items = collect(range(1, $state))->map(fn() => [])->toArray();
                                    $set('items', $items);
                                }
                            })
                            ->visible(fn($get) => filled($get('id_faktur')))
                            ->extraAttributes(['class' => 'form-control'])
                            ->placeholder('Input jumlah barang yang ingin ditambahkan...')
                            ->prefixIcon('heroicon-o-hashtag'),

                        Forms\Components\Repeater::make('items')
                            ->schema([
                                Forms\Components\TextInput::make('nama_barang')
                                    ->label('Nama Barang')
                                    ->required()
                                    ->placeholder('Masukkan nama barang...')
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefixIcon('heroicon-o-cube'),

                                Forms\Components\TextInput::make('banyak_unit')
                                    ->label('Banyak Unit')
                                    ->numeric()
                                    ->required()
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->placeholder('Masukkan Banyak Unit...')
                                    ->prefixIcon('heroicon-o-hashtag'),

                                Forms\Components\DatePicker::make('garansi')
                                    ->label('Tanggal Barang Datang')
                                    ->placeholder('Pilih tanggal barang diterima dari vendor')
                                    ->extraAttributes(['class' => 'form-control bootstrap-datepicker'])
                                    ->prefixIcon('heroicon-o-calendar'),

                                Forms\Components\TextInput::make('lokasi')
                                    ->label('Lokasi')
                                    ->placeholder('Masukkan lokasi barang...')
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefixIcon('heroicon-o-map'),

                                Forms\Components\Select::make('id_vendor')
                                    ->label('Nama Vendor')
                                    ->placeholder('Pilih nama vendor...')
                                    ->options(List_Vendor::pluck('nama_vendor', 'id_vendor'))
                                    ->required()
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefixIcon('heroicon-o-user-group'),

                                Forms\Components\Select::make('requires_serial_number')
                                    ->label('Requires Serial Number')
                                    ->placeholder('Apakah barang memiliki serial number ? ')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefixIcon('heroicon-o-check-circle'),

                                Forms\Components\TextInput::make('serial_number')
                                    ->label('Serial Number')
                                    ->nullable()
                                    ->visible(fn($get) => $get('requires_serial_number') === 'yes')
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefixIcon('heroicon-o-tag')
                                    ->placeholder('Masukkan serial number...'),

                                    Forms\Components\TextInput::make('harga_jual')
                                    ->label('Harga Jual')
                                    ->numeric()
                                    ->nullable()
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefix('IDR')
                                    ->prefixIcon('heroicon-o-currency-dollar')
                                    ->reactive()
                                    ->placeholder('Masukkan harga jual...'),
                                
                                Forms\Components\TextInput::make('harga_beli')
                                    ->label('Harga Beli')
                                    ->numeric()
                                    ->nullable()
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefix('IDR')
                                    ->prefixIcon('heroicon-o-currency-dollar')
                                    ->placeholder('Masukkan harga beli...')
                                    ->reactive(),

                                Forms\Components\Select::make('status_list')
                                    ->label('Status')
                                    ->placeholder('Pilih status barang...')
                                    ->options([
                                        'Belum dipesan' => 'Belum dipesan',
                                        'Sudah dipesan' => 'Sudah dipesan',
                                        'Barang sampai' => 'Barang sampai',
                                        'Barang diserahkan ke user' => 'Barang diserahkan ke user'
                                    ])
                                    ->required()
                                    ->extraAttributes(['class' => 'form-control'])
                                    ->prefixIcon('heroicon-o-check-circle'),

                                Forms\Components\DatePicker::make('jatuh_tempo')
                                    ->label('Batas Penerimaan Barang')
                                    ->required()
                                    ->placeholder('Pilih tanggal barang diterima oleh TJ')
                                    ->extraAttributes(['class' => 'form-control bootstrap-datepicker'])
                                    ->prefixIcon('heroicon-o-calendar'),
                            ])
                            ->columns(2)
                            ->visible(fn($get) => filled($get('total_items')))
                            ->disabled(fn($get) => !filled($get('total_items')))
                            ->minItems(fn($get) => $get('total_items') ?? 0)
                            ->maxItems(fn($get) => $get('total_items') ?? 0)
                            ->defaultItems(0)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('total_items', count($state));
                            })
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_barang'),
                Tables\Columns\TextColumn::make('banyak_unit'),
                Tables\Columns\TextColumn::make('garansi'),
                Tables\Columns\TextColumn::make('lokasi'),
                Tables\Columns\TextColumn::make('status_list')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Belum dipesan' => 'danger',
                        'Sudah dipesan' => 'warning',
                        'Barang sampai' => 'info',
                        'Barang diserahkan ke user' => 'success',
                        default => 'secondary',
                    }),
            ])
            ->filters([
                SelectFilter::make('id_faktur')
                    ->label('No SPK')
                    ->relationship('faktur', 'no_spk'),

                SelectFilter::make('status_list')
                    ->label('Status')
                    ->options([
                        'Belum dipesan' => 'Belum dipesan',
                        'Sudah dipesan' => 'Sudah dipesan',
                        'Barang sampai' => 'Barang sampai',
                        'Barang diserahkan ke user' => 'Barang diserahkan ke user'
                    ]),
            ])
            ->groups([
                'faktur.no_spk',
            ])
            ->defaultGroup('faktur.no_spk')
            ->searchable()
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->button()
                    ->label('Baca')
                    ->color('info'),
                Tables\Actions\EditAction::make()
                    ->button()
                    ->label('Ubah')
                    ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->label('Hapus')
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil menghapus data isi Faktur')
                    )
                    ->successNotificationTitle(null)
            ])
            ->bulkActions([]);
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
            'view' => Pages\ViewIsiFaktur::route('/{record}'),
            'edit' => Pages\EditIsiFaktur::route('/{record}/edit'),
        ];
    }
}