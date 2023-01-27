<?php


namespace App\MyHelper;


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

    static function responseJson($status, $massage, $data = null)
    {

        if ($data == null) {
            $response =
                [
                    'status' => (int)$status,
                    'massage' => $massage
                ];
        } else {
            $response =
                [
                    'status' => (int)$status,
                    'massage' => $massage,
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
    public function ratePresent($model , $totalCount): array
    {
        $array = [];

        for ($i = 1; $i <= 5; $i++)
        {
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

    public static function settingPhoto($key)
    {
        $settings = Setting::where('key', $key)->first() ? Setting::where('key', $key)->first() : new Setting;
        if ($settings->photo)
        {
            return $settings->photo->path;
        }
        return "";
    }

    function settings()
    {
        $settings =  \App\Models\Setting::first();
        if ($settings)
        {
            return $settings;
        }else{
            return new \App\Models\Setting;
        }
    }

    static function notifyByFirebase($title, $body, $tokens, $data = [])        // paramete 5 =>>>> $type
    {

        $registrationIDs = $tokens;

        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );

        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
            'notification' => $fcmMsg,
            'data' => $data
        );
        $headers = array(
            'Authorization: key=AAAArgUl0uk:APA91bFQzxCNbfRkGHuU6xuf4RRofQHIYCoyBe20pV-ldbH5A-qxydKuZG6vINUNMKGNFm1_Rug-8dvMK95lxnBSZi3blIfWM_IIyucEUofzApiuBBQQwEiZIErsyLd2HkjW1ma4wiG1',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    static function sendNotification($model, array $notifierIds, $relation, $title, $body, $data_type = 'admin', $data = []): void
    {
        if (count($notifierIds)) {
            $notification = $model->notifications()->create([
                'title' => $title,
                'body' => $body
            ]);


            $notification->$relation;
//            dd($relation);

            if (Token::whereIn('tokenable_id', $notifierIds)->count()) {
                $tokens = Token::whereIn('tokenable_id', $notifierIds)->pluck('token')->toArray();

                $data =
                    [
                        $data_type => $data
                    ];

                //send notification for client tokens
                helper::notifyByFirebase($notification->title, $notification->body, $tokens, $data);

            }
        }
    }

///
//////////////////////////////////////////////////////////////////////

    static function generateCode($tableModel, $record, $rowName = 'code')
    {
        $code = '#';
        for ($i = 0; $i < 5; $i++) {
            $code .= self::generateChar();
        }

        $test_record = $tableModel->where($rowName, $code)->first();

        if ($test_record) {
            self::generateCode($tableModel, $record, $rowName);
        } else {
            $record->$rowName = $code;
            $record->save();
            return true;
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

    static function toggleBoolean($model, $name = 'is_active' , $open = 1 , $close = 0)
    {
        if ($model->$name == $open) {
            $model->$name = $close;
            $model->save();
            return true;
        } elseif($model->$name == $close) {
            $model->$name = $open;
            $model->save();
            return true;
        }else{
            $model->$name = $close;
            $model->save();
            return false;
        }

        return true;
    }

    static function toggleBoolean1($model, $name = 'best_sale' , $open = 1 , $close = 0)
    {
        if ($model->$name == $open) {
            $model->$name = $close;
            $model->save();
            return true;
        } elseif($model->$name == $close) {
            $model->$name = $open;
            $model->save();
            return true;
        }else{
            $model->$name = $close;
            $model->save();
            return false;
        }

        return true;
    }

    static function toggleBooleanAccept($model, $name = 'accept' , $open = 1 , $close = 0)
    {
        if ($model->$name == $open) {
            $model->$name = $close;
            $model->save();
            return true;
        } elseif($model->$name == $close) {
            $model->$name = $open;
            $model->save();
            return true;
        }else{
            $model->$name = $close;
            $model->save();
            return false;
        }

        return true;
    }




    static function toggleBooleanView($model, $url, $switch = 'is_active' , $open = 1 , $close = 0)
    {
        return view('admin.my-helper-partials.toggle-boolean-view', compact('model', 'url', 'switch','open','close'))->render();
    }

    static function toggleBooleanViewAccept($model, $url, $switch = 'accept' , $open = 1 , $close = 0)
    {
        return view('my-helper-partials.toggle-boolean-view', compact('model', 'url', 'switch','open','close'))->render();
    }
    static function toggleBooleanViewStatus($model, $url, $switch = 'status' , $open = 1 , $close = 0)
    {
        return view('my-helper-partials.toggle-boolean-view', compact('model', 'url', 'switch','open','close'))->render();
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


    static function activationView($model, $url, $on_red = 'الغاء التفعيل', $on_blue = 'تفعيل')
    {
        $onclick = 'onclick="myFunction(' . $model->id . ')"';
        if ($model->activation == 1 && $on_blue != 'قبول') {
            return '<a class="btn btn-danger" href="' . $url . '" id="btn_' . $model->id . '" ' . $onclick . '>
                         ' . $on_red . '
                    </a>';
        } else {
            return ' <a class="btn btn-primary" style="width: 10rem;" href="' . $url . '" id="btn_' . $model->id . '" ' . $onclick . '>
                        ' . $on_blue . '
                    </a>';
        }
    }
}
