<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'=>1,
            'name'=>'Akash Mallik',
            'username'=>'admin',
            'email'=>'toakashmallik@gmail.com',
            'password'=>bcrypt('admin@123'),
            'about'=>'About Adimn',
        ]);
        DB::table('users')->insert([
            'role_id'=>2,
            'name'=>'Mr. Author',
            'username'=>'author',
            'email'=>'hey.knock.me@gmail.com',
            'password'=>bcrypt('author@123'),
            'about'=>'About Author',
        ]);
    }
}