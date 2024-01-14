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
        \App\User::create([
            "name"=>"bilhaq syahbani sahatmojo",
            "email"=>"bilhaqss@gmail.com",
            "password"=>Hash::make("bilhaqss"),
            "role"=>"user",
            "accept"=>"yes"
        ]);
    }
}
