<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventObserver
{
    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        if ($event->poster) {
            Storage::delete($event->poster);
        }
    }
}
