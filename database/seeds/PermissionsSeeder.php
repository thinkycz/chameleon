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

        $administratorRole->grant('viewNova');
    }
}
