<?php

namespace App\Models;

use Database\Factories\DonationProgramFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'description', 'target_amount', 'collected_amount', 'cover_photo', 'status', 'starts_at', 'ends_at'])]
class DonationProgram extends Model
{
    /** @use HasFactory<DonationProgramFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'target_amount' => 'integer',
            'collected_amount' => 'integer',
            'starts_at' => 'date',
            'ends_at' => 'date',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(DonationTransaction::class);
    }
}
