<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Post;
use App\Models\ProductImage;
use App\Models\StaticPage;
use App\Models\Config;
use App\Models\Contact;
use Session;

class FrontController extends Controller
{	
	public function getHomePage(){
		return redirect('admin-dashboard');
	}
	public function getZalo(){
		return view('front.login');
	}	
	public function getZaloCallBack(){
		return view('front.call_back');
	}

	public function getAboutUs(){
		$gioithieu = StaticPage::find(2);
		return view('front.aboutus',['gioithieu'=>$gioithieu]);
	}

	public function getLienhe(){
		$contact = StaticPage::find(3);
		return view('front.lienhe',['contact' => $contact]);
	}

	public function getDuan(){
		$duan = Product::orderBy('stt','desc')->orderBy('id','desc')->where('product_banchay',1)->get();
		$productPage = StaticPage::find(4);
		return view('front.duan',['duan'=>$duan,'productPage'=>$productPage]);
	}
	public function getTintuc(){
		$tintuc = Post::get();
		$productPage = StaticPage::find(4);
		return view('front.tintuc',['tintuc'=>$tintuc,'productPage'=>$productPage]);
	}
	public function getDichvu(){
		$dichvu = ProductCategory::where('parent_id',0)->get();
		$productPage = StaticPage::find(4);
		return view('front.dichvu',['dichvu'=>$dichvu,'productPage'=>$productPage]);
	}

	public function getTuyenDung(){
		$tuyendung = StaticPage::find(5);
		return view('front.tuyen_dung',['tuyendung'=>$tuyendung]);
	}

	public function getRoute($slug){
		if(strpos($slug,'.html')){
			if(strpos($slug,'-bv.html')){
				$post = self::getChiTietBaiViet($slug);
				return view('front.chi_tiet_bai_viet',['post'=>$post]);
			}
			else{
				$arr = self::getChiTietChuyenMucBaiViet($slug);//dd($arr[1]->toArray());
				return view('front.chuyen_muc_bai_viet',['category'=>$arr[0],'posts'=>$arr[1]]);
			}
		}else{
			if(strpos($slug,'-rsp')){
				$product = self::getChiTietSanPham($slug);
				$img = ProductImage::where('product_id',$product->id)->get();
				$oldProducts = Product::where('id','<',$product->id)->where('product_category_id',$product->product_category_id)->where('product_noibat',1)->take(6)->get();
				$newProducts = Product::where('id','>',$product->id)->where('product_category_id',$product->product_category_id)->where('product_noibat',1)->take(6)->get();
				$relativeProducts = $oldProducts->union($newProducts);
				return view('front.chi_tiet_san_pham',['product'=>$product,'img'=>$img,'relativeProducts'=>$relativeProducts]);
			} else{
				$arr = self::getChiTietDanhMucSanPham($slug);
				return view('front.chuyen_muc_san_pham',['category'=>$arr[0],'child_categories'=>$arr[1],'products'=>$arr[2]]);
			}
		}
	}

	public static function getChiTietBaiViet($slug){
		$slug = str_replace('-bv.html','',$slug);
		$post = Post::Where('post_slug',$slug)->first();
		return $post;
	}

	public static function getChiTietChuyenMucBaiViet($slug){
		$slug = str_replace('.html','',$slug);
		$category = PostCategory::where('category_slug',$slug)->first();

		$child_categories = PostCategory::where('parent_id',$category->id)->get();
		$child_category_ids = [];
		$grandchild_category_ids = [];

		if($child_categories->count() > 0){
			$child_category_ids = $child_categories->pluck('id')->toArray();

			if(count($child_category_ids) > 0){
				$grandchild_category_ids = PostCategory::select('id')->whereIn('parent_id',$child_category_ids)->get()->pluck('id')->toArray();
			}
		}

		$posts = Post::where('category_id',$category->id)->where('post_status',1)->orWhereIn('category_id',$child_category_ids)->orWhereIn('category_id',$grandchild_category_ids)->paginate(config('myapp.post_paginate'));
		
		return [$category,$posts];
	}

	public static function getChiTietSanPham($slug){
		$slug = str_replace('-rsp','',$slug);
		$product = Product::Where('product_slug',$slug)->first();
		$product->product_view++;
		$product->save();
		return $product;
	}

	public static function getChiTietDanhMucSanPham($slug){
		$category = ProductCategory::where('product_category_slug',$slug)->first();

		$child_categories = ProductCategory::select('id','product_category_name','product_category_slug')->where('parent_id',$category->id)->get();
		$child_category_ids = [];
		$grandchild_category_ids = [];

		if($child_categories->count() > 0){
			$child_category_ids = $child_categories->pluck('id')->toArray();

			if(count($child_category_ids) > 0){
				$grandchild_category_ids = ProductCategory::select('id')->whereIn('parent_id',$child_category_ids)->get()->pluck('id')->toArray();
			}
		}

		$products = Product::where('product_category_id',$category->id)->where('product_status',1)->orWhereIn('product_category_id',$child_category_ids)->orWhereIn('product_category_id',$grandchild_category_ids)->orderBy('stt','desc')->orderBy('id','desc')->paginate(config('myapp.product_paginate'));
		
		return [$category,$child_categories,$products];
	}
	public function postGuiLienHe(Request $request){
		$contact = new Contact;
		$contact->source = $request->nguon;
		$contact->full_name = $request->name;
		$contact->telephone = $request->sdt;
		$contact->email = $request->email;
		$contact->subject = $request->subject;
		$contact->content = $request->content;
		$contact->save();

		return response()->json('OK',200);
	}

	public function postGuiMail(Request $request){
		$contact = new Contact;
		$contact->source = $request->nguon;
		$contact->email = $request->email;
		$contact->save();

		return response()->json('OK',200);
	}
}
