@extends('admin.master')
@section('title', 'Xem chi tiết liên hệ')
@section('PageContent')
	
	<div class="ui two column centered grid wrap-content-header">
		<div id="content-header" class="thirteen wide column">
			<h1 class="ui header centered page-title">Liên hệ: {{$contact->subject}}</h1>
		</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Họ tên:</div>
		<div class="ten wide column">{{$contact->full_name}}</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Nguồn liên hệ:</div>
		<div class="ten wide column">{{$contact->source}}</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Địa chỉ:</div>
		<div class="ten wide column">{{$contact->address}}</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Điện thoại:</div>
		<div class="ten wide column">{{$contact->telephone}}</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Email:</div>
		<div class="ten wide column">{{$contact->email}}</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Nội dung:</div>
		<div class="ten wide column">{{$contact->content}}</div>
	</div>
	<div class="ui two column grid wrap-contact-detail">
		<div class="six wide right aligned column">Ngày liên hệ:</div>
		<div class="ten wide column">{{$contact->updated_at->format('H:i:s - d/m/Y')}}</div>
	</div>
	<div class="ui two centered column grid wrap-contact-detail">
		<a href="{{url('admin-dashboard/contacts')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Liên Hệ</a>
	</div>
				
	
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/post/tag/edit_tag.js')}}"></script>
@endsection