<?php

namespace App\Filament\Resources\DonationPrograms\Schemas;

use App\Models\DonationProgram;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Support\Str;

class DonationProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->alphaDash()
                    ->unique(DonationProgram::class, 'slug', ignoreRecord: true)
                    ->dehydrateStateUsing(fn (?string $state) => Str::slug($state)),
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
