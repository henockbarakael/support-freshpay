<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = [
            [
               'firstname'=>'Henock',
               'lastname'=>'BARAKAEL',
               'email'=>'barahenock@gmail.com',
               'is_user'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
                'firstname'=>'Catherine',
                'lastname'=>'BOPE',
                'email'=>'cathy@support.com',
                'is_user'=>1,
                'password'=> bcrypt('123456'),
             ],
             [
                'firstname'=>'Alliance',
                'lastname'=>'TSHINDAYI ',
                'email'=>'alliance@support.com',
                'is_user'=>1,
                'password'=> bcrypt('123456'),
             ],
             [
                'firstname'=>'Ghislain',
                'lastname'=>'AMURI',
                'email'=>'amuri@support.com',
                'is_user'=>1,
                'password'=> bcrypt('123456'),
             ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
