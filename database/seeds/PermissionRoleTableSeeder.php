<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->insert([
            ['idRole' => '2','idPermission' => '1'],
            ['idRole' => '2','idPermission' => '2'],
            ['idRole' => '2','idPermission' => '3'],
            ['idRole' => '2','idPermission' => '4'],
            ['idRole' => '3','idPermission' => '4'],
        ]);
        
    }
}
