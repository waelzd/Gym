<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Define which fields can be mass-assigned
    protected $fillable = [
        'gym_name', 'currency', 'monthly_target',
    ];
}
