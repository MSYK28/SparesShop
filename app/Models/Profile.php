<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'fratij_profiles';

    protected $fillable = [
        'company',
        'part',
        'barcode',
    ];
}
