<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'ศุภกานต์ เกตุแก้ว',
            'email' => 'narkapus@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('08012534'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'ทดสอบ ทั่วไป',
            'email' => 'narkapus7@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('08012534'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => '0',
        ]);
    }
}
