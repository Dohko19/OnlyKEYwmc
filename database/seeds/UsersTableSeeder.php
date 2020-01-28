<?php

use App\User;
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
        $user = new User;
        $user->name = "Daniel";
        $user->email = "admin@email.com";
        $user->password = "123123";
        $user->save();
     }
}
