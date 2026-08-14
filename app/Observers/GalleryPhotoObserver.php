<?php

namespace App\Observers;

use App\Models\GalleryPhoto;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoObserver
{
    /**
     * Handle the GalleryPhoto "deleted" event.
     */
    public function deleted(GalleryPhoto $galleryPhoto): void
    {
        if ($galleryPhoto->photo) {
            Storage::delete($galleryPhoto->photo);
        }
    }
}
