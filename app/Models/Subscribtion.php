<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Subscribtion extends Model
{
    use LogTrait,GetAttribute;
    protected $table = "subscribtions";
    public $timestamps = true;
    protected $fillable = [
        'days',
        'text',
        'price'
    ];

}
