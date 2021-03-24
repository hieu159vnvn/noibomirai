@php
	$segment = Request::segment(1);
	if (Request::segment(5)) {
		$segment = $segment.'/'.Request::segment(2).'/'.Request::segment(3);
	}
	elseif (Request::segment(4)) {
		if (Request::segment(4) == 'create') {
		$segment = $segment.'/'.Request::segment(2).'/'.Request::segment(3);
		}else{
		$segment = $segment.'/'.Request::segment(2).'/'.Request::segment(4);
		}
	}elseif (Request::segment(3)) {
		$segment = $segment.'/'.Request::segment(2).'/'.Request::segment(3);
	}elseif (Request::segment(2)) {
		$segment = $segment.'/'.Request::segment(2);
	}
@endphp
<input type="hidden" id="segment" value="{{$segment}}">
<nav id="menu">
	<div class="logo"><img width="150" src="{{url('images/admin/logo.png')}}"><br><a href=""><i class="globe icon"></i>{{\Request::ip()}}</a></div>
    <ul>
    	<li><a class="treeview-item" href="{{asset('/home')}}"><i class="circular home icon"></i>Trang chủ</a>
		</li>

		<li><a class="treeview-item" href="{{asset('hoso')}}"><i class="circular address book icon"></i>Học Viên</a>
			@permission('hoso-create')
    		<ul>
				<li><a class="treeview-item" href="{{asset('hoso/create')}}"> <i class="caret right icon"></i> Thêm mới</a></li>
				<li><a class="treeview-item" href="{{asset('hoso/source')}}"> <i class="caret right icon"></i> Xét nguồn học viên</a></li>
			</ul>
			@endpermission
		</li>
		@permission('nhanvien-list')
		<li><a class="treeview-item" href="{{asset('nhanvien')}}"><i class="circular users icon"></i>Nhân viên</a></li>
		@endpermission
		{{-- @permission('diemdanh-list')
		<li><a class="treeview-item" href="{{asset('daotao')}}"><i class="circular graduation cap icon"></i>Đào tạo</a>
			<ul>
				@permission('daotao-list')
				<li><a class="treeview-item" href="{{asset('daotao')}}"> <i class="caret right icon"></i> Danh sách lớp học</a></li>
				@endpermission
				<li><a class="treeview-item" href="{{asset('diemdanh/manage')}}"> <i class="caret right icon"></i> Quản lý Điểm danh</a></li>
				@permission('diemdanh-create')
				@php 
					$email = Auth::user()->email;
			        $giaovien = DB::table('nhanviens')->where('email',$email)->first();
			    @endphp
		        @if($giaovien)
			        @php
			            $dt = DB::table('daotaos')->where('gvcn',$giaovien->id)->orderBy('id', 'desc')->first();
					@endphp
		        	@if($dt)
						<li><a class="treeview-item" href="{{asset('diemdanh/'.$dt->id.'/add')}}"> <i class="caret right icon"></i> Điểm danh ngày {{date("d-m-Y")}}</a></li>
		        	@endif
				@endif
				@endpermission
			</ul>
		</li>
		@endpermission --}}
		@permission('diemdanh-list')
		<li><a class="treeview-item" href="{{asset('daotao')}}"><i class="circular graduation cap icon"></i>Đào tạo</a>
			<ul>
				@permission('daotao-list')
				<li><a class="treeview-item" href="{{asset('daotao')}}"> <i class="caret right icon"></i> Danh sách lớp học</a></li>
				@endpermission
				
				@permission('diemdanh-create')
				@php 
					$email = Auth::user()->email;
					$giaovien = DB::table('nhanviens')->where('email',$email)->first();
					if($giaovien)
			        {
						$dt = DB::table('daotaos')->where('gvcn',$giaovien->id)->orderBy('id', 'desc')->first();
						
					}
			    @endphp
		        
		        	@if(isset($dt))
						<li><a class="treeview-item" href="{{asset('daotao/manage-baocao/all')}}"> <i class="caret right icon"></i> Báo cáo tháng </a></li>{{-- bao cao danh gia --}}
		        	@endif
				@endpermission
				@role('Đào Tạo')
					<li><a class="treeview-item" href="{{asset('daotao/manage-baocao/all')}}"> <i class="caret right icon"></i> Quản lý báo cáo tháng </a></li>{{-- bao cao danh gia --}}
				@endrole
			</ul>
		</li>
		<li><a class="treeview-item" href="{{asset('diemdanh/manage')}}"><i class="circular graduation cap icon"></i>Điểm danh</a>
			<ul>
				@permission('diemdanh-create')
				<li><a class="treeview-item" href="{{asset('diemdanh/manage')}}"> <i class="caret right icon"></i> Quản lý Điểm danh</a></li>
				@if(isset($dt))
					<li><a class="treeview-item" href="{{asset('diemdanh/'.$dt->id.'/add')}}"> <i class="caret right icon"></i> Điểm danh ngày {{date("d-m-Y")}}</a></li>
				@endif
				@endpermission
			</ul>
		</li>
		@endpermission
		@permission('kitucxa')					
		<li><a class="treeview-item" ><i class="circular home cap icon"></i>Quản lý kí túc xá</a>
			<ul>
				<li><a class="treeview-item" href="/kitucxa/danhsachphong"> <i class="caret right icon"></i>Danh sách phòng</a></li>
				<li><a class="treeview-item" href="/kitucxa/danhsachhocvien"> <i class="caret right icon"></i>Danh sách học viên</a></li>
				<li><a class="treeview-item" href="/kitucxa/lichsu"> <i class="caret right icon"></i>Lịch sử</a></li>
			</ul>
		</li>
		@endpermission

		@permission('donhang-list')					
			<li><a class="treeview-item" href="{{asset('donhang')}}"><i class="circular clipboard list icon"></i>Đơn hàng</a></li>
		@endpermission
		@permission('doitac-list')			
			<li><a class="treeview-item" href="{{asset('doitac')}}"> <i class="circular handshake icon"></i> Danh sách Công ty</a></li>
		@endpermission
		@permission('nghiepdoan-list')
			<li><a class="treeview-item" href="{{asset('nghiepdoan')}}"> <i class="circular handshake icon"></i> Danh sách Nghiệp Đoàn</a></li>
		@endpermission
		@permission('chucvu-list')
			<li><a class="treeview-item" href="{{asset('chucvu')}}"><i class="circular sitemap icon"></i>Chức vụ</a></li>
		@endpermission
		@permission('nganhnghe-list')
			<li><a class="treeview-item" href="{{asset('nganhnghe')}}"><i class="circular briefcase icon"></i>Ngành nghề</a></li>
		@endpermission			
		<li><a class="treeview-item" href="{{asset('thongke')}}"><i class="circular chart line icon"></i>Thống kê</a></li>
		@role('admin')
		<li><a class="treeview-item" href="{{asset('users')}}"><i class="circular graduation cap icon"></i>Phân Quyền</a>
			<ul>
				<li><a class="treeview-item" href="{{asset('users/create')}}"> <i class="caret right icon"></i> Thêm Người dùng</a></li>
				<li><a class="treeview-item" href="{{asset('roles')}}"> <i class="caret right icon"></i> Thêm quyền</a></li>
			</ul>
		</li>
		@endrole
		{{-- <li><a class="treeview-item" href="{{asset('lichcongtac')}}"><i class="circular calendar icon"></i>Lịch công tác</a>
			<ul>
				<li><a class="treeview-item" href="{{asset('danhsachlich')}}"> <i class="caret right icon"></i> Danh sách </a></li>

			</ul>
		</li> --}}
