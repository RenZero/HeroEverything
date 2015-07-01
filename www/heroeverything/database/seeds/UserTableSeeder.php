<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('User')->delete();

        $users = array(
            array(
                'email' => 'hero@heroeverything.com',
                'nickname' => 'Hero',
                'passwd' => Hash::make('hero'),
                'desc' => 'We are heroes.',
                'orgname' => 'Funnest',
                'bar_list' => '1,2',
                'ip' => '127.0.0.1',
                'deleted_at' => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        DB::table('User')->insert($users);
    }

}

