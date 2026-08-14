<?php

namespace App\Providers;

use App\Models\CommitteeMember;
use App\Models\DocumentationPhoto;
use App\Models\DonationProgram;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GalleryPhoto;
use App\Observers\CommitteeMemberObserver;
use App\Observers\DocumentationPhotoObserver;
use App\Observers\DonationProgramObserver;
use App\Observers\EventObserver;
use App\Observers\FacilityObserver;
use App\Observers\GalleryPhotoObserver;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FileUpload::configureUsing(function (FileUpload $fileUpload): void {
            $fileUpload->visibility('public');
        });

        DonationProgram::observe(DonationProgramObserver::class);
        DocumentationPhoto::observe(DocumentationPhotoObserver::class);
        GalleryPhoto::observe(GalleryPhotoObserver::class);
        Event::observe(EventObserver::class);
        Facility::observe(FacilityObserver::class);
        CommitteeMember::observe(CommitteeMemberObserver::class);
    }
}
