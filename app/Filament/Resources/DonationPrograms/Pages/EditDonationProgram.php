<?php

namespace App\Filament\Resources\DonationPrograms\Pages;

use App\Filament\Resources\DonationPrograms\DonationProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDonationProgram extends EditRecord
{
    protected static string $resource = DonationProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
