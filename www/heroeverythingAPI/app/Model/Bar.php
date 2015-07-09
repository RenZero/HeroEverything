<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bar extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'Bar';
    protected $primaryKey = 'barid';
    //protected $timestamps = 'false';

    function getall()
    {
        $all = Bar::all();
        return $all;
    }

    public function AddBar($input){
        $addbar = new Bar();
        foreach($input as $index => $value){
            $addbar->$index = $value;
        }
        $addbar->save();
        return $addbar->barid;
    }

    public function GetList($userid){
        return User::where('userid','=',$userid)->pluck('barid');
    }
}
