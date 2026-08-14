<?php

namespace App\Observers;

use App\Models\DonationProgram;
use Illuminate\Support\Facades\Storage;

class DonationProgramObserver
{
    /**
     * Handle the DonationProgram "deleted" event.
     */
    public function deleted(DonationProgram $donationProgram): void
    {
        if ($donationProgram->cover_photo) {
            Storage::delete($donationProgram->cover_photo);
        }
    }
}
