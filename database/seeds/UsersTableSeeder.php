<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = 'admin';
        $user->firstname = "admin";
        $user->email = "thomas.regnier3001@gmail.com";
        $user->password = Hash::make("admin");
        $user->isAdmin = 1;

        $user->save();
    }
}
