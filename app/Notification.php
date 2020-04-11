<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;
    
    protected $table = 'notification';
    protected $primaryKey = 'id';
}
