<?php

namespace App\Models;
use App\User ;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table      = 'logs';
    public    $timestamps = true;
    protected $fillable   = array('title', 'description', 'user_id', 'type');

    public function logable()
    {
        return $this->morphTo();
    }



    public function admin()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function getModelUrlAttribute()
    {
        $url  = 'home';

        $id  = $this->logable_id;

        switch ($this->logable_type)
        {
            case 'App\Models\Product':
                $url = 'products?id='. $id;
                break;

            case 'App\Models\Governorate':
                $url = 'governorates/'. $id;
                break;

            case 'App\Models\Client':
                $url = 'clients?id='. $id;
                break;

            case 'App\Models\Category':
                $url = 'categories?id='. $id;
                break;

            case 'App\Models\SubCategory':
                $url = 'categories'.$id.'/sub-categories';
                break;


        }

        return url('admin/'.$url);
    }

    public function getModelTypeAttribute()
    {
        $modelType = $this->logable_type;



    }

    public function getUserUrlAttribute()
    {
        $url  = '/home';
        $id  = $this->user_id;

        switch ($this->type)
        {
            case 'admin':
                $url = 'users?id='. $id;
                break;
            case 'client':
                $url = 'client/dashboard?id='. $id;
                break;
            case 'delivery':
                $url = 'deliveries?id='. $id;
                break;
            case 'store':
                $url = 'stores/'. $id;
                break;
        }

        return url('admin/'.$url);
    }

    public function getTypeTextAttribute()
    {
        $text  = '';

        switch ($this->type)
        {
            case 'admin':
                $text = 'مستخدم لوحة التحكم';
                break;
            case 'client':
                $text = 'عميل';
                break;
            case 'delivery':
                $text = 'طيار';
                break;
            case 'store':
                $text = 'محل';
                break;
        }

        return $text;
    }

    public function getUserAttribute()
    {
        $relation = $this->type;
        return  $this->$relation;
    }

    public static function createLog($log_model , $user , $title , $description = null , $type = 'admin')
    {
        $log_model->logs()->create([
            'user_id' => $user->id,
            'title' => $title,
            'description' => $description,
            'type' => $type,
        ]);
    }
}
