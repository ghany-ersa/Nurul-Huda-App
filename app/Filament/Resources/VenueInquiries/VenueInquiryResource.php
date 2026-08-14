<?php

namespace App\Filament\Resources\VenueInquiries;

use App\Filament\Resources\VenueInquiries\Pages\CreateVenueInquiry;
use App\Filament\Resources\VenueInquiries\Pages\EditVenueInquiry;
use App\Filament\Resources\VenueInquiries\Pages\ListVenueInquiries;
use App\Filament\Resources\VenueInquiries\Schemas\VenueInquiryForm;
use App\Filament\Resources\VenueInquiries\Tables\VenueInquiriesTable;
use App\Models\VenueInquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VenueInquiryResource extends Resource
{
    protected static ?string $model = VenueInquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Kegiatan & Keuangan';

    public static function getModelLabel(): string
    {
        return 'Pengajuan Venue';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pengajuan Venue';
    }

    public static function form(Schema $schema): Schema
    {
        return VenueInquiryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VenueInquiriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVenueInquiries::route('/'),
            'create' => CreateVenueInquiry::route('/create'),
            'edit' => EditVenueInquiry::route('/{record}/edit'),
        ];
    }
}
