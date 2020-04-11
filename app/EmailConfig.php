<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailConfig extends Model
{
    public $timestamps = false;
    
    protected $table = 'emailconfig';
    protected $primaryKey = 'id';
}
