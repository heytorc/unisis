<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Heytor Cavalcanti',
            'email'     => 'heytor01@live.com',
            'password'  => bcrypt('admin')
        ]);
    }
}
