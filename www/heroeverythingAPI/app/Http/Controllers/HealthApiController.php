<?php

namespace App\Http\Controllers;

use Request;
use Hash;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Bar;
use App\Model\User;
use Exception;

/**
 * Class BloodApiController the all bar api
 * @package App\Http\Controllers
 */
class HealthApiController extends Controller
{
    protected $Bar, $User;

    public function __construct(Bar $Bar, User $User)
    {
        $this->Bar = $Bar;
        $this->User = $User;
    }

    public function newBar()
    {
        $email = Request::input('email', '');
        if (empty($email))
            return response()->json(["status" => "error", "reason" => "未輸入帳號"]);
        $passwd = Request::input('passwd', '');
        if (empty($passwd))
            return response()->json(["status" => "error", "reason" => "未輸入密碼"]);
        $exrate = Request::input('exrate', '');
        if (empty($exrate))
            return response()->json(["status" => "error", "reason" => "未輸入單位匯率"]);
        $name = Request::input('name', '');
        if (empty($name))
            return response()->json(["status" => "error", "reason" => "未輸入名稱"]);
        $title = Request::input('title', '');
        if (empty($title))
            return response()->json(["status" => "error", "reason" => "未輸入標題"]);
        $type = Request::input('type', '');
        if (empty($type))
            return response()->json(["status" => "error", "reason" => "未輸入類型"]);
        $unit = Request::input('unit', '');
        if (empty($unit))
            return response()->json(["status" => "error", "reason" => "未輸入單位"]);
        $vol_max = Request::input('vol_max', '');
        if (empty($vol_max))
            return response()->json(["status" => "error", "reason" => "未輸入最大值"]);
        $vol_current = Request::input('vol_current', '');
        if (empty($vol_current))
            return response()->json(["status" => "error", "reason" => "未輸入目前值"]);
        $cashflow = Request::input('cashflow', '');
        if (empty($cashflow))
            return response()->json(["status" => "error", "reason" => "未輸入是否使用金流,0啟用1停用"]);

        $read_privacy = Request::input('read_privacy', '');
        $write_privacy = Request::input('write_privacy', '');
        $cron = Request::input('cron', '');
        $alertdefine = Request::input('alertdefine', '');
        $eventqueue = Request::input('eventqueue', '');

        if ($this->User->checkMember($email, $passwd)) {
            $BarData['userid'] = $this->User->GetUserId($email);
            $BarData['exrate'] = $exrate;
            $BarData['name'] = $name;
            $BarData['title'] = $title;
            $BarData['type'] = $type;
            $BarData['unit'] = $unit;
            $BarData['vol_max'] = $vol_max;
            $BarData['vol_current'] = $vol_current;
            $BarData['cashflow'] = $cashflow;
            if (! empty($read_privacy))
                $BarData['read_privacy'] = $read_privacy;
            if (! empty($write_privacy))
                $BarData['write_privacy'] = $write_privacy;
            if (! empty($cron))
                $BarData['cron'] = $cron;
            if (! empty($alertdefine))
                $BarData['alertdefine'] = $alertdefine;
            if (! empty($eventqueue))
                $BarData['eventqueue'] = $eventqueue;
            try {
                $id = $this->Bar->addBar($BarData);
                return response()->json(["status" => "success", "barid" => $id]);
            } catch (Exception $e) {
                return response()->json(["status" => "error", "reason" => "新增失敗"]);
            }
        } else
            return response()->json(["status" => "error", "reason" => "帳號驗證錯誤"]);
    }

