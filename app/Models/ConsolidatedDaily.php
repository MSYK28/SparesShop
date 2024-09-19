<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsolidatedDaily extends Model
{
    use HasFactory;

    protected $table = 'fratij_consolidated_dailies';

    protected $fillable = [
        'cash_sales',
        'credit_sales',
        'revenue',
        'date',
    ];
}
