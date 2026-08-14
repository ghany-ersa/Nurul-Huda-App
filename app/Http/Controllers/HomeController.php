<?php

namespace App\Http\Controllers;

use App\Models\DonationProgram;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GalleryPhoto;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $facilities = Facility::orderBy('order')->get();

        $galleryPhotos = GalleryPhoto::orderBy('order')->get();

        $activeDonationPrograms = DonationProgram::query()
            ->orderByDesc('created_at')
            ->get()
            ->filter(fn (DonationProgram $program): bool => $program->status === 'active')
            ->take(3);

        $upcomingEvents = Event::query()
            ->whereNotNull('event_date')
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(3)
            ->get();

        return view('home', [
            'facilities' => $facilities,
            'galleryPhotos' => $galleryPhotos,
            'activeDonationPrograms' => $activeDonationPrograms,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}
