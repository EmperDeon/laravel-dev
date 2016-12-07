<?php

use App\User;
use App\Interfaces\TS;
use App\WebUser;
use Illuminate\Support\Facades\Hash;

class WebUserSeeder extends TS
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebUser::create([
            'login' =>  'admin',
            'password'  =>  Hash::make('password'),

            'fio'   =>  'Барыкин Илья Игоревич',
            'phone' =>  '+7 (917) 00-00-000',
        ]);

        WebUser::create([
            'login' =>  'user1',
            'password'  =>  Hash::make('password'),

            'fio'   =>  'THEATRE 1 ADMIN FIO',
            'phone' =>  'THEATRE 1 ADMIN PHONE',
        ]);

        WebUser::create([
            'login' =>  'user2',
            'password'  =>  Hash::make('password'),

            'fio'   =>  'THEATRE 1 USER 1 FIO',
            'phone' =>  'THEATRE 1 USER 1 PHONE',
        ]);

        WebUser::create([
            'login' =>  'user3',
            'password'  =>  Hash::make('password'),

            'fio'   =>  'THEATRE 1 USER 2 FIO',
            'phone' =>  'THEATRE 1 USER 2 PHONE',
        ]);
    }
}
