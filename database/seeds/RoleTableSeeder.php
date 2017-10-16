<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'          =>  'admin',
            'display_name'  =>  '超级管理员',
            'description'   =>  '党建后台超级管理员，仅指导老师可以拥有'
        ]);
        //
        DB::table('roles')->insert([
            'name'          => 'academy',
            'display_name'  => '院级管理员',
            'description'   => '各学院管理账号，可以针对本学院内的内容进行管理'
        ]);
    }
}
