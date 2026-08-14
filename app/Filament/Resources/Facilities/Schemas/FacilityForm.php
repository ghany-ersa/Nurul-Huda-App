<?php

namespace App\Filament\Resources\Facilities\Schemas;

use App\Filament\Concerns\CompressesUploadedImages;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FacilityForm
{
    use CompressesUploadedImages;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                self::compressImageUpload(
                    FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->imageEditor()
                        ->directory('facilities'),
                ),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
