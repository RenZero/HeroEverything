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

    public function getall()
    {
        return Bar::all();
    }

    public function get($barid)
    {
        return Bar::find($barid);
    }

    public function AddBar($input)
    {
        $addbar = new Bar();
        foreach($input as $index => $value){
            $addbar->$index = $value;
        }
        $addbar->save();
        return $addbar->barid;
    }

    public function delBar($barid)
    {
        $bar = Bar::find($barid);
        if (is_null($bar)) {
            $affectedRows = 0;
        } else {
            $affectedRows = $bar->delete();
        } 
        return $affectedRows;
    }
}
