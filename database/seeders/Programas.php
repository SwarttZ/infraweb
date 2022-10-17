<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Programas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $array = [
            'Pacote Office 365,Pacote Office 2016,Pacote Office 2010,Delphi Tokyo 10.2,PHP Storm,Spark,TeamViewer,Microsoft Visio,Power BI,AnyDesk,Microsoft Project,Git,TortoiseGit,Smart Git,FileZilla FTP,Postman,WireShark,FlameShot,Mr. agenda', '2022-07-15 13:35:27', '2022-07-15 13:35:27'
        ];
        foreach ($array as $data) {
            DB::table('programas')->insert([
                'programasInstalados' => $data,
            ]);
        }
    }
}
