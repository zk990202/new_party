<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('twt_admin')->insert([
            'username'  =>  'root',
            'real_name' =>  '超级管理员',
            'password'  =>  bcrypt('admin'),
            'type'      =>  1,
        ]);
    }
}