    public function editBar()
    {
        $email = Request::input('email', '');
        if (empty($email))
            return response()->json(["status" => "error", "reason" => "未輸入帳號"]);
        $passwd = Request::input('passwd', '');
        if (empty($passwd))
            return response()->json(["status" => "error", "reason" => "未輸入密碼"]);
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);
        $exrate = Request::input('exrate', '');
        if (empty($exrate))
            return response()->json(["status" => "error", "reason" => "未輸入單位匯率"]);
        $name = Request::input('name', '');
        if (empty($name))
            return response()->json(["status" => "error", "reason" => "未輸入名稱"]);
        $title = Request::input('title', '');
        if (empty($title))
            return response()->json(["status" => "error", "reason" => "未輸入標題"]);
        $type = Request::input('type', '');
        if (empty($type))
            return response()->json(["status" => "error", "reason" => "未輸入類型"]);
        $unit = Request::input('unit', '');
        if (empty($unit))
            return response()->json(["status" => "error", "reason" => "未輸入單位"]);
        $vol_max = Request::input('vol_max', '');
        if (empty($vol_max))
            return response()->json(["status" => "error", "reason" => "未輸入最大值"]);
        $vol_current = Request::input('vol_current', '');
        if (empty($vol_current))
            return response()->json(["status" => "error", "reason" => "未輸入目前值"]);
        $cashflow = Request::input('cashflow', '');
        if (empty($cashflow))
            return response()->json(["status" => "error", "reason" => "未輸入是否使用金流,0啟用1停用"]);

        $read_privacy = Request::input('read_privacy', '');
        $write_privacy = Request::input('write_privacy', '');
        $cron = Request::input('cron', '');
        $alertdefine = Request::input('alertdefine', '');
        $eventqueue = Request::input('eventqueue', '');

