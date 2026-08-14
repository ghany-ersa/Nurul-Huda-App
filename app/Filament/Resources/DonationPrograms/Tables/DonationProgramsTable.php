<?php

namespace App\Filament\Resources\DonationPrograms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonationProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_photo')
                    ->label('Foto Sampul'),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                TextColumn::make('target_amount')
                    ->label('Target Nominal')
                    ->money('IDR', locale: 'id', decimalPlaces: 0)
                    ->sortable(),
                TextColumn::make('collected_amount')
                    ->label('Nominal Terkumpul')
                    ->money('IDR', locale: 'id', decimalPlaces: 0)
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'upcoming' => 'Akan Datang',
                        'active' => 'Aktif',
                        'completed' => 'Selesai',
                        'expired' => 'Berakhir',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'gray',
                        'active' => 'success',
                        'completed' => 'info',
                        'expired' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('starts_at')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->sortable(),
                TextColumn::make('ends_at')
                    ->label('Tanggal Selesai')
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
