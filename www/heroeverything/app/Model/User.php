<?php

namespace App\Model;

use Hash;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'userid';

    /**
     * 帳號密碼驗證，存在回傳true
     * @param $account
     * @param string $passwd
     * @return bool
     */
    public function CheckMember($email = '', $passwd = '')
    {
        $pw = User::where('email', '=', $email)->pluck('passwd');
        if (Hash::check($passwd,$pw)) {
            return true;
        } else {
            return false;
        }
    }

    public function GetUserId($email)
    {
        return User::where('email','=',$email)->pluck('userid');
    }

}
