<?php

namespace Helper;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Str;


class Helper
{

    public $error = ['error' => true, 'status' => 400];
    public $success = ['success' => true, 'status' => 200];
    public $status = ['error' => 400, 'success' => 200];

    protected $responseTo;

    public function __construct($responseTo = 'api')
    {
        $this->responseTo = $responseTo;
    }

    //////////////////////////////////////////////////////////////////////
    ///

    public function getResponseTo()
    {
        echo $this->responseTo;
    }


    /**
     * @param $input
     * @return mixed
     */
    static function convertEnglishNumbersToPersian($input)
    {
        $persian = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', 'ص', 'م'];
        $english = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'AM', 'PM'];
        return str_replace($persian, $english, $input);
    }

    /**
     * @param $key
     * @param $array
     * @param $value
     * @return mixed
     */
    static function inArray($key, $array, $value)
    {
        $return = array_key_exists($key, $array) ? $array[$key] : $value;
        return $return;
    }

    static function responseJson($status, $message, $data = null)
    {

        if ($data == null) {
            $response =
                [
                    'status' => $status,
                    'message' => $message
                ];
        } else {
            $response =
                [
                    'status' => $status,
                    'message' => $message,
                    'data' => $data
                ];
        }

        return response()->json($response);
    }

    /**
     * @param $model
     * @param  $totalCount
     * @return array
     */
    public function ratePresent($model, $totalCount): array
    {
        $array = [];

        for ($i = 1; $i <= 5; $i++) {
            $array += [$i => (int)($model->reviews()->where('rate', $i)->count() ? ($model->reviews()->where('rate', $i)->count() / $totalCount) * 100 : 0)];
        }

        return $array;
    }

    public function switchResponseJson($status = 'success', $message = null, $data = [])
    {
        $responseData = $this->$status;
        $responseData += ['message' => $message, 'data' => $data];
        $status_code = $this->status[$status];

        if ($this->responseTo == 'web') {

            return response()->json($responseData, $status_code);
        }

        $response =
            [
                'code' => $status_code,
                'status' => $status == 'success' ? 1 : 0,
                'massage' => $message,
                'data' => $data
            ];

        return response()->json($response);
    }

    /**
     * @param $lat
     * @param $lon
     * @return  mixed
     */
    public function getLocation($lat, $lon)
    {
        $select = '*, ( 6367 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) *
                    cos( radians( longitude ) - radians(' . $lon . ') ) + sin( radians(' . $lat . ') )
                    * sin( radians( latitude ) ) ) ) AS distance';
        return $select;
    }

    /**
     * @param $key
     * @param string $value
     * @return string
     */
    public static function settingValue($key, $value = '')
    {
        $value = Setting::where('key', $key)->first() ? Setting::where('key', $key)->first()->value : $value;
        return $value;
    }

///
//////////////////////////////////////////////////////////////////////

    static function generateCode($tableModel, $record, $rowName = 'code', $char_number = 30)
    {
        $code = Str::random($char_number);

        $test_record = $tableModel->where($rowName, $code)->first();

        if ($test_record) {
            self::generateCode($tableModel, $record, $rowName);
        } else {
            return $code;
        }

    }


    static function generateSlug($model, $from, $id = null, $separator = '-')
    {
        $slug = '';

        foreach ($from as $word) {
            $slug .= str_replace(' ', $separator, $word) . $separator;
        }

        $record = $model->where('slug', 'LIKE', $slug . '%')->where('id', '!=', $id)->latest('updated_at')->first();

        if ($record) {

            $number = intval(str_replace($slug, '', $record->slug)) + 1;
            return $slug . $number;
        } else {
            if ($id == null || $model->find($id)->slug == null) {
                return $slug . 1;
            }

            return $model->find($id)->slug;
        }

    }

    static function generateChar()
    {
        $array = [Str::random(1), rand(0, 9)];
        return $array[rand(0, 1)];
    }



