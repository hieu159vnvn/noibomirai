<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductTag;
use App\Models\Product;

class ProductTagController extends Controller
{
	protected function saveProductTag($request, $tag){
		$tag->tag_name                = $request->tagName;
		$tag->tag_slug                = $request->tagSlug;
		$tag->tag_seo_title       = $request->seoTitle;
		$tag->tag_seo_description = $request->seoDescription;
		$tag->save();
	}


    public function getProductTags(){
		$tags = ProductTag::latest()->get();
		return view('admin.product.tag.product_tag',['tags'=>$tags]);
	}
	public function getDeleteProductTag($id){
		ProductTag::destroy($id);

		return redirect()->back()->with('status','Đã xóa thẻ thành công!');
	}

	public function getAddProductTag(){
		return view('admin.product.tag.add_product_tag');
	}
	public function postAddProductTag(Request $request){
		$tag = new ProductTag;
		$this->saveProductTag($request,$tag);

		return redirect('admin-dashboard/producttags')->with('status','Đã thêm thẻ "' . $request->tagName . '" thành công!');
	}

	public function getEditProductTag($id){
		$tag = ProductTag::find($id);
		return view('admin.product.tag.edit_product_tag',['tag'=>$tag]);
	}
	public function postEditProductTag(Request $request, $id){
		$tag = ProductTag::find($id);
		$this->saveProductTag($request,$tag);

		return redirect('admin-dashboard/producttags')->with('status','Đã sửa thẻ "' . $request->tagName . '" thành công!');
	}
}
