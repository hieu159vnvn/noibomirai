<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AdminResetPasswordNotification;
use Notification;
use Validator;
use Auth;
use App\User;
use App\Models\History;
class AuthenticateController extends Controller
{
    public function getAdminLogin(){
    	return view('admin.auth.login');
    }

    public function postAdminLogin(Request $request){
    	// Validate login form
    	$rules = [
    		'username' => 'required',
            'password' => 'required',
    	];
        $messages = [
		    'username.required'    => 'Username là trường bắt buộc.',
		    'password.required'    => 'Password là trường bắt buộc.',
		];
		$validator = Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $username = $request->username;
		$password = $request->password;
        $history = new History;
        $history->id_user = $username;
        $history->ip_log = $request->ip();                    
        $history->save();

		if( Auth::attempt(['username' => $username, 'password' =>$password])) {
            
            return redirect('/admin-dashboard');
		}
		$errors = new MessageBag(['errorlogin' => 'username hoặc password không đúng!']);
		return redirect()->back()->withInput()->withErrors($errors);
    }

    public function getAdminLogout(Request $request){
    	Auth::logout();
    	return redirect('/admin-login');
    }

    public function getAdminResetPassword(){

        if(Auth::check()){
            return redirect('admin-login');
        }
        return view('admin.auth.resetPassword');
    }
    public function postAdminResetPassword(Request $request){
        $user = User::where('email',$request->email)->get();
        if($user->count() == 0){
            $errors = new MessageBag(['errorreset' => "Không tìm thấy địa chỉ email này."]);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        Notification::send($user[0], new AdminResetPasswordNotification(app('auth.password.broker')->createToken($user[0])));
        return redirect('admin-login')->with('status', 'Link tạo mới mật khẩu đã được gửi tới email của bạn. Hãy kiểm tra email!');
    }

    public function getAdminChangePassword($token){
        $passResets = DB::table('password_resets')->get();
        foreach ($passResets as $passReset) {
            if(Hash::check($token, $passReset->token)){
                return view('admin.auth.changePassword')->with('passReset',$passReset);
            }
        }
        $errors = new MessageBag(['errorreset' => "Link tạo mật khẩu mới đã hết hạn hoặc không tồn tại."]);
        return redirect()->route('getAdminLogin')->withErrors($errors);
    }
    public function postAdminChangePassword(Request $request){
        $user = User::where('email',$request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        $passReset = DB::table('password_resets')->where('email',$request->email)->delete();

        return redirect('admin-login')->with('status', 'Tạo mới mật khẩu thành công!');
    }

}
