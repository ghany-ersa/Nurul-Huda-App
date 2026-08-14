<?php

namespace App\Filament\Resources\FinancialReports\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FinancialReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('period_month')
                    ->label('Bulan Periode')
                    ->required()
                    ->numeric(),
                TextInput::make('period_year')
                    ->label('Tahun Periode')
                    ->required()
                    ->numeric(),
                TextInput::make('type')
                    ->label('Jenis')
                    ->required(),
                TextInput::make('category')
                    ->label('Kategori')
                    ->required(),
                TextInput::make('amount')
                    ->label('Nominal')
                    ->required()
                    ->numeric(),
                Textarea::make('description')
                    ->label('Keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
