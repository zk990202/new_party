<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(RoleTableSeeder::class);
//        $this->call(RouteGroupsTableSeeder::class);
//        $this->call(RoutesTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
    }
}