@permission('vietbai')
	<li><a><i class="circular home cap icon"></i>MIRAIHUMAN.COM</a>
		<ul>
			<li><a class="treeview-item" href="{{asset('/logo')}}"> <i class="caret right icon"></i>Logo</a></li>
				<li><a class="treeview-item" href="{{asset('/menu')}}"> <i class="caret right icon"></i>Menu</a></li>

			<li><a class="treeview-item" href="{{asset('banner')}}"> <i class="caret right icon"></i>Banner</a></li>
			<li><a class="treeview-item" href="{{asset('dclienhe')}}"> <i class="caret right icon"></i>Địa chỉ liên hệ</a></li>
		<!-- 	<li><a class="treeview-item" href="{{asset('baiviet')}}"> <i class="caret right icon"></i>Bài viết</a></li> -->
			<li><a class="treeview-item" href="{{asset('gioithieu')}}"> <i class="caret right icon"></i>Giới thiệu</a></li>
			<li><a class="treeview-item" href="{{asset('tintuc')}}"> <i class="caret right icon"></i>Tin tức</a></li>
			<li><a class="treeview-item" href="{{asset('camnhan')}}"> <i class="caret right icon"></i>Cảm nhận học viên</a></li>
			{{-- <li><a class="treeview-item" href="{{asset('doitac-miraihuman')}}"> <i class="caret right icon"></i>Đối tác</a></li> --}}
			{{-- <li><a class="treeview-item" href="{{asset('dichvucat')}}"> <i class="caret right icon"></i>Danh mục dịch vụ</a></li> --}}
			{{-- <li><a class="treeview-item" href="{{asset('dichvu')}}"> <i class="caret right icon"></i>Dịch vụ</a></li> --}}
			<li><a class="treeview-item" href="{{asset('mangxahoi')}}"> <i class="caret right icon"></i>Mạng xã hội</a></li>
			<li><a class="treeview-item" href="{{asset('hoidap')}}"> <i class="caret right icon"></i>Hỏi đáp</a></li>
			<li><a class="treeview-item" href="{{asset('loaihoidap')}}"> <i class="caret right icon"></i>Loại hỏi đáp</a></li>
			<li><a class="treeview-item" href="{{asset('video')}}"> <i class="caret right icon"></i>Video</a></li>
			<li><a class="treeview-item" href="{{asset('hinhanh')}}"> <i class="caret right icon"></i>Hình ảnh</a></li>
			<li><a class="treeview-item" href="{{asset('donhangstt')}}"> <i class="caret right icon"></i>Trạng thái đơn hàng</a></li>
			<li><a class="treeview-item" href="{{asset('lienhe')}}"> <i class="caret right icon"></i>Liên hệ</a></li>
			<li><a class="treeview-item" href="{{asset('tuvan')}}"> <i class="caret right icon"></i>Tư vấn qua điện thoại</a></li>
			<li><a class="treeview-item" href="{{asset('truonghoc')}}"> <i class="caret right icon"></i>Trường học</a></li>
			<li><a class="treeview-item" href="{{asset('fbfooter')}}"> <i class="caret right icon"></i>Fan Page</a></li>
			{{-- <li><a class="treeview-item" href="{{asset('tuyendung')}}"> <i class="caret right icon"></i>Danh sách ứng viên</a></li> --}}
			<li><a class="treeview-item" href="{{asset('gioithieuhome')}}"> <i class="caret right icon"></i>Home-Gi&#7899;i thi&#7879; u</a></li>
			<li><a class="treeview-item" href="{{asset('daotaohome')}}"> <i class="caret right icon"></i>Home- Dao Tao</a></li>
			<li><a class="treeview-item" href="{{asset('dichvuhome')}}"> <i class="caret right icon"></i>Home- D&#7883;ch v&#7909;</a></li>
			<li><a class="treeview-item" href="{{asset('magazine')}}"> <i class="caret right icon"></i>Tạp chí</a></li>
			<li><a class="treeview-item" href="{{asset('bannerpage')}}"> <i class="caret right icon"></i>Hình ảnh ở các trang</a></li>
		</ul>
	</li>
	@endpermission
    </ul>
<script>
	$(document).ready(function(){
		var segment = $('#segment').val();
		var segmenturl = segment.split("/");
		$(".treeview-item").each(function() {
			var href = $(this).attr("href");
			var url = href.split("/");
			if(segmenturl[0] == url[3]){
			$(this).addClass('active');
		}
			if(segment == href){
				$(this).addClass('active');
			}
		});
		if (segment == "admin") {
			$(".dashboard").addClass('active');
		}
	});
</script>
</nav>
