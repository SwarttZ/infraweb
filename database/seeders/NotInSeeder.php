<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            0, 79, 304, 181, 187, 273, 354, 173, 34, 336, 296, 184, 221, 272, 222, 282, 170, 176, 150, 178, 155, 328, 172, 185, 270, 33, 340, 288, 177, 113, 91
        ];

        foreach ($array as $data) {
            DB::table('entity_not_in')->insert([
                'notIn' => $data,
            ]);
        }
    }
}
