<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactController extends Controller
{
    public function getContacts(){
		$contacts = Contact::latest()->get();
		return view('admin.contact.contact',['contacts'=>$contacts]);
	}
	public function getDeleteContact($id){
		Contact::destroy($id);

		return redirect()->back()->with('status','Đã xóa liên hệ thành công!');
	}

	public function getEditContact($id){
		$contact = Contact::find($id);
		$contact->status = 0;
		$contact->save();
		return view('admin.contact.edit_contact',['contact'=>$contact]);
	}
	public function postEditPostTag(PostTagRequest $request, $id){
		$tag = PostTag::find($id);
		$this->saveTag($request,$tag);

		return redirect('admin-dashboard/posttags')->with('status','Đã sửa thẻ "' . $request->tagName . '" thành công!');
	}
}
