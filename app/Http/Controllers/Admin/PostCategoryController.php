<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Collection;
use App\Http\Requests\Admin\PostCategoryRequest;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
	public function saveCategory($request, $category){
		$category->category_name            = $request->categoryName;
		$category->category_slug            = $request->categorySlug;
		$category->parent_id                = $request->categoryParent;
		$category->category_seo_title       = $request->seoTitle;
		$category->category_seo_description = $request->seoDescription;
		$category->save();
	}

/*
 * Method of routes
*/

    public function getPostCategories(){
    	$categories = PostCategory::all();
    	$colection = new Collection();
		return view('admin.post.category.category',['categories'=>PostCategory::getNestedCategories($colection,$categories,0,"")]);
    }

    public function getDeletePostCategory($id){
		PostCategory::destroy($id);

		return redirect()->back()->with('status','Đã xóa chuyên mục thành công!');
	}

    public function getAddPostCategory(){
    	$categories = PostCategory::all();
    	return view('admin.post.category.add_category',['optionDropdownCategories' => PostCategory::getDropdownOptions($categories,0,"",0)]);
    }
    public function postAddPostCategory(PostCategoryRequest $request){
    	$category = new PostCategory;
		$this->saveCategory($request,$category);

		return redirect('admin-dashboard/postcategories')->with('status','Đã thêm chuyên mục "' . $request->categoryName . '" thành công!');
    }

    public function getEditPostCategory($id){
    	$category = PostCategory::find($id);
    	$categories = PostCategory::all();
    	return view('admin.post.category.edit_category',['category' => $category, 'optionDropdownCategories' => PostCategory::getDropdownOptions($categories,0,"",$category->parent_id)]);
    }
    public function postEditPostCategory(PostCategoryRequest $request,$id){
    	$category = PostCategory::find($id);
		$this->saveCategory($request,$category);

		return redirect('admin-dashboard/postcategories')->with('status','Đã sửa chuyên mục "' . $request->categoryName . '" thành công!');
    }

}
