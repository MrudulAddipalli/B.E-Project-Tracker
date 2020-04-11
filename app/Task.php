<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;
    
    protected $table = 'task';
    protected $primaryKey = 'id';
}
