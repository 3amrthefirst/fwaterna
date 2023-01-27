<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    //

    protected $table = 'policies' ;

    protected $fillable = array('title','content');

    public $timestamps = true ;
}
