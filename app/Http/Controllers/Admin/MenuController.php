<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function getMenus(){
    	$menu = Menu::find(1);
    	return view('admin.menu.menu',['menu'=>Menu::getMenuAdmin()]);
    }
    public function postMenus(Request $request){
    	$menu = Menu::find(1);
    	$menu->menu_content = $request->menuContent;
    	$menu->save();
    	return redirect()->back()->with('status','Đã lưu menu thành công!');
    }
}