        if ($this->User->checkMember($email, $passwd)) {
            $BarData['userid'] = $this->User->getUserId($email);
            $BarData['barid'] = $barid;
            $BarData['exrate'] = $exrate;
            $BarData['name'] = $name;
            $BarData['title'] = $title;
            $BarData['type'] = $type;
            $BarData['unit'] = $unit;
            $BarData['vol_max'] = $vol_max;
            $BarData['vol_current'] = $vol_current;
            $BarData['cashflow'] = $cashflow;
            if (! empty($read_privacy))
                $BarData['read_privacy'] = $read_privacy;
            if (! empty($write_privacy))
                $BarData['write_privacy'] = $write_privacy;
            if (! empty($cron))
                $BarData['cron'] = $cron;
            if (! empty($alertdefine))
                $BarData['alertdefine'] = $alertdefine;
            if (! empty($eventqueue))
                $BarData['eventqueue'] = $eventqueue;
            try {
                $this->Bar->editBar($BarData);
                return response()->json(["status" => "success"]);
            } catch (Exception $e) {
                return response()->json(["status" => "error", "reason" => "更新失敗"]);
            }
        } else
            return response()->json(["status" => "error", "reason" => "帳號驗證錯誤"]);
    }

    public function readBar()
    {
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);

        try {
            $bar = $this->Bar->getBar($barid);
            $bar->status = "success";
            return response()->json($bar);
        } catch (Exception $e) {
            return response()->json(["status" => "error", "reason" => "未找到結果"]);
        }
    }

    public function readPicBar()
    {

    }

    public function readListBar()
    {
        $userid = Request::input('userid', '');
        if (empty($userid))
            return response()->json(["status" => "error", "reason" => "未輸入使用者id"]);

        $baridlist = $this->Bar->getBarList($userid);
        $barid = array();
        foreach ($baridlist as $bar)
            $barid[] = $bar;
        $barid_str = implode(',', $barid);
        if (! empty($barid))
            return response()->json(["status" => "success", "barid" => $barid_str]);
        else
            return response()->json(["status" => "error", "reason" => "未找到結果"]);
    }

    public function delBar()
    {
        $email = Request::input('email', '');
        if (empty($email))
            return response()->json(["status" => "error", "reason" => "未輸入帳號"]);
        $passwd = Request::input('passwd', '');
        if (empty($passwd))
            return response()->json(["status" => "error", "reason" => "未輸入密碼"]);
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);

        if ($this->User->checkMember($email, $passwd)) {
            try {
                $this->Bar->delBar($barid);
                return response()->json(["status" => "success"]);
            } catch (Exception $e) {
                return response()->json(["status" => "error", "reason" => "刪除失敗"]);
            }
        } else
            return response()->json(["status" => "error", "reason" => "帳號驗證錯誤"]);
    }

    public function writeBar()
    {
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);
        $action = Request::input('action', '');
        if (empty($action))
            return response()->json(["status" => "error", "reason" => "未輸入行為,inc/dec/set/full/kill"]);
        $vol = Request::input('vol', '');
        if (($action == 'inc' || $action == 'dec' || $action == 'set') && empty($vol))
            return response()->json(["status" => "error", "reason" => "未輸入値"]);

        try {
            $bar = $this->Bar->writeBar($barid, $action, $vol);
            $bar['status'] = "success";
            return response()->json($bar);
        } catch (Exception $e) {
            return response()->json(["status" => "error", "reason" => "寫入行為失敗"]);
        }
    }

    public function cronBar()
    {
        $email = Request::input('email', '');
        if (empty($email))
            return response()->json(["status" => "error", "reason" => "未輸入帳號"]);
        $passwd = Request::input('passwd', '');
        if (empty($passwd))
            return response()->json(["status" => "error", "reason" => "未輸入密碼"]);
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);
        $action = Request::input('action', '');
        if (empty($action))
            return response()->json(["status" => "error", "reason" => "未輸入行為,add/del/replace"]);
        $cron = Request::input('cron', '');
        if (($action == 'add' || $action == 'replace') && empty($cron))
            return response()->json(["status" => "error", "reason" => "未輸入排程"]);

        if ($this->User->checkMember($email, $passwd)) {
            try {
                $this->Bar->cronBar($barid, $action, $cron);
                return response()->json(["status" => "success"]);
            } catch (Exception $e) {
                return response()->json(["status" => "error", "reason" => "寫入行為失敗"]);
            }
        } else
            return response()->json(["status" => "error", "reason" => "帳號驗證錯誤"]);
    }

    public function eventBar()
    {
        $email = Request::input('email', '');
        if (empty($email))
            return response()->json(["status" => "error", "reason" => "未輸入帳號"]);
        $passwd = Request::input('passwd', '');
        if (empty($passwd))
            return response()->json(["status" => "error", "reason" => "未輸入密碼"]);
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);
        $action = Request::input('action', '');
        if (empty($action))
            return response()->json(["status" => "error", "reason" => "未輸入行為,add/del/replace"]);
        $cron = Request::input('cron', '');
        if (($action == 'add' || $action == 'replace') && empty($cron))
            return response()->json(["status" => "error", "reason" => "未輸入排程"]);

        if ($this->User->checkMember($email, $passwd)) {
            try {
                $this->Bar->eventBar($barid, $action, $cron);
                return response()->json(["status" => "success"]);
            } catch (Exception $e) {
                return response()->json(["status" => "error", "reason" => "寫入行為失敗"]);
            }
        } else
            return response()->json(["status" => "error", "reason" => "帳號驗證錯誤"]);
    }

    public function alertBar()
    {
        $email = Request::input('email', '');
        if (empty($email))
            return response()->json(["status" => "error", "reason" => "未輸入帳號"]);
        $passwd = Request::input('passwd', '');
        if (empty($passwd))
            return response()->json(["status" => "error", "reason" => "未輸入密碼"]);
        $barid = Request::input('barid', '');
        if (empty($barid))
            return response()->json(["status" => "error", "reason" => "未輸入血條id"]);
        $action = Request::input('action', '');
        if (empty($action))
            return response()->json(["status" => "error", "reason" => "未輸入行為,add/del/replace"]);
        $cron = Request::input('cron', '');
        if (($action == 'add' || $action == 'replace') && empty($cron))
            return response()->json(["status" => "error", "reason" => "未輸入排程"]);

        if ($this->User->checkMember($email, $passwd)) {
            try {
                $this->Bar->alertBar($barid, $action, $cron);
                return response()->json(["status" => "success"]);
            } catch (Exception $e) {
                return response()->json(["status" => "error", "reason" => "寫入行為失敗"]);
            }
        } else
            return response()->json(["status" => "error", "reason" => "帳號驗證錯誤"]);
    }
}
