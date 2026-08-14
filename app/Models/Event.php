<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

#[Fillable(['title', 'type', 'speaker', 'day_of_week', 'time', 'event_date', 'poster', 'description'])]
#[Appends(['poster_url'])]
class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'day_of_week' => 'integer',
            'event_date' => 'date',
        ];
    }

    protected function posterUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => $this->poster ? Storage::url($this->poster) : null,
        );
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(DocumentationPhoto::class, 'photoable')->orderBy('order');
    }
}
