<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueInquiryRequest;
use App\Models\Facility;
use App\Models\VenueInquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class VenueController extends Controller
{
    private const string WA_NUMBER = '6285335104803';

    public function index(): View
    {
        $venue = Facility::query()
            ->where('name', 'Aula Serbaguna')
            ->with('photos')
            ->first();

        return view('venue.index', [
            'venue' => $venue,
        ]);
    }

    public function store(StoreVenueInquiryRequest $request): RedirectResponse
    {
        $venueInquiry = VenueInquiry::create($request->validated());

        $tanggal = $venueInquiry->planned_date->translatedFormat('d F Y');
        $pesan = "Assalamualaikum, saya {$venueInquiry->name} ingin mengajukan akad nikah di Aula Serbaguna Masjid Nurul Huda pada tanggal {$tanggal}.";

        if ($venueInquiry->note) {
            $pesan .= " Catatan: {$venueInquiry->note}";
        }

        return redirect()->away(
            'https://wa.me/'.self::WA_NUMBER.'?text='.rawurlencode($pesan)
        );
    }
}
