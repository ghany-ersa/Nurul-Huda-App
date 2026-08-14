<?php

namespace App\Models;

use Database\Factories\CommitteeMemberFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'position', 'photo', 'phone', 'order'])]
#[Appends(['photo_url'])]
class CommitteeMember extends Model
{
    /** @use HasFactory<CommitteeMemberFactory> */
    use HasFactory;

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => match (true) {
                ! $this->photo => null,
                str_contains($this->photo, 'https') => $this->photo,
                default => Storage::url($this->photo),
            },
        );
    }
}
