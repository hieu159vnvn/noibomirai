<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected static $_dropdowOptions;

    public function products()
    {
        return $this->hasMany('App\Models\Product','product_category_id','id');
    }


    public static function tableProductCategory(){
        return 'product_categories';
    }

    public static function getDropdownOptions($categories,$parent_id,$str="",$selected = 0){
		foreach ($categories as $k => $category) {
			$id = $category->id;
			$name = $category->product_category_name;
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

	public static function getCategoryLevelOneDropdownOptions($categories,$selected = 0){
		foreach ($categories as $k => $category) {
			$id = $category->id;
			$name = $category->product_category_name;
			if($category->parent_id == 0){
				if($selected != 0 && $id == $selected)
					self::$_dropdowOptions .= '<option value="'.$id.'" selected>'.$name.'</option>';
				else
					self::$_dropdowOptions .= '<option value="'.$id.'">'.$name.'</option>';
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


	/*
	 * Method of web Front
	*/
	public static function getLevelThreeCategoriesForFront(){
		$idCategoryLevelOne = DB::table(self::tableProductCategory())->where('parent_id',0)->get()->pluck('id')->toArray();
		$categoryLevelThree = DB::table(self::tableProductCategory())->where('parent_id','>',0)->whereNotIn('parent_id', $idCategoryLevelOne)->get();
		return $categoryLevelThree;
	}
}
