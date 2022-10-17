<?php

namespace App\Http\Controllers;

class ConvertArraysController
{
    private $array;
    private $str;

    public function convert(string $array)
    {
        $this->array = $array;

        $array01 = explode(",", $this->array);
        $array02 = array_map(function($v){ return "'".$v."'"; }, $array01);
        $result = implode(", ", $array02);
        $this->str = $result;

        return $this->str;
    }
}
