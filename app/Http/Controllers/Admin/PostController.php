<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\PostRequest;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Post;
use Session;

class PostController extends Controller
{

	public static function savePost($request,$post){
		$post->post_title = $request->postTitle;
		$post->post_slug = $request->postSlug;
		$post->post_description = $request->postDescription;
		$post->category_id = $request->postCategory;
		$post->post_content = $request->postContent;
		$post->post_image = $request->featureImage;
		if(isset($request->status))
			$post->post_status = 1;
		else
			$post->post_status = 0;
		$post->post_seo_title = $request->seoTitle;
		$post->post_seo_description = $request->seoDescription;
		$post->h1_tag = $request->h1Tag;
		$post->h2_tag = $request->h2Tag;
		$post->h3_tag = $request->h3Tag;
		$post->user_id = 1;
		$post->save();
		if(count($request->postTags) > 0){
			foreach ($request->postTags as $tag) {
				DB::table('post_tag')->insert(
				    ['post_id' => $post->id, 'tag_id' => $tag]
				);
			}
		}
	}

	public static function postPostToFanpage($request){
		$arr = array('message' => html_entity_decode($request->postDescription, ENT_COMPAT, "UTF-8"), 'link' => url('bai-viet/'.$request->postSlug));
		$data = Session::get('facebook_body')['data'];
		$fb = new \Facebook\Facebook(config('facebook'));
		$res = $fb->post($data[0]['id'].'/feed/', $arr, $data[0]['access_token']);
	}

/*
 *
*/
	public function getPosts(){
		$posts = Post::with(['tags','category'])->latest()->get();
		return view('admin.post.post',['posts'=>$posts]);
	}
	public function postChangePostStatus(Request $request){
		$post = Post::find($request->id);
		if($request->status === 'true')
			$post->post_status = 1;
		if($request->status === 'false')
			$post->post_status = 0;
		$post->save();
		return response()->json('OK', 200);
	}
	public function getDeletePost($id){
		Post::destroy($id);

		return redirect()->back()->with('status','Đã xóa bài viết thành công!');
	}

	public function getAddPost(){
		$tags = PostTag::all();
		$categories = PostCategory::all();

		return view('admin.post.add_post',['tags' => $tags, 'optionDropdownCategories' => PostCategory::getDropdownOptions($categories,0,"",0)]);
	}
	public function postAddPost(PostRequest $request){
		$post = new Post;
		$this->savePost($request,$post);
		if(isset($request->fanpageStatus))
			self::postPostToFanpage($request);
		return redirect('admin-dashboard/posts')->with('status','Đã thêm bài viết "' . $request->postTitle . '" thành công!');
	}

	public function getEditPost($id){
		$tags = PostTag::all();
		$categories = PostCategory::all();
		$post = Post::find($id);

		$tagIds = DB::table('post_tag')->where('post_id',$id)->pluck('tag_id')->toArray();
		$Ids = "";
		if(count($tagIds)>0){
			foreach ($tagIds as $key => $tagId) {
				$Ids .=$tagId.",";
			}
		}
		
		return view('admin.post.edit_post',['tags' => $tags, 'optionDropdownCategories' => PostCategory::getDropdownOptions($categories,0,"",$post->category_id), 'post'=>$post,'tagIds'=>$Ids]);
	}
	public function postEditPost(PostRequest $request,$id){
		DB::table('post_tag')->where('post_id', $id)->delete();
		$post = Post::find($id);
		$this->savePost($request,$post);
		return redirect('admin-dashboard/posts')->with('status','Đã sửa bài viết "' . $post->post_title . '" thành công!');
	}
}
