<?php

namespace App\Filament\Resources\VenueInquiries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VenueInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required(),
                DatePicker::make('planned_date')
                    ->label('Rencana Tanggal')
                    ->required(),
                Textarea::make('note')
                    ->label('Catatan')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->label('Status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
