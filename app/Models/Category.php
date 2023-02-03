<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use GetAttribute;
    protected $table = "categories";
    public $timestamps = true ;
    protected $fillable=[
        'company_id',
        'title'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
