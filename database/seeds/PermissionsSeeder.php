<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administratorRole = Silvanite\Brandenburg\Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        $administratorPermission = Silvanite\Brandenburg\Permission::create([
            'role_id'         => $administratorRole->id,
            'permission_slug' => 'access-administration',
        ]);

        $administratorRole->grant($administratorPermission->permission_slug);
    }
}
