<?php

use Illuminate\Database\Seeder;

class BarTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Bar')->delete();

        $bars = array(
            array(
                'userid' => '1',
                'unit' => '元',
                'type' => 'hero',
                'name' => '生活費',
                'title' => 'title',
                'vol_max' => '10000',
                'vol_current' => '10000',
                'cron' => 'buf1=3600:-1',
                'api_key' => null,
                'privacy' => null,
                'alertdefine' => null,
                'eventqueue' => null,
                'lastupdate' => new DateTime,
                'deleted_at' => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'userid' => '1',
                'unit' => '日',
                'type' => 'hero',
                'name' => '專案倒數',
                'title' => 'title',
                'vol_max' => '60',
                'vol_current' => '60',
                'cron' => 'buf1=86400:-1',
                'api_key' => null,
                'privacy' => null,
                'alertdefine' => null,
                'eventqueue' => null,
                'lastupdate' => new DateTime,
                'deleted_at' => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        DB::table('Bar')->insert($bars);
    }

}

