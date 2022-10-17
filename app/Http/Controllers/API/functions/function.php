<?php


use Illuminate\Support\Facades\DB;

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
        'ip_servidor' => $ip,
        'status' => $status,
        'servidor' => $servidor,
        'ping_time' => $ping_time,
        'comando_refresh' => $comando_refresh
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
function insereStatusServicos($ip, $host, $porta, $status, $erro_codigo, $servidor)
{

    $query = DB::table('status_servico')->insert([
        'ip' => $ip,
        'host' => $host,
        'porta' => $porta,
        'status' => $status,
        'erro_codigo' => $erro_codigo,
        'servidor' => $servidor
    ]);

    return $query;
}
