<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use SoapClient;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!env('SEND_SMS')) {
            return 'done!';
        }
        $result = $notification->toSms($notifiable);
        if (empty($result['numbers'])) {
            if ($notifiable->routes) {
                $toNum = $notifiable->routes['cellphone'];
            } else {
                $toNum = $notifiable->cellphone;
            }
            $toNum = array($toNum);
        } else {
            $toNum = $result['numbers'];
        }


        $user = "09162418808";
        $pass = "Faraz@5650064490";

        $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
        // send the text to multiple users as an ads
        if (array_key_exists('text', $result)) {

            $fromNum = "9999173212";
            ini_set("soap.wsdl_cache_enabled", "0");
            try {
                $messageContent = $result['text'];
                $op = "send";
                //If you want to send in the future  ==> $time = '2016-07-30' //$time = '2016-07-30 12:50:50'
                $time = '';
                $client->SendSMS($fromNum, $toNum, $messageContent, $user, $pass, $time, $op);
            } catch (SoapFault $ex) {
                throw $ex->faultstring;
            }
        } else {
            $fromNum = "+983000505";
            //send sms with pattern code to single user
            $pattern_code = $result['pattern_code'];
            $input_data = $result['pattern_variables'];
            $bulkId = $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
        }
    }
}
