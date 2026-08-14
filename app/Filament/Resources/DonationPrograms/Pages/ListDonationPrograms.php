<?php

namespace App\Filament\Resources\DonationPrograms\Pages;

use App\Filament\Resources\DonationPrograms\DonationProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDonationPrograms extends ListRecords
{
    protected static string $resource = DonationProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
