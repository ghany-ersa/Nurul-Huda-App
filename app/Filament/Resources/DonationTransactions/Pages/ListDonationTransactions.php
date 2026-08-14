<?php

namespace App\Filament\Resources\DonationTransactions\Pages;

use App\Filament\Resources\DonationTransactions\DonationTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDonationTransactions extends ListRecords
{
    protected static string $resource = DonationTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
