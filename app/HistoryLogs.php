<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLogs extends Model
{
    protected $fillable = [
       'user_id','name','last_login_at','last_login_at','last_login_ip'
    ];
    protected $primaryKey = 'id';
    protected $table = 'history_logs';
}
