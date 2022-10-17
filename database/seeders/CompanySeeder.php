<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'image' => 'white-logo.png',
            'address' => 'R. 13 de Junho, 59 - Centro, Campo Grande - MS, 79002-420',
            'shortName' => 'Quality Sistemas',
            'fullName' => 'Quality Sistemas LTDA',
            'email' => 'leandromoraes@qualitysistemas.com.br',
            'phone1' => '(67) 98448-5003',
            'phone2' => '(67) 98448-5003',
            'mayor' => 'Leandro M. Lino',
            'cnpjCpf' => '000.000.000-00',
            'ieRG' => '00000-0 SSP/MS',
            'im' => 'null',
            'city' => '5120',
            'state' => '12',
            'active' => '1'
        ]);
    }
}
