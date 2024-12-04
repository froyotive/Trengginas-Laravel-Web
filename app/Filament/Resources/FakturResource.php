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
                    ->required(),
                Forms\Components\DatePicker::make('tgl_sk')
                    ->label('Tanggal SPK')
                    ->required(),
                Forms\Components\TextInput::make('user')
                    ->label('SPK User')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_bast_vendor')
                    ->label('Tanggal BAST Vendor')
                    ->nullable(),
                Forms\Components\DatePicker::make('deadline_pekerjaan')
                    ->label('Deadline Pekerjaan')
                    ->required(),
                Forms\Components\TextInput::make('spk_tj_ke_vendor')
                    ->label('SPK TJ ke Vendor')
                    ->required(),
                Forms\Components\TextInput::make('nomor_folder_pekerjaan')
                    ->label('Nomor Folder Pekerjaan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_spk')
                    ->label('No. SPK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_sk')
                    ->label('Tanggal SPK')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user')
                    ->label('SPK User')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_bast_vendor')
                    ->label('Tanggal BAST Vendor')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deadline_pekerjaan')
                    ->label('Deadline Pekerjaan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('spk_tj_ke_vendor')
                    ->label('SPK TJ ke Vendor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_folder_pekerjaan')
                    ->label('Nomor Folder Pekerjaan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('countdown')
                    ->label('Countdown')
                    ->getStateUsing(function (Model $record) {
                        $deadline = Carbon::parse($record->deadline_pekerjaan);
                        $now = Carbon::now();
                        return $deadline->diffInDays($now) . ' days remaining';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'view' => Pages\ViewFaktur::route('/{record}'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }
}