<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
                Forms\Components\TextInput::make('no_spk')
                    ->label('No. SPK')
                    ->required()
                    ->placeholder('Masukkan No. SPK')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-document-text'),

                Forms\Components\DatePicker::make('tgl_sk')
                    ->label('Tanggal Terbit SPK')
                    ->required()
                    ->placeholder('Pilih Tanggal Terbit SPK')
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar')
                    ->extraAttributes(['class' => 'bootstrap-datepicker']),

                Forms\Components\TextInput::make('user')
                    ->label('SPK User')
                    ->required()
                    ->placeholder('Masukkan SPK User')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-user'),

                Forms\Components\DatePicker::make('tgl_bast_vendor')
                    ->label('Tanggal BAST Vendor')
                    ->nullable()
                    ->placeholder('Pilih Tanggal BAST Vendor (Opsional)')
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar')
                    ->extraAttributes(['class' => 'bootstrap-datepicker']),

                Forms\Components\DatePicker::make('deadline_pekerjaan')
                    ->label('Deadline Pekerjaan')
                    ->required()
                    ->placeholder('Pilih Deadline Pekerjaan')
                    ->native(false)
                    ->prefixIcon('heroicon-o-clock')
                    ->extraAttributes(['class' => 'bootstrap-datepicker']),

                Forms\Components\TextInput::make('spk_tj_ke_vendor')
                    ->label('SPK TJ ke Vendor')
                    ->required()
                    ->placeholder('Masukkan SPK TJ ke Vendor')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-document'),

                Forms\Components\TextInput::make('nomor_folder_pekerjaan')
                    ->label('Nomor Folder Pekerjaan')
                    ->required()
                    ->placeholder('Masukkan Nomor Folder Pekerjaan')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-folder'),
            ])
            ->extraAttributes(['class' => 'form-bootstrap-datepicker']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_spk')
                    ->label('No. SPK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_folder_pekerjaan')
                    ->label('Nomor Folder Pekerjaan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user')
                    ->label('SPK User')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline_pekerjaan')
                    ->label('Deadline')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('countdown')
                    ->label('Countdown')
                    ->getStateUsing(function (Model $record) {
                        $deadline = Carbon::parse($record->deadline_pekerjaan);
                        $now = Carbon::now();

                        if ($now->gt($deadline)) {
                            return 'Telah Lewat Batas';
                        }

                        $diff = $now->diff($deadline);
                        $parts = [];

                        if ($diff->y > 0) {
                            $parts[] = $diff->y . ' tahun';
                        }
                        if ($diff->m > 0) {
                            $parts[] = $diff->m . ' bulan';
                        }
                        if ($diff->d > 0) {
                            $parts[] = $diff->d . ' hari';
                        }
                        if (empty($parts)) {
                            if ($diff->h > 0) {
                                $parts[] = $diff->h . ' jam';
                            }
                            if ($diff->i > 0) {
                                $parts[] = $diff->i . ' menit';
                            }
                        }

                        return implode(' ', $parts) . ' lagi';
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Add any filters you need here
            ])
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'view' => Pages\ViewFaktur::route('/{record}'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }
}
