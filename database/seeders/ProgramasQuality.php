<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramasQuality extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'Monitor,Sac Interno,Sac Externo,Frotas Interno,Recepção'
        ];

        foreach ($array as $data) {
            DB::table('programasQuality')->insert([
                'programasQuality' => $data,
            ]);
        }
    }
}
