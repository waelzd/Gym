<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    // Define which fields can be mass-assigned
   protected $fillable = [
    'id',
    'name', 
    'phone', 
    'gender', 
    'subscription_date', // Correct column name
    'fees', 
    'status'
];
}
