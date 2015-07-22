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
                'exrate' => '1',
                'type' => 'hero',
                'name' => '生活費',
                'title' => 'title',
                'vol_max' => '10000',
                'vol_current' => '10000',
                'cashflow' => '0',
                'read_privacy' => 'public',
                'write_privacy' => 'public',
                'cron' => 'buf1=3600:-1',
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
                'exrate' => '1',
                'type' => 'hero',
                'name' => '專案倒數',
                'title' => 'title',
                'vol_max' => '60',
                'vol_current' => '60',
                'cashflow' => '0',
                'read_privacy' => 'public',
                'write_privacy' => 'public',
                'cron' => 'buf1=86400:-1',
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

