<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackingPayments extends Model
{
    protected $fillable = [
        'tracking_id','date_of_payment','ordered_product','product_price',
        'partial_payment','balance','payment_percent','remittance_details', 
        'upload_pic', 'remarks','approve_pay',
    ];
    protected $primaryKey = 'id';
    protected $table = 'tracking_payments';
}
