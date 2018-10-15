<?php

use App\Models\Permission;
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
        $permission = [
            [
                'name' => 'role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'position-list',
                'display_name' => 'Display position Listing',
                'description' => 'See only Listing Of position'
            ],
            [
                'name' => 'position-create',
                'display_name' => 'Create position',
                'description' => 'Create New position'
            ],
            [
                'name' => 'position-edit',
                'display_name' => 'Edit position',
                'description' => 'Edit position'
            ],
            [
                'name' => 'position-delete',
                'display_name' => 'Delete position',
                'description' => 'Delete position'
            ]
            ,
            [
                'name' => 'workspace-list',
                'display_name' => 'Display workspace Listing',
                'description' => 'See only Listing Of workspace'
            ],
            [
                'name' => 'workspace-create',
                'display_name' => 'Create workspace',
                'description' => 'Create New workspace'
            ],
            [
                'name' => 'workspace-edit',
                'display_name' => 'Edit workspace',
                'description' => 'Edit workspace'
            ],
            [
                'name' => 'workspace-delete',
                'display_name' => 'Delete workspace',
                'description' => 'Delete workspace'
            ]
        ];


        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
