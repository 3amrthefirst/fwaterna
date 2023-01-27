<?php


namespace Helper;


use App\Models\Notification;
use App\Models\Setting;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Str;


class Response
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

    static function responseJson($status, $message, $data = null, $newAttr = [])
    {
        $response =
            [
                'data' => $data,
                'status' => $status,
                'massage' => $message,
            ];

        if (count($newAttr)) {
            $response += $newAttr;
        }

        return response()->json($response);
    }


}
