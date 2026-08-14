<?php

namespace App\Filament\Resources\DonationTransactions;

use App\Filament\Resources\DonationTransactions\Pages\CreateDonationTransaction;
use App\Filament\Resources\DonationTransactions\Pages\EditDonationTransaction;
use App\Filament\Resources\DonationTransactions\Pages\ListDonationTransactions;
use App\Filament\Resources\DonationTransactions\Schemas\DonationTransactionForm;
use App\Filament\Resources\DonationTransactions\Tables\DonationTransactionsTable;
use App\Models\DonationTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DonationTransactionResource extends Resource
{
    protected static ?string $model = DonationTransaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getModelLabel(): string
    {
        return 'Transaksi Donasi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Transaksi Donasi';
    }

    public static function form(Schema $schema): Schema
    {
        return DonationTransactionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonationTransactionsTable::configure($table);
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
            'index' => ListDonationTransactions::route('/'),
            'create' => CreateDonationTransaction::route('/create'),
            'edit' => EditDonationTransaction::route('/{record}/edit'),
        ];
    }
}
