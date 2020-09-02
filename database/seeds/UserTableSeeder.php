<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Administrator",
            "email" => "admin@gmail.com",
            "password" => Hash::make("password"),
            "dept_id" => 1,
            "office_id" => 1,
            "user_role_id" => null,
            "Categories_id"=> 1,
            "type"=>"System Admin"
        ]);
    }
}
