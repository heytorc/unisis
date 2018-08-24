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
            'username'  => 'heytor.cavalcanti',
            'email'     => 'heytor01@live.com',
            'password'  => bcrypt('admin')
        ]);

        User::create([
            'name'      => 'Outro Usuário',
            'username'  => 'heytor.moura',
            'email'     => 'heytor02@live.com',
            'password'  => bcrypt('admin')
        ]);
    }
}
