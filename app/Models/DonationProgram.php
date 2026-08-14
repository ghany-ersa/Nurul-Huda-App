<?php

namespace App\Models;

use Database\Factories\DonationProgramFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'slug', 'description', 'target_amount', 'cover_photo', 'starts_at', 'ends_at'])]
#[Appends(['collected_amount', 'status', 'cover_photo_url'])]
class DonationProgram extends Model
{
    /** @use HasFactory<DonationProgramFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'target_amount' => 'integer',
            'starts_at' => 'date',
            'ends_at' => 'date',
        ];
    }

    protected function coverPhotoUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => $this->cover_photo ? Storage::url($this->cover_photo) : null,
        );
    }

    protected function collectedAmount(): Attribute
    {
        return Attribute::make(
            get: fn (): int => $this->transactions()->sum('amount'),
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes): string {
                $hasStarted = $attributes['starts_at'] && Carbon::parse($attributes['starts_at'])->isPast();
                $isFulfilled = $this->collected_amount >= $attributes['target_amount'];
                $hasEnded = $attributes['ends_at'] && Carbon::parse($attributes['ends_at'])->isPast();

                if (! $hasStarted) {
                    return 'upcoming';
                }

                if ($isFulfilled) {
                    return 'completed';
                }

                if ($hasEnded) {
                    return 'expired';
                }

                return 'active';
            },
        );
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(DonationTransaction::class);
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(DocumentationPhoto::class, 'photoable')->orderBy('order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
