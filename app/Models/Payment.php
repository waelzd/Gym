<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Define which fields can be mass-assigned
    protected $fillable = [
        'subscriber_id', 'amount', 'payment_date',
    ];

    // Optionally, define the relationship with the Subscriber model
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
