<?php

namespace App\Observers;

use App\Models\DocumentationPhoto;
use Illuminate\Support\Facades\Storage;

class DocumentationPhotoObserver
{
    /**
     * Handle the DocumentationPhoto "deleted" event.
     */
    public function deleted(DocumentationPhoto $documentationPhoto): void
    {
        if ($documentationPhoto->photo) {
            Storage::delete($documentationPhoto->photo);
        }
    }
}
