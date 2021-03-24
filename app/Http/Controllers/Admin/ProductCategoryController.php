<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
	public function saveProductCategory($request, $category){
		$category->product_category_name            = $request->categoryName;
		$category->product_category_slug            = $request->categorySlug;
		$category->parent_id                        = $request->categoryParent;
		if($request->categoryPrice){
			$price = (int)str_replace (',','',$request->categoryPrice);
			$category->product_category_price       = $price;
		}else
			$category->product_category_price       = 0;
		
		$category->product_category_image           = $request->featureImage;
		$category->product_category_description     = $request->productDescription;
		$category->product_category_seo_title       = $request->seoTitle;
		$category->product_category_seo_description = $request->seoDescription;
		$category->save();
	}


    public function getProductCategories(){
    	$categories = ProductCategory::all();
    	$colection = new Collection();
		return view('admin.product.category.product_category',['categories'=>ProductCategory::getNestedCategories($colection,$categories,0,"")]);
    }
    public function getDeleteProductCategory($id){
		ProductCategory::destroy($id);

		return redirect()->back()->with('status','Đã xóa danh mục thành công!');
	}

    public function getAddProductCategory(){
    	$categories = ProductCategory::all();
    	return view('admin.product.category.add_product_category',['optionDropdownCategories' => ProductCategory::getCategoryLevelOneDropdownOptions($categories,0)]);

    	//Khi danh mục sản phẩm có từ 3 cấp trở lên thì dùng câu lệnh return này
    	//return view('admin.product.category.add_product_category',['optionDropdownCategories' => ProductCategory::getDropdownOptions($categories,0,"",0)]);
    }
    public function postAddProductCategory(Request $request){
    	$category = new ProductCategory;
		$this->saveProductCategory($request,$category);

		return redirect('admin-dashboard/productcategories')->with('status','Đã thêm chuyên mục "' . $request->categoryName . '" thành công!');
    }

    public function getEditProductCategory($id){
    	$category = ProductCategory::find($id);
    	$categories = ProductCategory::where('id','<>',$id)->get();
    	return view('admin.product.category.edit_product_category',['category' => $category, 'optionDropdownCategories' => ProductCategory::getCategoryLevelOneDropdownOptions($categories,$category->parent_id)]);

    	//Khi danh mục sản phẩm có từ 3 cấp trở lên thì dùng câu lệnh return này
    	//return view('admin.product.category.edit_product_category',['category' => $category, 'optionDropdownCategories' => ProductCategory::getDropdownOptions($categories,0,"",$category->parent_id)]);
    }
    public function postEditProductCategory(Request $request,$id){
    	$category = ProductCategory::find($id);
		$this->saveProductCategory($request,$category);

		return redirect('admin-dashboard/productcategories')->with('status','Đã sửa chuyên mục "' . $request->categoryName . '" thành công!');
    }
}
