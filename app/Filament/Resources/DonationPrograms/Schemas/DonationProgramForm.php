<?php

namespace App\Filament\Resources\DonationPrograms\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class DonationProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                TextInput::make('target_amount')
                    ->label('Target Nominal')
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input, ".")'))
                    ->stripCharacters('.')
                    ->required()
                    ->numeric(),
                TextInput::make('collected_amount')
                    ->label('Nominal Terkumpul')
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input, ".")'))
                    ->stripCharacters('.')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('cover_photo')
                    ->label('Foto Sampul')
                    ->image()
                    ->imageEditor()
                    ->directory('donation-programs'),
                DatePicker::make('starts_at')
                    ->label('Tanggal Mulai'),
                DatePicker::make('ends_at')
                    ->label('Tanggal Selesai'),
            ]);
    }
}
