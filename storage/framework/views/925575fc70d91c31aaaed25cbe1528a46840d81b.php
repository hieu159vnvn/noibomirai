<?php
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
?>
<input type="hidden" id="segment" value="<?php echo e($segment); ?>">
<nav id="menu">
	<div class="logo"><img width="150" src="<?php echo e(url('images/admin/logo.png')); ?>"><br><a href=""><i class="globe icon"></i><?php echo e(\Request::ip()); ?></a></div>
    <ul>
    	<li><a class="treeview-item" href="<?php echo e(asset('/home')); ?>"><i class="circular home icon"></i>Trang chủ</a>
		</li>

		<li><a class="treeview-item" href="<?php echo e(asset('hoso')); ?>"><i class="circular address book icon"></i>Học Viên</a>
			<?php if (\Entrust::can('hoso-create')) : ?>
    		<ul>
				<li><a class="treeview-item" href="<?php echo e(asset('hoso/create')); ?>"> <i class="caret right icon"></i> Thêm mới</a></li>
				<li><a class="treeview-item" href="<?php echo e(asset('hoso/source')); ?>"> <i class="caret right icon"></i> Xét nguồn học viên</a></li>
			</ul>
			<?php endif; // Entrust::can ?>
		</li>
		<?php if (\Entrust::can('nhanvien-list')) : ?>
		<li><a class="treeview-item" href="<?php echo e(asset('nhanvien')); ?>"><i class="circular users icon"></i>Nhân viên</a></li>
		<?php endif; // Entrust::can ?>
		
		<?php if (\Entrust::can('diemdanh-list')) : ?>
		<li><a class="treeview-item" href="<?php echo e(asset('daotao')); ?>"><i class="circular graduation cap icon"></i>Đào tạo</a>
			<ul>
				<?php if (\Entrust::can('daotao-list')) : ?>
				<li><a class="treeview-item" href="<?php echo e(asset('daotao')); ?>"> <i class="caret right icon"></i> Danh sách lớp học</a></li>
				<?php endif; // Entrust::can ?>
				
				<?php if (\Entrust::can('diemdanh-create')) : ?>
				<?php 
					$email = Auth::user()->email;
					$giaovien = DB::table('nhanviens')->where('email',$email)->first();
					if($giaovien)
			        {
						$dt = DB::table('daotaos')->where('gvcn',$giaovien->id)->orderBy('id', 'desc')->first();
						
					}
			    ?>
		        
		        	<?php if(isset($dt)): ?>
						<li><a class="treeview-item" href="<?php echo e(asset('daotao/manage-baocao/all')); ?>"> <i class="caret right icon"></i> Báo cáo tháng </a></li>
		        	<?php endif; ?>
				<?php endif; // Entrust::can ?>
				<?php if (\Entrust::hasRole('Đào Tạo')) : ?>
					<li><a class="treeview-item" href="<?php echo e(asset('daotao/manage-baocao/all')); ?>"> <i class="caret right icon"></i> Quản lý báo cáo tháng </a></li>
				<?php endif; // Entrust::hasRole ?>
			</ul>
		</li>
		<li><a class="treeview-item" href="<?php echo e(asset('diemdanh/manage')); ?>"><i class="circular graduation cap icon"></i>Điểm danh</a>
			<ul>
				<?php if (\Entrust::can('diemdanh-create')) : ?>
				<li><a class="treeview-item" href="<?php echo e(asset('diemdanh/manage')); ?>"> <i class="caret right icon"></i> Quản lý Điểm danh</a></li>
				<?php if(isset($dt)): ?>
					<li><a class="treeview-item" href="<?php echo e(asset('diemdanh/'.$dt->id.'/add')); ?>"> <i class="caret right icon"></i> Điểm danh ngày <?php echo e(date("d-m-Y")); ?></a></li>
				<?php endif; ?>
				<?php endif; // Entrust::can ?>
			</ul>
		</li>

		<?php endif; // Entrust::can ?>
		<?php if (\Entrust::can('donhang-list')) : ?>					
			<li><a class="treeview-item" href="<?php echo e(asset('donhang')); ?>"><i class="circular clipboard list icon"></i>Đơn hàng</a></li>
		<?php endif; // Entrust::can ?>
		<?php if (\Entrust::can('doitac-list')) : ?>			
			<li><a class="treeview-item" href="<?php echo e(asset('doitac')); ?>"> <i class="circular handshake icon"></i> Danh sách Công ty</a></li>
		<?php endif; // Entrust::can ?>
		<?php if (\Entrust::can('nghiepdoan-list')) : ?>
			<li><a class="treeview-item" href="<?php echo e(asset('nghiepdoan')); ?>"> <i class="circular handshake icon"></i> Danh sách Nghiệp Đoàn</a></li>
		<?php endif; // Entrust::can ?>
		<?php if (\Entrust::can('chucvu-list')) : ?>
			<li><a class="treeview-item" href="<?php echo e(asset('chucvu')); ?>"><i class="circular sitemap icon"></i>Chức vụ</a></li>
		<?php endif; // Entrust::can ?>
		<?php if (\Entrust::can('nganhnghe-list')) : ?>
			<li><a class="treeview-item" href="<?php echo e(asset('nganhnghe')); ?>"><i class="circular briefcase icon"></i>Ngành nghề</a></li>
		<?php endif; // Entrust::can ?>			
		<li><a class="treeview-item" href="<?php echo e(asset('thongke')); ?>"><i class="circular chart line icon"></i>Thống kê</a></li>
		<?php if (\Entrust::hasRole('admin')) : ?>
		<li><a class="treeview-item" href="<?php echo e(asset('users')); ?>"><i class="circular graduation cap icon"></i>Phân Quyền</a>
			<ul>
				<li><a class="treeview-item" href="<?php echo e(asset('users/create')); ?>"> <i class="caret right icon"></i> Thêm Người dùng</a></li>
				<li><a class="treeview-item" href="<?php echo e(asset('roles')); ?>"> <i class="caret right icon"></i> Thêm quyền</a></li>
			</ul>
		</li>
		<?php endif; // Entrust::hasRole ?>
		<li><a class="treeview-item" href="<?php echo e(asset('lichcongtac')); ?>"><i class="circular calendar icon"></i>Lịch công tác</a>
			<ul>
				<li><a class="treeview-item" href="<?php echo e(asset('danhsachlich')); ?>"> <i class="caret right icon"></i> Danh sách </a></li>

			</ul>
		</li>
