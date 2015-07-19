<?php

namespace App\Http\Controllers;

use Request;
use Hash;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Bar;
use App\Model\User;

/**
 * Class BloodApiController the all bar api
 * @package App\Http\Controllers
 */
class BloodApiController extends Controller
{
    protected $Bar,$User;

    public function __construct(Bar $Bar,User $User){
        $this->Bar = $Bar;
        $this->User = $User;
    }

    public function get()
    {
        $barid = Request::input('barid', '');

        if (empty($barid)) {
            return response('請輸入barid', '400');
        }
        $bar = $this->Bar->get($barid);
        $bar->status = "success";
        return response()->json($bar);
    }

    public function newbyaccount()
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

        if ($this->User->CheckMember($input['email'], $input['passwd'])) {
            $BarData['userid'] = $this->User->GetUserId($input['email']);
            $BarData['name'] = $input['name'];
            $BarData['title'] = $input['title'];
            $BarData['type'] = $input['type'];
            $BarData['unit'] = $input['unit'];
            $BarData['vol_max'] = $input['vol_max'];
            $BarData['vol_current'] = $input['vol_current'];
            $BarData['cron'] = $input['cron'];
            $id = $this->Bar->AddBar($BarData);
            return response()->json(["status" => "success", "barid" => $id]);
        } else {
            return response('帳號驗證錯誤', '403');
        }
    }

    public function getlist()
    {
        $input = Request::all();

        if (!isset($input['email'])) {
            return response('請輸入帳號', '403');
        } elseif (!isset($input['passwd'])) {
            return response('請輸入密碼', '403');
        }

        if ($this->User->CheckMember($input['email'], $input['passwd'])) {
            $baridlist = $this->User->GetBarList($input['email']);
            return response()->json(["status" => "success", "barid" => $baridlist]);
        } else {
            return response('帳號驗證錯誤', '403');
        }
    }

    public function del()
    {
        $input = Request::all();

        if (!isset($input['barid'])) {
            return response('請輸入barid', '400');
        }
        $barid = Request::input("barid");
        $affectedRows = $this->Bar->delBar($barid);
        if ($affectedRows > 0) {
            return response()->json(["status" => "success"]);
        } else {
            return response('刪除失敗', '403');
        }
    }
}
