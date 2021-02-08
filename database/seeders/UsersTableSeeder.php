<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role_id' =>  1,
                'remember_token' => null,
            ],
            [
                'id' => 2,
                'name' => 'Jane Doe',
                'email' => 'janedoe@user.com',
                'password' => bcrypt('password'),
                'role_id' => 0,
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
