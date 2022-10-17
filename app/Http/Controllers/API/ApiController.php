<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

require __DIR__ . "/functions/function.php";

use Illuminate\Http\Request;


class ApiController extends Controller
{

    public function show()
    {
        limpaCommandStatus();
        limpaCommand();
        $servidores = DB::table('servidores_eveo')->get();

        foreach ($servidores as $value) {
            $cmd = array("ping -c 1 '" . $value->eveo_ip_externo . "' | head -n 2 | tail -n 2 | awk '{print $7}'");
            $process = new Process($cmd);

            $cmd = $process->run();

            $filter01 = explode("=", $cmd);

            $cmd = $process->getOutput();

            if ($filter01[0] > 0.00 && !empty($filter01[0])) {
                $status = '1';
                $refresh = '0';
                insertStatusCommand($value->eveo_ip_externo, $status, $value->eveo_ip_externo, $cmd, $refresh);
            } else {
                $status = '0';
                $refresh = '0';
                insertStatusCommand($value->eveo_ip_externo, $status, $value->eveo_ip_externo, '0.00', $refresh);
            }
        }

        $servidores = DB::table('hosts_quality')->get();

        foreach ($servidores as $url) {
            $url_absoluta = array($url->url_absoluta);

            $ch = curl_init($url_absoluta[0]);
            curl_setopt($ch, CURLOPT_URL, $url_absoluta[0]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $responseBody = curl_exec($ch);

            if ($responseBody === false) {
                $responseCode = "Erro com certificado ou servidor desligado";
                $status = '0';
                insereStatusServicos($url->ip, $url->url_absoluta, $url->porta, $status, $responseCode, $url->servidor);
            } else {

                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $status = '1';
                insereStatusServicos($url->ip, $url->url_absoluta, $url->porta, $status, $responseCode, $url->servidor);
            }
        }
    }
}
