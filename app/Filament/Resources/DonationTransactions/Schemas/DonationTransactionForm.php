<?php

namespace App\Filament\Resources\DonationTransactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class DonationTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('donation_program_id')
                    ->label('Program Donasi')
                    ->relationship('donationProgram', 'name')
                    ->required(),
                TextInput::make('donor_name')
                    ->label('Nama Donatur'),
                TextInput::make('amount')
                    ->label('Nominal')
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input, ".")'))
                    ->stripCharacters('.')
                    ->required()
                    ->numeric(),
                DatePicker::make('donated_at')
                    ->label('Tanggal Donasi')
                    ->required(),
                Textarea::make('note')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}
