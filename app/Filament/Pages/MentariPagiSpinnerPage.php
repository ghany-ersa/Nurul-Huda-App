<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class MentariPagiSpinnerPage extends Page
{
    protected string $view = 'filament.pages.mentari-pagi-spinner-page';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static string|UnitEnum|null $navigationGroup = 'Undian';

    protected static ?string $navigationLabel = 'Spinner';

    protected static ?string $title = 'Mentari Pagi Spinner';

    protected static ?int $navigationSort = 50;

    public function getHeading(): string
    {
        return '';
    }

    public function getSpinnerUrl(): string
    {
        return route('mentari-pagi-spinner');
    }
}
