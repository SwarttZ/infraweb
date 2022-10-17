<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\SendSMS;
use App\Http\Controllers\Sms;

class SendEmailStatus extends Controller
{
    function sendMessage($chatID, $messaggio, $token)
    {
        echo "Enviando alerta para" . $chatID . "\n";

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($messaggio);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function status()
    {

        $servidores = DB::select('SELECT * FROM status INNER JOIN status_servico ON status.ip_servidor = status_servico.ip ORDER BY status.ip_servidor DESC');


        foreach ($servidores as $dados) {

            if ($dados->erro_codigo != 200) {

                /*
         * Msg do email
         */

        //         $msg = "Alerta servidor com problemas<b> '" . $dados->servidor . "' !!!</b><br />  Inicio do problema: " . date('Y/m/d H:i') . "<br />
        // ENDEREÇO/IP: '" . $dados->ip_servidor . "'<br />
        // URL: '" . $dados->host . "'<br />
        // HTTP/CODE: '" . $dados->erro_codigo . "'<br />
        // AUTO RESTART: NULL<br />

        // - Não responder esse Email -
        // ";


                /*
        /*  Enviar email
        */

                /*
        /* Mensagem Telegram e SMS
        */
                $msg = "Alerta servidor com problemas: '" . $dados->servidor . "' !!! Inicio do problema: " . date('Y/m/d H:i') . "
        ENDEREÇO/IP: '" . $dados->ip_servidor . "'
        URL: '" . $dados->host . "'
        HTTP/CODE: '" . $dados->erro_codigo  . "'
          AUTO RESTART: NULL
        ";
                DB::table('table_alerts')->insert(array($msg));
                $token = "1483743960:AAHTZKBXngXCjyKxULZZQMbLfhwpQkxaiHc";
                $chatid = "-292551218";
                SendEmailStatus::sendMessage($chatid, $msg, $token);


                /*
        /*  Enviar SMS
        */

        //         $sms = new SendSMS();
        //         $msg_sms = "Alerta servidor com problemas: '" . $dados['servidor'] . "' !!! Inicio do problema: " . date('Y/m/d H:i') . "
        // ";
        //         $arrayNumber = [
        //             'leandro' => '5567984485003',
        //             'patricia' => '5567999443731',
        //             'tamir' => '556798162-2700',
        //             'ricardo' => '5567999415819'
        //         ];
        //         foreach ($arrayNumber as $data) {

        //             $sms->msgSend($data, $msg_sms);
        //             if ($sms->error()) {
        //                 var_dump($sms->error());
        //             }
        //         }
            }
        }
    }
}
