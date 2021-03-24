@extends('front.master')
@section('canonical', url('lien-he'))
@section('title', $contact->seo_title)
@section('description', $contact->seo_description)

@section('insert_header_tag')
	<h1>{{$contact->h1_tag}}</h1>
	@php
		$h2_tags = explode (',', $contact->h2_tag);
		foreach($h2_tags as $h2_tag){
			echo '<h2>'.trim($h2_tag).'</h2>';
		}
		$h3_tags = explode (',', $contact->h3_tag);
		foreach($h3_tags as $h3_tag){
			echo '<h3>'.trim($h3_tag).'</h3>';
		}
	@endphp
@endsection

@section('content')
<div id="lienhe" class="container lienhe" style="margin-bottom: 30px;">
			<div class="title-dm"><span>Liên hệ với chúng tôi</span></div>
			<div class="col-md-12 text-center">
				<h3>{{$contact->title}}</h3>
				<p>{!!$contact->content!!}</div>
			<div class="col-md-6">
				@php
					$bando = explode(';',$contact->content_1);
				@endphp 
				@component('front._bando',['name'=>'lienhe','width'=>'100%','height'=>'450px','tieudegooglemap'=>$bando[0],'diachigooglemap'=>$bando[1],'hotlinegooglemap'=>$bando[2],'emailgooglemap'=>$bando[3],'latitude'=>$bando[4],'longitude'=>$bando[5],'info_window_status'=>1])
				@endcomponent
			</div>
			<div class="col-md-6">
				<form id="form-lien-he" role="form" action="" method="post">
					<div class="row">
					<input type="hidden" class="form-control" id="nguon" name="nguon" value="Trang liên hệ">
					<div class="form-group col-sm-6">
						<label for="name" class="h4">Họ tên</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
					</div>

					<div class="form-group col-sm-6">
						<label for="sdt" class="h4">Số điện thoại</label>
						<input type="text" class="form-control" id="sdt" name="sdt" placeholder="Enter phone" required>
					</div>

					<div class="form-group col-sm-12">
						<label for="email" class="h4">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
					</div>

					<div class="form-group col-sm-12">
						<label for="subject" class="h4">Tiêu Đề</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Tiêu đề..." required>
					</div>
					</div>
					<div class="form-group">
						<label for="message" class="h4 ">Nội dung</label>
						<textarea id="message" name="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
					</div>
					<button type="button" id="btn-form-submit" class="btn btn-success btn-lg pull-right " data-url="{{url('api/guilienhe')}}" >Gửi</button>
				</form>
				<div id="msgSubmit" class="h3 text-center" style="display: none; color: blue;">Gửi thành công. Chúng tôi sẽ hồi đáp đến quý khách ngay khi có thể. Cảm ơn quý khách, chúc sức khỏe và thành công!</div>
				<div id="msgError" class="h3 text-center" style="display: none; color: red;">Cảm phiền điền đầy đủ thông tin. Xin Cảm ơn!</div>
				</div>
</div>	
<script type="text/javascript">
	$('#btn-form-submit').click(function(event) {
		var _token = $('meta[name="csrf-token"]').attr('content');
		var flag = 0;
		$('#form-lien-he input').each(function(index, el) {
			if(!$(this).val() || $(this).val() == "")
				flag = 1;
		});
		if(flag == 1){
			$('#msgError').css('display', 'block').delay(4000).slideUp(800);
			return;
		}
		$.ajax({
			url: $(this).attr('data-url'),
			type: 'POST',
			data: { 
				_token: _token, 
				nguon: $('#nguon').val(),
				name: $('#name').val(),
				sdt: $('#sdt').val(),
				email: $('#email').val(),
				subject: $('#subject').val(),
				content: $('#message').val(), 
			},
			success: function success(data) {
				$('#msgSubmit').css('display', 'block').delay(3500).slideUp(800);
			}
		});  
	});
</script>
@endsection