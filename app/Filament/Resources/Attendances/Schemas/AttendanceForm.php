<?php

namespace App\Filament\Resources\Attendances\Schemas;

use App\Models\Jamaah;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('jamaah_id')
                    ->relationship('jamaah', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state) {
                            $jamaah = Jamaah::find($state);
                            $set('rfid_code', $jamaah?->rfid);
                        }
                    })
                    ->live(),
                TextInput::make('rfid_code')
                    ->disabled()
                    ->placeholder('Akan terisi otomatis ketika Jamaah dipilih'),
                DateTimePicker::make('scanned_at')
                    ->required(),
                Select::make('prayer_time')
                    ->options([
                        'subuh' => 'Subuh',
                        'dzuhur' => 'Dzuhur',
                        'ashar' => 'Ashar',
                        'maghrib' => 'Maghrib',
                        'isya' => 'Isya',
                    ])
                    ->nullable(),
                Textarea::make('note')
                    ->rows(3)
                    ->nullable(),
            ]);
    }
}
