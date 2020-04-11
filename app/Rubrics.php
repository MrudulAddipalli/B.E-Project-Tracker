<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrics extends Model
{
    public $timestamps = false;
    
    protected $table = 'rubrics';
    protected $primaryKey = 'id';
}
