<?php

namespace App\Http\Controllers;

use Request;
use Hash;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Bar;
use App\Model\User;

class BloodApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function get()
    {
        $input = Request::all();

        if (!isset($input['barid'])) {
            return response('請輸入barid', '400');
        }
        $barid = Request::input("barid");
        $bar = Bar::find($barid);
        $bar->status = "success";
        return response()->json($bar);
    }

    public function newbyaccount(Bar $bar, User $User)
    {
        $input = Request::all();

        if (!isset($input['email'])) {
            return response('請輸入帳號', '403');
        } elseif (!isset($input['passwd'])) {
            return response('請輸入密碼', '403');
        } elseif (!isset($input['name'])) {
            return response('請輸入名稱', '400');
        } elseif (!isset($input['title'])) {
            return response('請輸入標題', '400');
        } elseif (!isset($input['type'])) {
            return response('請輸入類型', '400');
        } elseif (!isset($input['unit'])) {
            return response('請輸入單位', '400');
        } elseif (!isset($input['vol_max'])) {
            return response('請輸入血量最大值', '400');
        } elseif (!isset($input['vol_current'])) {
            return response('請輸入目前血量', '400');
        } elseif (!isset($input['cron'])) {
            return response('請輸入排程', '400');
        }

        if ($User->CheckMember($input['email'], $input['passwd'])) {
            $BarData['userid'] = $User->GetUserId($input['email']);
            $BarData['name'] = $input['name'];
            $BarData['title'] = $input['title'];
            $BarData['type'] = $input['type'];
            $BarData['unit'] = $input['unit'];
            $BarData['vol_max'] = $input['vol_max'];
            $BarData['vol_current'] = $input['vol_current'];
            $BarData['cron'] = $input['cron'];
            $id = $bar->AddBar($BarData);
            return response()->json(["status" => "success", "barid" => $id]);
        } else {
            return response('帳號驗證錯誤', '403');
        }
    }

    public function getlist(User $User,Bar $bar)
    {
        if (!isset($input['email'])) {
            return response('請輸入帳號', '403');
        } elseif (!isset($input['passwd'])) {
            return response('請輸入密碼', '403');
        }

        if($User->CheckMember($input['email'], $input['passwd'])){
            $baridlist = $bar->GetList($User->GetUserId);
            $baridlist->status = "success";
            return response()->json($baridlist);
        }
    }

    public function del(){
        
    }
}
