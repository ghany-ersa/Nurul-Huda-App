<?php

namespace App\Models;

use Database\Factories\VenueInquiryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'phone', 'planned_date', 'note', 'status'])]
class VenueInquiry extends Model
{
    /** @use HasFactory<VenueInquiryFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'planned_date' => 'date',
        ];
    }
}
