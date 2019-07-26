<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'customer_details', 'payment_date', 'due_date', 'total_price', 'balance', 'payment_percent'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tracking';
}
