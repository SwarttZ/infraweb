<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormatBytesController extends Controller
{
    function formatBytes($size, $precision = 2)
    {
        if($size == 0){
            return 0;
        }
        $base = log($size, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}
