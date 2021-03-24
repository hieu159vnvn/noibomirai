<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\PostTagRequest;
use App\Models\PostTag;

class PostTagController extends Controller
{
	protected function saveTag($request, $tag){
		$tag->tag_name                = $request->tagName;
		$tag->tag_slug                = $request->tagSlug;
		$tag->tag_seo_title       = $request->seoTitle;
		$tag->tag_seo_description = $request->seoDescription;
		$tag->save();
	}

	public function getPostTags(){
		$tags = PostTag::latest()->get();
		return view('admin.post.tag.tag',['tags'=>$tags]);
	}
	public function getDeletePostTag($id){
		PostTag::destroy($id);

		return redirect()->back()->with('status','Đã xóa thẻ thành công!');
	}

	public function getAddPostTag(){
		return view('admin.post.tag.add_tag');
	}
	public function postAddPostTag(PostTagRequest $request){
		$tag = new PostTag;
		$this->saveTag($request,$tag);

		return redirect('admin-dashboard/posttags')->with('status','Đã thêm thẻ "' . $request->tagName . '" thành công!');
	}

	public function getEditPostTag($id){
		$tag = PostTag::find($id);
		return view('admin.post.tag.edit_tag',['tag'=>$tag]);
	}
	public function postEditPostTag(PostTagRequest $request, $id){
		$tag = PostTag::find($id);
		$this->saveTag($request,$tag);

		return redirect('admin-dashboard/posttags')->with('status','Đã sửa thẻ "' . $request->tagName . '" thành công!');
	}
}
