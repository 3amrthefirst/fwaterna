<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use LogTrait;

    public $guard_name = 'consults';

    protected $table = 'consults';
    public $timestamps = true;
    protected $fillable = array('full_name','email','phone','business','question');
}
