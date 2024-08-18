<?php

namespace Database\Seeders;

use App\Models\Ongkir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ongkirs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ongkirr=[
            [
                'daerah' => 'Makassar',
                'ongkos' => 10000,
            ],
            [
                'daerah' => 'Gowa',
                'ongkos' => 15000,
            ],
            [
                'daerah' => 'Bulukumba',
                'ongkos' => 20000,
            ],
            [
                'daerah' => 'Lainnya',
                'ongkos' => 30000,
            ],
        ];
        foreach ($ongkirr as $key => $value){
                Ongkir::create($value);
            }
    }
}
