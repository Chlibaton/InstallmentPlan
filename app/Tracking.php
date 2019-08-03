<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'name','contact','address','email','ordered_product', 'payment_date', 'due_date', 'total_price', 'balance', 'payment_percent',
        'remittance_details','payment_proof','remarks'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tracking';
}
