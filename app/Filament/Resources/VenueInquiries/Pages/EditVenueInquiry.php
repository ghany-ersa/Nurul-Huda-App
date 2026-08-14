<?php

namespace App\Filament\Resources\VenueInquiries\Pages;

use App\Filament\Resources\VenueInquiries\VenueInquiryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVenueInquiry extends EditRecord
{
    protected static string $resource = VenueInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
