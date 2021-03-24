<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = '/home';

    protected function redirectTo()
    {
        $email = Auth::user()->email;
        if(Auth::user()->hasRole('Giáo Viên')){
            $daotao = DB::table('nhanviens')
                ->join('daotaos','daotaos.gvcn','=','nhanviens.id')
                ->where('nhanviens.email',$email)->select('daotaos.id')->first();
                if ($daotao) {
                    return "diemdanh/".$daotao->id."/add";
                }else{
                    return "home";
                }
        }else{
            return "home";
        }
        // return $user;
        // dd($user);
        // if($a == 1) {
        //     return "/home";
        // } 
        // return "/your/secondpath";
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
