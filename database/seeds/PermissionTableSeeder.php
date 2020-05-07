<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Permissions')->insert([
			['name' => 'theloai.create'],
			['name' => 'theloai.edit'],
            ['name' => 'theloai.delete'],
			['name' => 'theloai.view'],
		]);
    }
}
