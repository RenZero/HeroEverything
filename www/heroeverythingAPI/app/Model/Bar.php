<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Bar to controller all bar's action
 * @package App\Model
 */
class Bar extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'Bar';
    protected $primaryKey = 'barid';

    /*public function getall()
    {
        return Bar::all();
    }*/

    public function getBar($barid)
    {
        return Bar::findorfail($barid);
    }

    public function addBar($input)
    {
        $addbar = new Bar();
        foreach($input as $index => $value)
            $addbar->$index = $value;
        $addbar->save();
        return $addbar->barid;
    }

    public function editBar($input)
    {
        $bar = Bar::findorfail($input['barid']);
        foreach($input as $index => $value)
            $bar->$index = $value;
        $bar->save();
        return true;
    }

    public function getBarList($userid)
    {
        return Bar::where('userid', '=', $userid)->lists('barid');
    }

    public function delBar($barid)
    {
        return Bar::findorfail($barid)->delete();
    }

    public function writeBar($barid, $action, $vol = '')
    {
        $bar = Bar::findOrFail($barid);
        $vol_max = $bar->vol_max;
        $vol_current = $bar->vol_current;

        switch ($action) {
            case 'inc':
                $bar->vol_current = $vol_current + $vol;
                break;
            case 'dec':
                $vol_tmp = $vol_current - $vol;
                if ($vol_tmp < 0)
                    $vol_tmp = 0;
                $bar->vol_current = $vol_tmp;
                break;
            case 'set':
                $bar->vol_current = $vol;
                break;
            case 'full':
                $bar->vol_current = $vol_max;
                break;
            case 'kill':
                $bar->vol_current = 0;
                break;
        }
        $bar->save();

        $bar_vol['vol_current'] = $bar->vol_current;
        $bar_vol['vol_max'] = $bar->vol_max;
        return $bar_vol;
    }

    public function cronBar($barid, $action, $new_cron)
    {
        $bar = Bar::findOrFail($barid);
        $cron = $bar->cron;

        switch ($action) {
            case 'add':
                if (empty($cron))
                    $bar->cron = $new_cron;
                else
                    $bar->cron = $cron.','.$new_cron;
                break;
            case 'del':
                $bar->cron = null;
                break;
            case 'replace':
                $bar->cron = $new_cron;
                break;
        }
        $bar->save();
        return true;
    }

    public function eventBar($barid, $action, $new_cron)
    {
        $bar = Bar::findOrFail($barid);
        $cron = $bar->eventqueue;

        switch ($action) {
            case 'add':
                if (empty($cron))
                    $bar->eventqueue = $new_cron;
                else
                    $bar->eventqueue = $cron.','.$new_cron;
                break;
            case 'del':
                $bar->eventqueue = null;
                break;
            case 'replace':
                $bar->eventqueue = $new_cron;
                break;
        }
        $bar->save();
        return true;
    }

    public function alertBar($barid, $action, $new_cron)
    {
        $bar = Bar::findOrFail($barid);
        $cron = $bar->alertdefine;

        switch ($action) {
            case 'add':
                if (empty($cron))
                    $bar->alertdefine = $new_cron;
                else
                    $bar->alertdefine = $cron.','.$new_cron;
                break;
            case 'del':
                $bar->alertdefine = null;
                break;
            case 'replace':
                $bar->alertdefine = $new_cron;
                break;
        }
        $bar->save();
        return true;
    }
}
