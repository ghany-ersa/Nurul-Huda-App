<?php

namespace App\Filament\Resources\DonationPrograms\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                TextInput::make('target_amount')
                    ->label('Target Nominal')
                    ->required()
                    ->numeric(),
                TextInput::make('collected_amount')
                    ->label('Nominal Terkumpul')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('cover_photo')
                    ->label('Foto Sampul')
                    ->image()
                    ->imageEditor()
                    ->directory('donation-programs'),
                TextInput::make('status')
                    ->label('Status')
                    ->required()
                    ->default('active'),
                DatePicker::make('starts_at')
                    ->label('Tanggal Mulai'),
                DatePicker::make('ends_at')
                    ->label('Tanggal Selesai'),
            ]);
    }
}
