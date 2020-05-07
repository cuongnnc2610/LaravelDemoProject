<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
        	['idUser' => '1','idRole' => '1'],
        	['idUser' => '2','idRole' => '2'],
        	['idUser' => '3','idRole' => '3'],
            ['idUser' => '4','idRole' => '4'],
    	]);
    }
}
