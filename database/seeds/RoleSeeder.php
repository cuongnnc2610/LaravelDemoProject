<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Roles')->insert([
        	['name' => 'user'],
        	['name' => 'admin1'],
        	['name' => 'admin2'],
            ['name' => 'admin3'],
    	]);
    }
}
