<?php

namespace App\Models;

use Database\Factories\FinancialReportFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['period_month', 'period_year', 'type', 'category', 'amount', 'description'])]
class FinancialReport extends Model
{
    /** @use HasFactory<FinancialReportFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'period_month' => 'integer',
            'period_year' => 'integer',
            'amount' => 'integer',
        ];
    }
}
