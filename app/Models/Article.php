<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use LogTrait,GetAttribute,HasTranslations;
    public $translatable = [
        'title',
        'content',
    ];

    public $guard_name = 'articles';

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('title','content','price');
}
