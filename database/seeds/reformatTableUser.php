<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class reformatTableUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("truncate table users");

        DB::table('users')->insert([
			'name' => 'Admin',
            'email' => 'admin@soft-gain.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
		]);
    }
}
