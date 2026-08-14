<?php

namespace App\Filament\Resources\DonationPrograms\RelationManagers;

use App\Filament\Concerns\CompressesUploadedImages;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotosRelationManager extends RelationManager
{
    use CompressesUploadedImages;

    protected static string $relationship = 'photos';

    protected static ?string $title = 'Galeri';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                self::compressImageUpload(
                    FileUpload::make('photo')
                        ->label('Foto')
                        ->image()
                        ->imageEditor()
                        ->directory(fn (): string => 'donation-programs/'.Str::slug($this->getOwnerRecord()->slug).'/photos')
                        ->getUploadedFileNameForStorageUsing(function (Get $get): string {
                            $directory = 'donation-programs/'.Str::slug($this->getOwnerRecord()->slug).'/photos';
                            $baseName = Str::slug($get('caption'));

                            return static::uniqueFileName($directory, $baseName, 'jpg');
                        })
                        ->required(),
                ),
                TextInput::make('caption')
                    ->label('Keterangan')
                    ->maxLength(255)
                    ->live(onBlur: true),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->defaultSort('order')
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto'),
                TextColumn::make('caption')
                    ->label('Keterangan')
                    ->searchable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function uniqueFileName(string $directory, string $baseName, string $extension): string
    {
        $fileName = "{$baseName}.{$extension}";
        $suffix = 1;

        while (Storage::exists("{$directory}/{$fileName}")) {
            $fileName = "{$baseName}-{$suffix}.{$extension}";
            $suffix++;
        }

        return $fileName;
    }
}
