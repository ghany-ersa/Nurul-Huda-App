<?php

namespace App\Models;

use Database\Factories\DocumentationPhotoFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['photo', 'caption', 'order'])]
#[Appends(['photo_url'])]
class DocumentationPhoto extends Model
{
    /** @use HasFactory<DocumentationPhotoFactory> */
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

    public function photoable(): MorphTo
    {
        return $this->morphTo();
    }
}
