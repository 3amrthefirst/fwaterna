<?php
namespace Helper;


use App\Models\Notification;
use App\Models\Setting;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Str;


class Translation
{
    public $trans_file;

    public function __construct($trans_file = 'api')
    {
        $this->trans_file = $trans_file;
    }

    public function getTransFile()
    {
        return $this->trans_file;
    }

    static function trans($string ,$trans_file = 'api')
    {

        return trans($trans_file. '.' . $string);
    }
}
