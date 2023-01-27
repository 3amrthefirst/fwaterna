<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Laywer extends Model
{
    use LogTrait,GetAttribute;

    public $guard_name = 'laywers';

    protected $table = 'laywers';
    public $timestamps = true;
    protected $fillable = array('name');
}
