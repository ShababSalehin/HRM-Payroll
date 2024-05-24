<?php

namespace App\Services\OTP;

use App\Contracts\SendSms;

class Bulk24sms implements SendSms {
    
    public function send($to, $from, $text, $template_id) {
        
        $api_key = env("BULK24SMS_API_KEY"); //put ssl provided api_token here
        $sender_id = env("BULK24SMS_SENDER_ID"); // put ssl provided sid here

        $url = 'https://24bulksms.com/24bulksms/api/otp-api-sms-send';

        $data = array('api_key' => $api_key,
         'sender_id' => $sender_id,
         'message' => $text,
         'mobile_no' => $to,
         'user_email'=> 'nasir@4axiz.com',
        );

        // use key 'http' even if you send the request to https://...
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
}

