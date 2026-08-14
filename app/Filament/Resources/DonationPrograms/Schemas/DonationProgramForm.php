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
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                    ->required()
                    ->live(onBlur: true)
                    ->formatStateUsing(fn (mixed $state): ?string => filled($state) ? number_format((float) $state, thousands_separator: '.') : null)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('target_amount', filled($state) ? number_format((float) str_replace('.', '', $state), thousands_separator: '.') : null);
                    })
                    ->dehydrateStateUsing(fn (?string $state): ?int => filled($state) ? (int) str_replace('.', '', $state) : null),
                FileUpload::make('cover_photo')
                    ->label('Foto Sampul')
                    ->image()
                    ->imageEditor()
                    ->directory(fn (Get $get): string => 'donation-programs/'.Str::slug($get('slug')))
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => 'cover.'.$file->getClientOriginalExtension(),
                    ),
                DatePicker::make('starts_at')
                    ->label('Tanggal Mulai'),
                DatePicker::make('ends_at')
                    ->label('Tanggal Selesai'),
            ]);
    }
}
