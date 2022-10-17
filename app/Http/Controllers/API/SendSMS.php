<?php

namespace App\Http\Controllers\API;

require __DIR__ . "/zenenvia/php-rest-api/model/Sms.php";
require __DIR__ . "/zenenvia/php-rest-api/model/SmsFacade.php";
require __DIR__ . "/zenenvia/php-rest-api/autoload.php";

class SendSMS
{
    private $smsFacade;
    private $error;
    public $multi;
    private $smsList = [];
    private $sms;

    public function __construct()
    {

        $array = [
            'alias' => 'quality.smsonline',
            'password' => 'KS1ukAEpL2',
            'webServiceUrl' => 'https://api-rest.zenvia.com'
        ];

        $this->sms = new Sms();
        $this->smsFacade = new SmsFacade($array['alias'], $array['password'], $array['webServiceUrl']);

        $this->sms->setId(uniqid());
        $this->sms->setCallBackOption($this->sms::CALLBACK_NONE);
        array_push($this->smsList, $this->sms);
    }
    public function msgSend(string $setTo, string $setMsg)
    {
        $this->setTo = $setTo;
        $this->setMsg = $setMsg;
        $this->sms->setTo($this->setTo);
        $this->sms->setMsg($this->setMsg);

        try {
            $reponseList = $this->smsFacade->sendMultiple($this->smsList);

            foreach ($reponseList as $response) {
                return $response;
            }
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            return $this->error;
        }
    }
    public function error()
    {
        return $this->error;
    }
}
