<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'name' => 'PHP'
            ],
            [
                'name' => 'Android'
            ],
            [
                'name' => 'IOS'
            ],
            [
                'name' => 'Ruby'
            ],
            [
                'name' => 'QA'
            ],
        ];
        DB::table('programs')->insert($programs);
    }
}
