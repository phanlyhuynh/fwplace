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

        $faker = \Faker\Factory::create();
        foreach (range(1, 50) as $value) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('framgia'),
                'program_id' => DB::table('programs')->get()->random()->id,
                'position_id' => DB::table('positions')->get()->random()->id,
                'workspace_id' => DB::table('workspaces')->get()->random()->id,
                'lang' => 1,
                'status' => 1
            ]);
        }
    }
}
