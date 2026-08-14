<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Filament\Concerns\CompressesUploadedImages;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    use CompressesUploadedImages;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->live(onBlur: true),
                Select::make('type')
                    ->label('Jenis')
                    ->options([
                        'kajian' => 'Kajian',
                        'event' => 'Event',
                    ])
                    ->required(),
                TextInput::make('speaker')
                    ->label('Pengisi'),
                Select::make('day_of_week')
                    ->label('Hari')
                    ->options([
                        0 => 'Minggu',
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                    ]),
                TimePicker::make('time')
                    ->label('Jam'),
                DatePicker::make('event_date')
                    ->label('Tanggal Acara'),
                self::compressImageUpload(
                    FileUpload::make('poster')
                        ->label('Poster')
                        ->image()
                        ->imageEditor()
                        ->directory(fn (Get $get): string => 'events/'.Str::slug($get('title'))),
                ),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
            ]);
    }
}
