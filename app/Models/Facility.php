<?php

namespace App\Models;

use Database\Factories\FacilityFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'photo', 'order'])]
class Facility extends Model
{
    /** @use HasFactory<FacilityFactory> */
    use HasFactory;
}
