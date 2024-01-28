<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class CreateUserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            "name"=>"icwr",
            "email"=>"icwr@icwr.com",
            "password"=>Hash::make("icwr"),
            "role"=>"admin",
            "accept"=>"yes"
        ]);
    }
}
