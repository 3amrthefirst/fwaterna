<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use LogTrait;

    public $guard_name = 'contacts';

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array('full_name','email','phone','business','question','answer','created_at');
    protected $dates = [
        'created_at',
    ];
}
