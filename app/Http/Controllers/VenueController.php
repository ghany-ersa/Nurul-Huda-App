<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Contracts\View\View;

class VenueController extends Controller
{
    public function __invoke(): View
    {
        $venue = Facility::query()
            ->where('name', 'Aula Serbaguna')
            ->with('photos')
            ->first();

        return view('venue.index', [
            'venue' => $venue,
        ]);
    }
}
