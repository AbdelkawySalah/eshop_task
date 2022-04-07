<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'username'=>'admin',
            'email'=>'admin@yahoo.com',
            'password'=>bcrypt('11111111'),
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }
}
