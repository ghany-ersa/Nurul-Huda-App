<?php

namespace App\Filament\Resources\CommitteeMembers\Schemas;

use App\Filament\Concerns\CompressesUploadedImages;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommitteeMemberForm
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
                TextInput::make('position')
                    ->label('Jabatan')
                    ->required(),
                self::compressImageUpload(
                    FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->imageEditor()
                        ->directory('committee-members'),
                ),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel(),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
