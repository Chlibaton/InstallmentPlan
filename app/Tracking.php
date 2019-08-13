<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'user_id','name','contact','address','email','ordered_product',
        'payment_date', 'due_date', 'total_price', 'balance', 'payment_percent',
        'pre_balance',
    ];
    protected $primaryKey = 'id';
    protected $table = 'tracking';
}
