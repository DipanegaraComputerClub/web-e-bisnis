<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class Produks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $produk=[
            [
                'nama' => 'kemeja',
                'foto' => 'kemeja.jpeg',
                'harga' => 35000,
                'keterangan' => 'loremaaaa',
            ],
            [
                'nama' => 'Kaos',
                'foto' => 'kemeja.jpeg',
                'harga' => 25000,
                'keterangan' => 'loremaaaa',
            ],
        ];

        foreach ($produk as $key => $value){
                Produk::create($value);
            }
    }
}