//////////////////////////////////////////////////////////////////////
///
    static function ResetPassword($model, $password)
    {
        $model->password = Hash::make($password);
        $model->save();
        return true;
    }

    static function readNotification($notification_id, $user_id, $relation = 'users')
    {
        $notification = Notification::find($notification_id);

        if ($notification) {
            $notification->$relation()->updateExistingPivot($user_id, ['is_read' => 1]);
        }

    }


    static function removeToken($token)
    {
        Token::where('token', $token)->delete();
    }

    static function is_read($model)
    {
        if ($model->is_read == 0) {
            $model->is_read = 1;
            $model->save();
            return true;
        } else {
            return false;
        }
    }


    static function convertDateTime($dateTime)
    {
        $date = Carbon::parse($dateTime)->toDateTimeString();

        return $date;
    }

    static function convertDateTimeNotString($dateTime)
    {
        $date = Carbon::parse($dateTime);

        return $date;
    }

    static function toggleBoolean($model, $name = 'is_active', $open = 1, $close = 0)
    {
        if ($model->$name == $open) {
            $model->$name = $close;
            $model->save();

        } elseif ($model->$name == $close) {
            $model->$name = $open;
            $model->save();
        } else {
            return false;
        }

        return true;
    }


    static function toggleBooleanView($model, $url, $switch = 'is_active', $open = 1, $close = 0)
    {
        return view('admin.my-helper-partials.toggle-boolean-view', compact('model', 'url', 'switch', 'open', 'close'))->render();
    }

    static function ratStars($gold_stars, $style = '', $class = 'label-primary')
    {
        $style .= 'color : gold !important;';
        $empty_star = '<span> <i class="fa fa-star-o"></i> </span>';
        $gold_star = '<span> <i class="fa fa-star"></i> </span>';
        $half_star = '<span> <i class="fa fa-star-half-o" style="transform: rotateY(180deg);"></i> </span>';
        $html = '<label class="' . $class . '" style="' . $style . '">';

        for ($i = 1; $i <= 5; $i++) {
            if ($gold_stars > 0 && $gold_stars >= 1) {
                $html .= $gold_star;
                $gold_stars--;

            } elseif ($gold_stars > 0 && $gold_stars < 1) {
                $html .= $half_star;
                $gold_stars--;

            } elseif ($gold_stars <= 0) {
                $html .= $empty_star;
            }
        }
        $html .= '</label>';
        return $html;
    }

    static function frontRate($gold_stars)
    {
        $empty_star = '☆';
        $gold_star = '★';
        $html = '';

        for ($i = 1; $i <= 5; $i++) {
            if ($gold_stars > 0 && $gold_stars >= 1) {
                $html .= $gold_star;
                $gold_stars--;

            } elseif ($gold_stars <= 0) {
                $html .= $empty_star;
            }
        }
        $html .= '';
        return $html;
    }

    static function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function remainingBudget()
    {
       $spent =  \DB::table('approved_extract_item')->sum('amount');
       $total = Item::sum('total_amount');
       return $total - $spent;
    }

    /*
         * Code converted by Saleh Jamal (@salehjamal)
         */
    static function intPart($float)
    {
        if ($float < -0.0000001)
            return ceil($float - 0.0000001);
        else
            return floor($float + 0.0000001);
    }

    static function hijriToGeorgian($day, $month, $year, $string = false)
    {
        $day = (int)$day;
        $month = (int)$month;
        $year = (int)$year;

        $jd = self::intPart((11 * $year + 3) / 30) + 354 * $year + 30 * $month - self::intPart(($month - 1) / 2) + $day + 1948440 - 385;

        if ($jd > 2299160) {
            $l = $jd + 68569;
            $n = self::intPart((4 * $l) / 146097);
            $l = $l - self::intPart((146097 * $n + 3) / 4);
            $i = self::intPart((4000 * ($l + 1)) / 1461001);
            $l = $l - self::intPart((1461 * $i) / 4) + 31;
            $j = self::intPart((80 * $l) / 2447);
            $day = $l - self::intPart((2447 * $j) / 80);
            $l = self::intPart($j / 11);
            $month = $j + 2 - 12 * $l;
            $year = 100 * ($n - 49) + $i + $l;
        } else {
            $j = $jd + 1402;
            $k = self::intPart(($j - 1) / 1461);
            $l = $j - 1461 * $k;
            $n = self::intPart(($l - 1) / 365) - self::intPart($l / 1461);
            $i = $l - 365 * $n + 30;
            $j = self::intPart((80 * $i) / 2447);
            $day = $i - self::intPart((2447 * $j) / 80);
            $i = self::intPart($j / 11);
            $month = $j + 2 - 12 * $i;
            $year = 4 * $k + $n + $i - 4716;
        }

        $data = array();
        $date['year'] = $year;
        $date['month'] = $month;
        $date['day'] = $day;

        if (!$string)
            return $date;
        else
            return "{$year}-{$month}-{$day}";
    }

    static function georgianToHijri($day, $month, $year, $string = false)
    {
        $day = (int)$day;
        $month = (int)$month;
        $year = (int)$year;

        if (($year > 1582) or (($year == 1582) and ($month > 10)) or (($year == 1582) and ($month == 10) and ($day > 14))) {
            $jd = self::intPart((1461 * ($year + 4800 + self::intPart(($month - 14) / 12))) / 4) + self::intPart((367 * ($month - 2 - 12 * (self::intPart(($month - 14) / 12)))) / 12) -
                self::intPart((3 * (self::intPart(($year + 4900 + self::intPart(($month - 14) / 12)) / 100))) / 4) + $day - 32075;
        } else {
            $jd = 367 * $year - self::intPart((7 * ($year + 5001 + self::intPart(($month - 9) / 7))) / 4) + self::intPart((275 * $month) / 9) + $day + 1729777;
        }

        $l = $jd - 1948440 + 10632;
        $n = self::intPart(($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;
        $j = (self::intPart((10985 - $l) / 5316)) * (self::intPart((50 * $l) / 17719)) + (self::intPart($l / 5670)) * (self::intPart((43 * $l) / 15238));
        $l = $l - (self::intPart((30 - $j) / 15)) * (self::intPart((17719 * $j) / 50)) - (self::intPart($j / 16)) * (self::intPart((15238 * $j) / 43)) + 29;

        $month = self::intPart((24 * $l) / 709);
        $day = $l - self::intPart((709 * $month) / 24);
        $year = 30 * $n + $j - 30;

        $date = array();
        $date['year'] = $year;
        $date['month'] = $month;
        $date['day'] = $day;

        if (!$string)
            return $date;
        else
            return "{$year}-{$month}-{$day}";
    }

    public static function getFileNameByUrl($url)
    {
        $urlParts = explode('/',$url);
        $nameParts = explode('-_-',end($urlParts));
        return current($nameParts);
    }

    public static function extractStart()
    {
        if (request('from'))
        {
            return request('from');
        }
        return Carbon::now()->subMonths()->startOfMonth()->format('Y/m/d');
    }

    public static function extractEnd()
    {
        if (request('to'))
        {
            return request('to');
        }
        return Carbon::now()->subMonth()->endOfMonth()->format('Y/m/d');
    }

    public static function extractPaymentNum()
    {
        if (request('payment_num'))
        {
            return request('payment_num');
        }
        $contractStart = Carbon::parse(app('settings')->project_start_date);
        return Carbon::now()->diffInMonths($contractStart);
    }

}
