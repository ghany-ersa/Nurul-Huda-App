<?php

namespace App\Filament\Resources\GalleryPhotos\Schemas;

use App\Filament\Concerns\CompressesUploadedImages;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryPhotoForm
{
    use CompressesUploadedImages;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                self::compressImageUpload(
                    FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->imageEditor()
                        ->directory('gallery')
                        ->required(),
                ),
                TextInput::make('caption')
                    ->label('Keterangan'),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
