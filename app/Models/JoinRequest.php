<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    use LogTrait;

    public $guard_name = 'join_requests';

    protected $table = 'join_requests';
    public $timestamps = true;
    protected $fillable = array('pad_name');
}
