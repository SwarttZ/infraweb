<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiFunctions extends Controller
{
    function limpaCommandStatus()
{
    DB::table('status_servico')->truncate();
    return true;
}
function limpaCommand()
{
    DB::table('status')->truncate();
    return true;
}
function consultaBancosServidores($table)
{
    $item = DB::table($table)->get();
    foreach ($item as $data) {
        return $data;
    }
}
function insertStatusCommand($ip, $status, $servidor, $ping_time, $comando_refresh)
{

    $query = DB::table('status')->insert([
        'ip' => $ip,
        'status' => $status,
        'servidor' => $servidor,
        'ping_time' => $ping_time,
        'command_refresh' => $comando_refresh
    ]);

    return $query;
}
function curlPegaErroHttp($table)
{
    $item = DB::table($table)->get();
    foreach ($item as $data) {
        return $data;
    }
}
function insereStatusServicos($ip, $host, $porta, $status, $codigo_erro, $servidor)
{

    $query = DB::table('status_servicos')->insert([
        'ip' => $ip,
        'host' => $host,
        'porta' => $porta,
        'status' => $status,
        'codigo_erro' => $codigo_erro,
        'servidor' => $servidor
    ]);

    return $query;
}

}
