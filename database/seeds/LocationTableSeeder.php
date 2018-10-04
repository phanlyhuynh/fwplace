<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workspaces = DB::table('workspaces')->get();
        if ($workspaces && count($workspaces) > 0) {
            $faker = \Faker\Factory::create();
            foreach (range(1, 10) as $value) {
                DB::table('locations')->insert([
                    'name' => $faker->state,
                    'total_seat' => rand(5, 20),
                    'workspace_id' => $workspaces->random()->id
                ]);
            }
        }
    }
}
