<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('123123'),
            ]
        ];

        foreach ($data as $d) {
            User::create($d);
            echo "User " . $d['name'] . " adicionado! \n";
        }
    }
}
