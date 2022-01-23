<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'superadmin',
                'redirect_to' => '/admin',
            ],
            [
                'name' => 'author',
                'redirect_to' => '/author',
            ],
            [
                'name' => 'user',
                'redirect_to' => '/',
            ],

        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
