<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'login' =>  'admin',
            'hash'  =>  Hash::make('password'),

            'fio'   =>  'Барыкин Илья Игоревич',
            'phone' =>  '+7 (917) 00-00-000'
        ]);

        User::create([
            'login' =>  'th1_admin',
            'hash'  =>  Hash::make('password'),

            'fio'   =>  'THEATRE 1 ADMIN FIO',
            'phone' =>  'THEATRE 1 ADMIN PHONE'
        ]);

        User::create([
            'login' =>  'th1_user1',
            'hash'  =>  Hash::make('password'),

            'fio'   =>  'THEATRE 1 USER 1 FIO',
            'phone' =>  'THEATRE 1 USER 1 PHONE'
        ]);

        User::create([
            'login' =>  'th1_user2',
            'hash'  =>  Hash::make('password'),

            'fio'   =>  'THEATRE 1 USER 2 FIO',
            'phone' =>  'THEATRE 1 USER 2 PHONE'
        ]);
    }
}