<?php if (\Entrust::can('vietbai')) : ?>
	<li><a><i class="circular home cap icon"></i>MIRAIHUMAN.COM</a>
		<ul>
			<li><a class="treeview-item" href="<?php echo e(asset('/logo')); ?>"> <i class="caret right icon"></i>Logo</a></li>
				<li><a class="treeview-item" href="<?php echo e(asset('/menu')); ?>"> <i class="caret right icon"></i>Menu</a></li>

			<li><a class="treeview-item" href="<?php echo e(asset('banner')); ?>"> <i class="caret right icon"></i>Banner</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('dclienhe')); ?>"> <i class="caret right icon"></i>Địa chỉ liên hệ</a></li>
		<!-- 	<li><a class="treeview-item" href="<?php echo e(asset('baiviet')); ?>"> <i class="caret right icon"></i>Bài viết</a></li> -->
			<li><a class="treeview-item" href="<?php echo e(asset('gioithieu')); ?>"> <i class="caret right icon"></i>Giới thiệu</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('tintuc')); ?>"> <i class="caret right icon"></i>Tin tức</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('camnhan')); ?>"> <i class="caret right icon"></i>Cảm nhận học viên</a></li>
			
			
			
			<li><a class="treeview-item" href="<?php echo e(asset('mangxahoi')); ?>"> <i class="caret right icon"></i>Mạng xã hội</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('hoidap')); ?>"> <i class="caret right icon"></i>Hỏi đáp</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('loaihoidap')); ?>"> <i class="caret right icon"></i>Loại hỏi đáp</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('video')); ?>"> <i class="caret right icon"></i>Video</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('hinhanh')); ?>"> <i class="caret right icon"></i>Hình ảnh</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('donhangstt')); ?>"> <i class="caret right icon"></i>Trạng thái đơn hàng</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('lienhe')); ?>"> <i class="caret right icon"></i>Liên hệ</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('tuvan')); ?>"> <i class="caret right icon"></i>Tư vấn qua điện thoại</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('truonghoc')); ?>"> <i class="caret right icon"></i>Trường học</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('fbfooter')); ?>"> <i class="caret right icon"></i>Fan Page</a></li>
			
			<li><a class="treeview-item" href="<?php echo e(asset('gioithieuhome')); ?>"> <i class="caret right icon"></i>Home-Gi&#7899;i thi&#7879;u</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('daotaohome')); ?>"> <i class="caret right icon"></i>Home- Dao Tao</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('dichvuhome')); ?>"> <i class="caret right icon"></i>Home- D&#7883;ch v&#7909;</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('magazine')); ?>"> <i class="caret right icon"></i>Tạp chí</a></li>
			<li><a class="treeview-item" href="<?php echo e(asset('bannerpage')); ?>"> <i class="caret right icon"></i>Hình ảnh ở các trang</a></li>
		</ul>
	</li>
	<?php endif; // Entrust::can ?>
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
