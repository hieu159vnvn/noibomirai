<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menus';

	
	public static $_htmlMenuAdmin = "";

    public static function tableMenu(){
        return 'menus';
    }

    public static function buildMenu($menu){
    	for ($i=0;$i<count($menu);$i++) {
        	if(!isset($menu[$i]->children) || $menu[$i]->children==null) {
        		self::$_htmlMenuAdmin .= '<li class="dd-item" data-id="'.$menu[$i]->id.'" data-name="'.$menu[$i]->name.'" data-slug="'.$menu[$i]->slug.'" data-new="0" data-deleted="0" data-children="null"><div class="dd-handle">'.$menu[$i]->name.'</div><span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="'.$menu[$i]->id.'"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span><span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="'.$menu[$i]->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></span></li>';
        		
	        }else{
	        	self::$_htmlMenuAdmin .= '<li class="dd-item" data-id="'.$menu[$i]->id.'" data-name="'.$menu[$i]->name.'" data-slug="'.$menu[$i]->slug.'" data-new="0" data-deleted="0"><div class="dd-handle">'.$menu[$i]->name.'</div><span class="button-delete btn btn-default btn-xs pull-right" data-owner-id="'.$menu[$i]->id.'"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span><span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="'.$menu[$i]->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></span><ol class="dd-list">';
	            self::buildMenu($menu[$i]->children);
	            self::$_htmlMenuAdmin .= '</ol></li>';
	        }
	    }
    }
    
    public static function getMenuAdmin(){
    	$menu = DB::table(self::tableMenu())->first();
    	self::buildMenu(json_decode($menu->menu_content));
    	return self::$_htmlMenuAdmin;
    }

    public static function getMenuFront(){
        $menu = DB::table(self::tableMenu())->first();
        return json_decode($menu->menu_content);
    }
}
