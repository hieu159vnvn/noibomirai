<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function tableUser(){
        return 'users';
    }
    public static function checkUnique($attribute,$value,$action,$oldValue){
        $user = DB::table(self::tableUser())->where($attribute,$value)->get();
        if(count($user) == 0)
            return false;
        if($action == 'edit' && $value == $oldValue)
            return false;
        return true;
    }
}
