<?php

namespace App\Filament\Resources\DonationTransactions\Pages;

use App\Filament\Resources\DonationTransactions\DonationTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDonationTransaction extends EditRecord
{
    protected static string $resource = DonationTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
