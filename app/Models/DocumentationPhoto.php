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
            get: fn (): ?string => $this->photo ? Storage::url($this->photo) : null,
        );
    }

    public function photoable(): MorphTo
    {
        return $this->morphTo();
    }
}
