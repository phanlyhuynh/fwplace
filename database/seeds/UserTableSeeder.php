<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@framgia.com',
            'password' => bcrypt('framgia'),
            'program_id' => 1,
            'position_id' => 1,
            'workspace_id' => 1,
            'lang' => 1,
            'status' => 1
        ]);
    }
}
