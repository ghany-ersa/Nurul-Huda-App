<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueInquiryRequest;
use App\Models\VenueInquiry;
use App\Models\VenuePage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class VenueController extends Controller
{
    public function index(): View
    {
        return view('venue.index', [
            'page' => VenuePage::query()->with('photos')->firstOrFail(),
        ]);
    }

    public function store(StoreVenueInquiryRequest $request): RedirectResponse
    {
        $venueInquiry = VenueInquiry::create($request->validated());
        $page = VenuePage::query()->firstOrFail();

        $tanggal = $venueInquiry->planned_date->translatedFormat('d F Y');
        $pesan = "Assalamualaikum, saya {$venueInquiry->name} ingin mengajukan akad nikah di {$page->description_title} Masjid Nurul Huda pada tanggal {$tanggal}.";

        if ($venueInquiry->note) {
            $pesan .= " Catatan: {$venueInquiry->note}";
        }

        return redirect()->away(
            'https://wa.me/'.$page->wa_number.'?text='.rawurlencode($pesan)
        );
    }
}
