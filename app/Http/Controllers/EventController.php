<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $kajianRutin = Event::query()
            ->where('type', 'kajian')
            ->orderBy('day_of_week')
            ->orderBy('time')
            ->get();

        $eventKhusus = Event::query()
            ->where('type', 'event')
            ->whereNotNull('event_date')
            ->orderBy('event_date')
            ->get();

        return view('events.index', [
            'kajianRutin' => $kajianRutin,
            'eventKhusus' => $eventKhusus,
        ]);
    }

    public function show(Event $event): View
    {
        $event->load('photos');

        return view('events.show', [
            'event' => $event,
        ]);
    }
}
