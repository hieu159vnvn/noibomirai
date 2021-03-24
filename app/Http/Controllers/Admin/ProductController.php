<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
	public static function saveProduct($request,$product,$action){
		DB::beginTransaction();
        
        try {
            $product->product_title = $request->productTitle;
			$product->product_slug = $request->productSlug;
			$product->product_description = $request->productDescription;
			$product->product_category_id = $request->productCategory;
			$product->product_content = $request->productContent;
			$product->product_feature_image = $request->featureImage;
			if($request->productOldPrice){
				$price = (int)str_replace (',','',$request->productOldPrice);
				$product->product_old_price       = $price;
			}else
				$product->product_old_price       = 0;
			if($request->productNewPrice){
				$price = (int)str_replace (',','',$request->productNewPrice);
				$product->product_new_price       = $price;
			}else
				$product->product_new_price       = 0;
				
			if(isset($request->status))
				$product->product_status = 1;
			else
				$product->product_status = 0;

			if(isset($request->noibat))
				$product->product_noibat = 1;
			else
				$product->product_noibat = 0;

			if(isset($request->banchay))
				$product->product_banchay = 1;
			else
				$product->product_banchay = 0;
			$product->masanpham = $request->masanpham;
			$product->nhasanxuat = $request->nhasanxuat;
			$product->baohanh = $request->baohanh;
			$product->xuatxu = $request->xuatxu;
			$product->stt = $request->stt; 
			$product->product_seo_title = $request->seoTitle;
			$product->product_seo_description = $request->seoDescription;
			$product->h1_tag = $request->h1Tag;
			$product->h2_tag = $request->h2Tag;
			$product->h3_tag = $request->h3Tag;
			$product->user_id = 1;
			$product->save();

			if($action == "edit"){
				DB::table('product_tag')->where('product_id', $product->id)->delete();
      			ProductImage::where('product_id', $product->id)->delete();
      		}

			if(count($request->productTags) > 0){
				foreach ($request->productTags as $tag) {
					DB::table('product_tag')->insert(
					    ['product_id' => $product->id, 'tag_id' => $tag]
					);
				}
			}
            
            if(count($request->productImage) > 0){
				foreach ($request->productImage as $productImage) {
					$image = new ProductImage;
					$image->image_url = $productImage;
					$image->product_id = $product->id;
					$image->save();
				}
			}
            
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
		
		
	}

    public function getProducts(){
		$products = Product::with(['tags','category'])->orderBy('stt','desc')->orderBy('id','desc')->get();
		return view('admin.product.product',['products'=>$products]);
	}
	public function postChangeProductStatus(Request $request){
		$product = Product::find($request->id);
			$product->product_status = 1;
		if($request->status === 'false')
			$product->product_status = 0;
		$product->save();
		return response()->json('OK', 200);
	}
	public function postChangeProductNoiBat(Request $request){
		$product = Product::find($request->id);
			$product->product_noibat = 1;
		if($request->noibat === 'false')
			$product->product_noibat = 0;
		$product->save();
		return response()->json('OK', 200);
	}
	public function postChangeProductBanChay(Request $request){
		$product = Product::find($request->id);
			$product->product_banchay = 1;
		if($request->banchay === 'false')
			$product->product_banchay = 0;
		$product->save();
		return response()->json('OK', 200);
	}
	public function postChangeProductStt(Request $request){
		$product = Product::find($request->id);
		$product->stt = $request->stt;
		$product->save();
		return response()->json('OK', 200);
	}

	public function getDeleteProduct($id){
		ProductImage::where('product_id',$id)->delete();
		Product::destroy($id);

		return redirect()->back()->with('status','Đã xóa sản phẩm thành công!');
	}

	public function getAddProduct(){
		$tags = ProductTag::all();
		$categories = ProductCategory::all();

		return view('admin.product.add_product',['tags' => $tags,'optionDropdownCategories' => ProductCategory::getDropdownOptions($categories,0,"",0)]);
	}
	public function postAddProduct(Request $request){
		$product = new Product;
		if($this->saveProduct($request,$product,"add"))
	    if(isset($request->zalo))
		self::postPostToZalo($request);
			return redirect('admin-dashboard/products')->with('status','Đã thêm sản phẩm "' . $request->productTitle . '" thành công!');
		return redirect('admin-dashboard/products')->with('status','Đã thêm sản phẩm "' . $request->productTitle . '" không thành công!');
	}

	public function getEditProduct($id){
		$tags = ProductTag::all();
		$categories = ProductCategory::all();
		$productImages = ProductImage::where('product_id',$id)->orderBy('id','ASC')->get();
		$product = Product::find($id);
		$tagIds = DB::table('product_tag')->where('product_id',$id)->pluck('tag_id')->toArray();
		$Ids = "";
		if(count($tagIds)>0){
			foreach ($tagIds as $key => $tagId) {
				$Ids .=$tagId.",";
			}
		}
		
		return view('admin.product.edit_product',['tags' => $tags, 'optionDropdownCategories' => ProductCategory::getDropdownOptions($categories,0,"",$product->product_category_id), 'product'=>$product, 'productImages'=>$productImages, 'tagIds'=>$Ids]);
	}
	public function postEditProduct(Request $request,$id){
		$product = Product::find($id);
		if($this->saveProduct($request,$product,"edit"))
			if(isset($request->zalo))
		self::postPostToZalo($request);
			return redirect('admin-dashboard/products')->with('status','Đã sửa sản phẩm "' . $product->product_title . '" thành công!');
		return redirect('admin-dashboard/products')->with('status','Đã sửa sản phẩm "' . $product->product_title . '" không thành công!');
	}
}
