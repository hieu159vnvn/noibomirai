<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;

class ConfigController extends Controller
{
    public function getHeader(){
    	$header = Config::find(1);
    	return view('admin.config.header',['header'=>json_decode($header->content),'doitac'=>json_decode($header->content1)]);
    }
    public function postHeader(Request $request){
    	$content = '{"favicon":"'.$request->favicon.'", "logo":"'.$request->logo.'","quangcao":"'.$request->quangcao.'", "hotline1":"'.$request->hotline1.'", "hotline2":"'.$request->hotline2.'", "facebook":"'.$request->facebook.'", "skype":"'.$request->skype.'", "youtube":"'.$request->youtube.'", "linkedin":"'.$request->linkedin .'"}';

        $content1 = '{"pic1":"'.$request->pic1.'","pic2":"'.$request->pic2.'","pic3":"'.$request->pic3.'","pic4":"'.$request->pic4.'","pic5":"'.$request->pic5.'","pic6":"'.$request->pic6.'","pic7":"'.$request->pic7.'","pic8":"'.$request->pic8.'"}';
    	$header = Config::find(1);
        $header->content = $content;
        $header->content1 = $content1;
    	

    	$header->save();

    	return redirect()->back()->with('status','Đã thay dổi phần đầu trang thành công!');
    }

    public function getFooter(){
        $footer = Config::find(2);
        return view('admin.config.footer',['footer'=>$footer,'video'=>json_decode($footer->content2)]);
    }
    public function postFooter(Request $request){
        $footer = Config::find(2);
        $footer->content3 = $request->facebook;
        $footer->content1 = $request->googleMap;
        $content2 = '{"video1":"'.$request->video1.'","video2":"'.$request->video2.'","video3":"'.$request->video3.'","video4":"'.$request->video4.'","video5":"'.$request->video5.'"}';
        $footer->content2 = $content2;
        $footer->content = $request->content;
        $footer->save();

        return redirect()->back()->with('status','Đã thay thay đổi code thành công!');
    }

    public function getInsertCode(){
        $code = Config::find(3);
        return view('admin.config.insert_code',['code'=>$code]);
    }
    public function postInsertCode(Request $request){
        $code = Config::find(3);
        $code->content = $request->headerCode;
        $code->content1 = $request->footerCode;
        $code->save();

        return redirect()->back()->with('status','Đã thay thay đổi code thành công!');
    }

    public function getHoTro(){
        $hotro = Config::find(4);
        return view('admin.config.support',['hotro'=>$hotro]);
    }

    public function postHoTro(Request $request){
        $hotro = Config::find(4);
        $hotro->content = $request->name1;
        $hotro->content1 = $request->sdt1;
        $hotro->content2 = $request->email1;
        $hotro->content3 = $request->name2;
        $hotro->content4 = $request->sdt2;
        $hotro->content5 = $request->email2;
        $hotro->save();
        return redirect()->back()->with('status','Đã thay thay đổi code thành công!');
    }
}
