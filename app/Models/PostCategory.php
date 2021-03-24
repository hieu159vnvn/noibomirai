<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';

    protected static $_dropdowOptions;

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public static function getDropdownOptions($categories,$parent_id,$str="",$selected = 0){
		foreach ($categories as $k => $category) {
			$id = $category->id;
			$name = $category->category_name;
			if($category->parent_id == $parent_id){
				if($selected != 0 && $id == $selected)
					self::$_dropdowOptions .= '<option value="'.$id.'" selected>'.$str.$name.'</option>';
				else
					self::$_dropdowOptions .= '<option value="'.$id.'">'.$str.$name.'</option>';
				self::getDropdownOptions($categories,$id,$str."---- ",$selected);
			}
		}
		return self::$_dropdowOptions;
	}

	public static function getNestedCategories($colection,$categories,$parent_id,$str=""){
		foreach ($categories as $k => $category) {
			$id = $category->id;
			$name = $category->category_name;
			if($category->parent_id == $parent_id){
				$category->prefixString = $str;
				$colection->push($category);

				self::getNestedCategories($colection,$categories,$id,$str."---- ");
			}
		}
		return $colection;
	}
}
