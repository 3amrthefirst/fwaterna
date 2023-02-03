<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use GetAttribute , HasApiTokens;
    protected $table = "companies";
    public $timestamps = true ;
    protected $fillable = [
        'name',
        'subscription_id',
        'subscription_end_date',
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function category()
    {
        return $this->hasMany(Category::class , 'company_id');
    }
    public function client()
    {
        return $this->hasMany(Category::class , 'company_id');
    }
    public function subscribe()
    {
       return $this->belongsTo(Subscribtion::class);
    }

}
