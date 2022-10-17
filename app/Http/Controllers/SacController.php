<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SacController extends Controller
{
    public function search(Request $request){

        
        $sac = DB::connection('sac')->select('SELECT ip, label, server_sac_id FROM psm_servers WHERE server_sac_id = "'.$request->entity.'"');
        
       echo json_encode($sac);
    }
}
