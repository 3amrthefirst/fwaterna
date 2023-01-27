<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use LogTrait,GetAttribute,HasTranslations;
    public $translatable = [
        'title',
        'content'
    ];
    public $guard_name = 'services';

    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = array('title','content');
}
