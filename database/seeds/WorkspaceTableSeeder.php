<?php

use Illuminate\Database\Seeder;

class WorkspaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workspaces = [
            [
                'name' => 'Handico',
                'image' => '1.jpg'
            ],
            [
                'name' => 'KeangNam',
                'image' => '2.jpg'
            ],
            [
                'name' => 'Lab',
                'image' => '3.jpg'
            ],
        ];

        DB::table('workspaces')->insert($workspaces);
    }
}
