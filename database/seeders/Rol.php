<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Rol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'nombre' => 'Administrador',
                'acronimo' => 'ADM'
            ],
            [
                'nombre' => 'Operador',
                'acronimo' => 'OPE'
            ],
            [
                'nombre' => 'Super Admin',
                'acronimo' => 'SADM'
            ]
        ];

        \DB::table('roles')->insert($items);
    }
}
