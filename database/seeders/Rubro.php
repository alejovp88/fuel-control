<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Rubro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['nombre' => 'Particulares'],
            ['nombre' => 'Productores'],
            ['nombre' => 'Comercios'],
            ['nombre' => 'Motos'],
            ['nombre' => 'Alcaldia'],
            ['nombre' => 'Salud'],
            ['nombre' => 'Transporte'],
            ['nombre' => 'Perimetro'],
            ['nombre' => 'SinBom']
        ];

        \DB::table('rubros')->insert($items);
    }
}
