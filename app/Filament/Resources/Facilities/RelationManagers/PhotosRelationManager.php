<?php

namespace App\Filament\Resources\Facilities\RelationManagers;

use App\Filament\Concerns\CompressesUploadedImages;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                        ->directory('documentation-photos')
                        ->required(),
                ),
                TextInput::make('caption')
                    ->label('Keterangan')
                    ->maxLength(255),
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
}
