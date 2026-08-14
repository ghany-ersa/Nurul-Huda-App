<?php

namespace App\Observers;

use App\Models\CommitteeMember;
use Illuminate\Support\Facades\Storage;

class CommitteeMemberObserver
{
    /**
     * Handle the CommitteeMember "deleted" event.
     */
    public function deleted(CommitteeMember $committeeMember): void
    {
        if ($committeeMember->photo) {
            Storage::delete($committeeMember->photo);
        }
    }
}
