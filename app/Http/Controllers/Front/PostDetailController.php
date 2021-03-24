<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\PostRequest;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Post;
use Session;

class PostDetailController extends Controller
{
	public function getPostDetail($slug){
		$post = Post::where('post_slug',$slug)->first();
		return view('front.postdetail',['post'=>$post]);
	}
    
}
