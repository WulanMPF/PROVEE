<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_user' => '1',
                'nama' => 'Wulan',
                'nik' => '123',
                'password' => Hash::make('123'), // Hashing password sebelum disimpan
                'tele_id' => '123',
            ],
            [
                'id_user' => '2',
                'nama' => 'Milla',
                'nik' => '111',
                'password' => Hash::make('111'), // Hashing password sebelum disimpan
                'tele_id' => '111',
            ],
        ];
        DB::table('user')->insert($data);
    }
}
