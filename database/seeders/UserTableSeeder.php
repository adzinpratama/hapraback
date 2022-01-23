<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            // [
            //     'id' => Uuid::uuid6()->getHex(),
            //     'name' => 'Hilmi Hapra',
            //     'nickname' => 'Hapra',
            //     'email' => 'hilmiadzin@hapra.my.id',
            //     'password' => bcrypt('admin'),
            //     'role_id' => 1
            // ],
            [
                'id' => Uuid::uuid6()->getHex(),
                'name' => 'Yammy Sama',
                'nickname' => 'Yammy',
                'email' => 'yammysama@gmail.com',
                'password' => bcrypt('admin'),
                'role_id' => 2
            ]
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
