<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use App\Models\ProductCategory;

class StaticPageController extends Controller
{

	public function getHomePage(){
        $categories = ProductCategory::all();
        $links = StaticPage::find(1);
    	return view('admin.static_page.home_page',['home_page' => StaticPage::find(1),'categories'=>$categories,'links'=>json_decode($links->content)]);
    }
    public function postHomePage(Request $request){
    	$homepage = StaticPage::find(1);
        $homepage->content = "";
        if(count($request->productImage) > 0){
            $content = '{"';
            foreach ($request->productImage as $k => $link) {
                $content .= 'link'.$k.'":"';
                $content .= $link.'","';
                                
            }
            $content = rtrim($content,',"');
            $content .= '"}';  
            $homepage->content = $content;          
        }
        
    	$homepage->h1_tag = $request->h1Tag;
    	$homepage->h2_tag = $request->h2Tag;
    	$homepage->h3_tag = $request->h3Tag;
    	$homepage->seo_title = $request->seoTitle;
    	$homepage->seo_description = $request->seoDescription;
    	$homepage->save();
    	return redirect()->back()->with('status','Đã cập nhật thành công!');
    }

    public function getContactUsPage(){
    	return view('admin.static_page.contact_us',['contact_us' => StaticPage::find(3)]);
    }
    public function postContactUsPage(Request $request){
    	$contactpage = StaticPage::find(3);
    	$contactpage->title = $request->title;
    	$contactpage->content = $request->pageContent;
        $contactpage->content_1 = $request->googleMap;
    	$contactpage->h1_tag = $request->h1Tag;
    	$contactpage->h2_tag = $request->h2Tag;
    	$contactpage->h3_tag = $request->h3Tag;
    	$contactpage->seo_title = $request->seoTitle;
    	$contactpage->seo_description = $request->seoDescription;
    	$contactpage->save();
    	return redirect()->back()->with('status','Đã cập nhật thành công!');
    }

    public function getAboutUsPage(){
    	return view('admin.static_page.about_us',['about_us' => StaticPage::find(2)]);
    }
    public function postAboutUsPage(Request $request){
    	$contactpage = StaticPage::find(2);
    	$contactpage->title = $request->title;
    	$contactpage->content = $request->pageContent;
    	$contactpage->h1_tag = $request->h1Tag;
    	$contactpage->h2_tag = $request->h2Tag;
    	$contactpage->h3_tag = $request->h3Tag;
    	$contactpage->seo_title = $request->seoTitle;
    	$contactpage->seo_description = $request->seoDescription;
    	$contactpage->save();
    	return redirect()->back()->with('status','Đã cập nhật thành công!');
    }

    public function getProductPage(){
        return view('admin.static_page.san_pham',['san_pham' => StaticPage::find(4)]);
    }
    public function postProductPage(Request $request){
        $productpage = StaticPage::find(4);
        $productpage->title = $request->title;
        $productpage->h1_tag = $request->h1Tag;
        $productpage->h2_tag = $request->h2Tag;
        $productpage->h3_tag = $request->h3Tag;
        $productpage->seo_title = $request->seoTitle;
        $productpage->seo_description = $request->seoDescription;
        $productpage->save();
        return redirect()->back()->with('status','Đã cập nhật thành công!');
    }

    public function getRecruitmentPage(){
        return view('admin.static_page.tuyen_dung',['tuyen_dung' => StaticPage::find(5)]);
    }
    public function postRecruitmentPage(Request $request){
        $recruitment = StaticPage::find(5);
        $recruitment->title = $request->title;
        $recruitment->content = $request->pageContent;
        $recruitment->h1_tag = $request->h1Tag;
        $recruitment->h2_tag = $request->h2Tag;
        $recruitment->h3_tag = $request->h3Tag;
        $recruitment->seo_title = $request->seoTitle;
        $recruitment->seo_description = $request->seoDescription;
        $recruitment->save();
        return redirect()->back()->with('status','Đã cập nhật thành công!');
    }

    // public function getTrangDuToan(){
    //     return view('admin.static_page.du_toan_kinh_phi',['du_toan' => StaticPage::find(4)]);
    // }
    // public function postTrangDuToan(Request $request){
    //     $page = StaticPage::find(4);
    //     $page->title = $request->title;
    //     $page->content = $request->pageContent;
    //     $page->h1_tag = $request->h1Tag;
    //     $page->h2_tag = $request->h2Tag;
    //     $page->h3_tag = $request->h3Tag;
    //     $page->seo_title = $request->seoTitle;
    //     $page->seo_description = $request->seoDescription;
    //     $page->save();
    //     return redirect()->back()->with('status','Đã cập nhật thành công!');
    // }


    // public function getHoTro(){
    //     $hotro = StaticPage::find(4);
    //     return view('admin.static_page.support',['hotro'=>$hotro->content]);
    // }

    //  public function postHoTro(Request $request){
    //     $hotro = StaticPage::find(4);
    //     $hotro->content = $request->hotro;
    //     $hotro->save();
    //     return redirect()->back()->with('status','Đã cập nhật thành công!');
    // }
   
}
