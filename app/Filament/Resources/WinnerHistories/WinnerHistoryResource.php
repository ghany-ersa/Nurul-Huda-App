<?php

namespace App\Filament\Resources\WinnerHistories;

use App\Filament\Resources\WinnerHistories\Pages\CreateWinnerHistory;
use App\Filament\Resources\WinnerHistories\Pages\EditWinnerHistory;
use App\Filament\Resources\WinnerHistories\Pages\ListWinnerHistories;
use App\Filament\Resources\WinnerHistories\Schemas\WinnerHistoryForm;
use App\Filament\Resources\WinnerHistories\Tables\WinnerHistoriesTable;
use App\Models\WinnerHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WinnerHistoryResource extends Resource
{
    protected static ?string $model = WinnerHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Undian';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return WinnerHistoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WinnerHistoriesTable::configure($table);
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
            'index' => ListWinnerHistories::route('/'),
            'create' => CreateWinnerHistory::route('/create'),
            'edit' => EditWinnerHistory::route('/{record}/edit'),
        ];
    }
}
