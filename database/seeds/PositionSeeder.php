<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'name' => 'Trainer',
                'is_fulltime' => 1
            ],
            [
                'name' => 'Open',
                'is_fulltime' => 0
            ],
            [
                'name' => 'Intern',
                'is_fulltime' => 0
            ]
        ];
        DB::table('positions')->insert($positions);

    }
}
