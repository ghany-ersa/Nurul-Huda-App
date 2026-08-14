<?php

namespace App\Observers;

use App\Models\Facility;
use Illuminate\Support\Facades\Storage;

class FacilityObserver
{
    /**
     * Handle the Facility "deleted" event.
     */
    public function deleted(Facility $facility): void
    {
        if ($facility->photo) {
            Storage::delete($facility->photo);
        }
    }
}
