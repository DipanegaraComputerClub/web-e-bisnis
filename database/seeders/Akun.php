<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user=[
            [
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'level' => 'admin',
                'password' => Hash::make('123456')
            ],
            [
                'username' => 'user',
                'name' => 'user',
                'email' => 'user@gmail.com',
                'level' => 'user',
                'password' => Hash::make('123456')
            ]
            ];

            foreach ($user as $key => $value){
                User::create($value);
            }
    }
}
