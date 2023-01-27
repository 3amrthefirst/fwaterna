<?php
namespace Helper;

class Sms
{
    private function unifonic($to, $message)
    {
        $url = 'http://api.unifonic.com/rest/Messages/Send';
        $push_payload = array(
            "AppSid" => "",
            "Recipient" => '2' . $to,
            "Body" => $message
        );

        $rest = curl_init();
        curl_setopt($rest, CURLOPT_URL, $url);
        curl_setopt($rest, CURLOPT_POST, 1);
        curl_setopt($rest, CURLOPT_POSTFIELDS, $push_payload);
        curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, false);  //disable ssl .. never do it online
        curl_setopt($rest, CURLOPT_HTTPHEADER,
            array(
                "Content-Type" => "application/x-www-form-urlencoded"
            ));
        curl_setopt($rest, CURLOPT_RETURNTRANSFER, 1); //by ibnfarouk to stop outputting result.
        $response = curl_exec($rest);
        return $response;
    }



    private function smsMisr($to,$message)
    {
        $to = is_array($to) ? $to : (array)$to;

        $addTwo = function ($number){
            return '2' . $number;
        };

        $to = array_map($addTwo, $to);


        $url = 'https://smsmisr.com/api/webapi/?';
        $push_payload = array(
            "username" => "",
            "password" => "",//01000000
            "language" => "2",
            "sender" => "",
            "mobile" => json_encode($to),
            "message" => $message,
        );


        $rest = curl_init();
        curl_setopt($rest, CURLOPT_URL, $url.http_build_query($push_payload));
        curl_setopt($rest, CURLOPT_POST, 1);
        curl_setopt($rest, CURLOPT_POSTFIELDS, $push_payload);
        curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, true);  //disable ssl .. never do it online
        curl_setopt($rest, CURLOPT_HTTPHEADER,
            array(
                "Content-Type" => "application/x-www-form-urlencoded"
            ));
        curl_setopt($rest, CURLOPT_RETURNTRANSFER, 1); //by ibnfarouk to stop outputting result.
        $response = curl_exec($rest);
        curl_close($rest);
        return $response;
    }

    public function send($to, $message, $provider = 'smsmisr')
    {
        if ($provider == 'smsmisr')
        {
            return $this->smsMisr($to,$message);
        }elseif ($provider == 'unifonic')
        {
            return $this->unifonic($to,$message);
        }else{
            return 'mismatch provider';
        }
    }


}