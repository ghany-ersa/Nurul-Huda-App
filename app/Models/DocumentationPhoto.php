<?php

namespace App\Models;

use Database\Factories\DocumentationPhotoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['photo', 'caption', 'order'])]
class DocumentationPhoto extends Model
{
    /** @use HasFactory<DocumentationPhotoFactory> */
    use HasFactory;

    public function photoable(): MorphTo
    {
        return $this->morphTo();
    }
}
