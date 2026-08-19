<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\CompressesUploadedImages;
use App\Models\VenuePage;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageVenuePage extends Page
{
    use CompressesUploadedImages;

    protected string $view = 'filament.pages.manage-venue-page';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = 'Kegiatan & Keuangan';

    protected static ?string $navigationLabel = 'Halaman Akad Venue';

    protected static ?string $title = 'Halaman Akad Venue';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    TextInput::make('hero_title')
                        ->label('Judul Hero')
                        ->required(),
                    TextInput::make('hero_subtitle')
                        ->label('Subjudul Hero')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('availability_badge')
                        ->label('Badge Ketersediaan')
                        ->required(),
                    TextInput::make('description_title')
                        ->label('Judul Deskripsi')
                        ->required(),
                    Textarea::make('description')
                        ->label('Deskripsi Venue')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                    Textarea::make('testimonial')
                        ->label('Kutipan Testimonial')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),
                    TextInput::make('wa_number')
                        ->label('Nomor WhatsApp Tujuan')
                        ->required()
                        ->tel()
                        ->helperText('Format internasional tanpa tanda + atau 0, mis. 6281234567890'),
                    Repeater::make('facilities')
                        ->label('Daftar Fasilitas')
                        ->schema([
                            Select::make('icon')
                                ->label('Ikon')
                                ->options([
                                    'user-group' => 'Kapasitas Tamu',
                                    'sun' => 'Pendingin Ruangan',
                                    'musical-note' => 'Sound System',
                                    'truck' => 'Area Parkir',
                                    'sparkles' => 'Wudhu Terpisah',
                                    'check-circle' => 'Suasana Khidmat',
                                ])
                                ->required(),
                            TextInput::make('label')
                                ->label('Label')
                                ->required(),
                        ])
                        ->columns(2)
                        ->columnSpanFull()
                        ->reorderable()
                        ->required(),
                    Repeater::make('photos')
                        ->label('Galeri Dokumentasi')
                        ->relationship()
                        ->schema([
                            self::compressImageUpload(
                                FileUpload::make('photo')
                                    ->label('Foto')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('venue-page')
                                    ->required(),
                            ),
                            TextInput::make('caption')
                                ->label('Keterangan')
                                ->maxLength(255),
                        ])
                        ->columns(2)
                        ->columnSpanFull()
                        ->reorderable('order')
                        ->orderColumn('order')
                        ->defaultItems(0)
                        ->visible(fn (): bool => $this->getRecord() !== null)
                        ->helperText(fn (): ?string => $this->getRecord() === null
                            ? 'Simpan konten venue terlebih dahulu sebelum menambahkan galeri.'
                            : null),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord() ?? new VenuePage)
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        unset($data['photos']);

        $record = $this->getRecord() ?? new VenuePage;
        $record->fill($data);
        $record->save();

        $this->form->record($record)->saveRelationships();

        Notification::make()
            ->success()
            ->title('Tersimpan')
            ->send();
    }

    public function getRecord(): ?VenuePage
    {
        return VenuePage::query()->first();
    }
}
