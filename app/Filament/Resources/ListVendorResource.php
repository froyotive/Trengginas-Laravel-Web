<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListVendorResource\Pages;
use App\Models\List_Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class ListVendorResource extends Resource
{
    protected static ?string $model = List_Vendor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Vendor';
    protected static ?string $modelLabel = 'Vendor';
    protected static ?string $pluralModelLabel = 'Vendors';
    protected static ?string $navigationGroup = 'Manajemen Vendor';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_vendor')
                    ->label('Nama Vendor')
                    ->required()
                    ->placeholder('Masukkan Nama Vendor')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-user'),

                Forms\Components\TextInput::make('alamat_vendor')
                    ->label('Alamat Vendor')
                    ->required()
                    ->placeholder('Masukkan Alamat Vendor')
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-map'),

                Forms\Components\TextInput::make('no_vendor')
                    ->label('Nomor Telepon Vendor')
                    ->required()
                    ->placeholder('Masukkan Nomor Telepon Vendor')
                    ->maxLength(14)
                    ->prefixIcon('heroicon-o-phone')
                    ->extraAlpineAttributes([
                        'x-data' => '{}',
                        'x-init' => 'if (!event.target.value.startsWith("+62")) { event.target.value = "+62" + event.target.value }',
                        'x-on:input' => 'if (!event.target.value.startsWith("+62")) { event.target.value = "+62" + event.target.value }',
                    ]),
            ])
            ->extraAttributes(['class' => 'form-bootstrap-datepicker']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_vendor')
                    ->label('Nama Vendor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat_vendor')
                    ->label('Alamat Vendor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_vendor')
                    ->label('Nomor Telepon Vendor')
                    ->sortable()
                    ->searchable(),
            ])
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
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil menghapus data Vendor')
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
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'view' => Pages\ViewVendor::route('/{record}'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}