<?php

namespace App\Filament\Resources\DonationTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonationTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donationProgram.name')
                    ->label('Program Donasi')
                    ->searchable(),
                TextColumn::make('donor_name')
                    ->label('Nama Donatur')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Nominal')
                    ->money('IDR', locale: 'id', decimalPlaces: 0)
                    ->sortable(),
                TextColumn::make('donated_at')
                    ->label('Tanggal Donasi')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
