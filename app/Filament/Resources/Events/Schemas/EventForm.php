<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                TextInput::make('type')
                    ->label('Jenis')
                    ->required(),
                TextInput::make('speaker')
                    ->label('Pengisi'),
                TextInput::make('day_of_week')
                    ->label('Hari')
                    ->numeric(),
                TimePicker::make('time')
                    ->label('Jam'),
                DatePicker::make('event_date')
                    ->label('Tanggal Acara'),
                FileUpload::make('poster')
                    ->label('Poster')
                    ->image()
                    ->imageEditor()
                    ->directory('events'),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
            ]);
    }
}
