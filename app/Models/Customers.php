<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'fratij_customers';

    protected $fillable = [
        'name',
        'name' ,
        'email',
        'taxID',
        'phone_number',
        'status',
    ];
}
