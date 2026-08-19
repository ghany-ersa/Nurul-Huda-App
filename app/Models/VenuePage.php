<?php

namespace App\Models;

use Database\Factories\VenuePageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[Fillable(['hero_title', 'hero_subtitle', 'availability_badge', 'description_title', 'description', 'testimonial', 'wa_number', 'facilities'])]
class VenuePage extends Model
{
    /** @use HasFactory<VenuePageFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'facilities' => 'array',
        ];
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(DocumentationPhoto::class, 'photoable')->orderBy('order');
    }
}
