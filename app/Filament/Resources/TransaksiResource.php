<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Filament\Tables\Table;
use App\Models\JenisBarang;
use Illuminate\Routing\Route;
use Filament\Resources\Resource;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\TransaksiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransaksiResource\RelationManagers;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Select::make('pelangganId')
                    ->label('Nama Pelangan')
                    ->options(Pelanggan::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('jenisId')
                    ->label('Jenis Barang')
                    ->options(JenisBarang::all()->pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('harga satuan')
                    ->disabled()
                    ->required(),
                TextInput::make('jumlah')->required(),
                TextInput::make('total')
                    ->disabled()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('jenis cucian'),
                TextColumn::make('harga satuan'),
                TextColumn::make('jumlah'),
                TextColumn::make('total'),

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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
