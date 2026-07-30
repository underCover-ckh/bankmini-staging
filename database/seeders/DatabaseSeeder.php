<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   
     public function run()
     {
         if (!User::where('username', 'admin')->exists()) {
             User::create([
                 'name' => 'Admin',
                 'username' => 'admin',
                 'password' => Hash::make('admin123'),
                 'role' => 'admin',
                 'nis' => null,
                 'saldo' => null,
                 'jurusan' => null,
                 'kelas' => 'Admin Class',
             ]);
         }
     
         if (!User::where('username', 'teller')->exists()) {
             User::create([
                 'name' => 'Teller',
                 'username' => 'teller',
                 'password' => Hash::make('teller123'),
                 'role' => 'teller',
                 'nis' => null,
                 'saldo' => null,
                 'jurusan' => null,
                 'kelas' => 'Teller Class',
             ]);
         }
     
         if (!User::where('username', 'user')->exists()) {
             User::create([
                 'name' => 'User',
                 'username' => 'user',
                 'password' => Hash::make('user123'),
                 'role' => 'user',
                 'nis' => '123456789',
                 'saldo' => '0',
                 'jurusan' => 'PPLLG',
                 'kelas' => 'User Class',
             ]);
         }
     }
     
}
