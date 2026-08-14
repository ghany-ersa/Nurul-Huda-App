<?php

namespace App\Filament\Resources\DonationTransactions\Pages;

use App\Filament\Resources\DonationTransactions\DonationTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDonationTransaction extends CreateRecord
{
    protected static string $resource = DonationTransactionResource::class;
}
