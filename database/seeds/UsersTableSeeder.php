<?php

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
    	\App\User::create([
    		'name' => 'user',
    		'email' => 'user@suggester.com',
    		'password' => '$2y$10$lKSJXrbljziWWHS1iRAy0eDT7TUwZ.AVGgFykiE7ms0Jg1IndmvwG',
    		'remember_token' => null
    	]);
    }
}
