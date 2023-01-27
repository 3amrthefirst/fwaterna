<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use LogTrait,GetAttribute;

    public $guard_name = 'clients';

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name','phone','email','fax');
}
