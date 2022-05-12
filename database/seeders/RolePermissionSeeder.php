<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super_admin',
            'admin',
        ];

        foreach($roles as $role)
        {
            Role::create([
                'name'  =>  $role
            ]);
        }

        $permissions = [
            'add_article',
            'edit_article',
            'delete_article',
            'add_category',
            'edit_category',
            'delete_category',
        ];

        foreach($permissions as $permission)
        {
            $assing_permission = Permission::create([
                'name'  =>  $permission
            ]);

            $assing_permission->assignRole('super_admin');

            if(!in_array($permission, ['delete_article','delete_category']))
            {
                $assing_permission->assignRole('admin');
            }

        }

    }
}
