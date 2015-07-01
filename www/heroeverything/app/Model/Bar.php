<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
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
