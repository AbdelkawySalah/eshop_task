<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cat;
class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cats')->delete();
        $categories=[
            ['name'=>'programming','slug'=>'asfsf','description'=>'sfssf fssfksf sfssfkfssf sff','status'=>1,'image'=>'aaaaa.jpg'],
            ['name'=>'Medical','slug'=>'Med','description'=>'Mdicasa addadda adadadad','status'=>1,'image'=>'aaaaa.jpg'],
        ];
        foreach($categories as $category)
        {
            Cat::create($category);
        }

    }
}
