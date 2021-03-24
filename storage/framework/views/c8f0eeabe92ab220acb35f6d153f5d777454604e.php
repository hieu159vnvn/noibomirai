<?php $__env->startSection('title', 'Sửa Học Viên'); ?>
<?php $__env->startSection('PageContent'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/croper/croppie.css')); ?>">
<script src="<?php echo e(url('libraries/croper/croppie.js')); ?>"></script>

	<h2 class="ui header center aligned">
    HỒ SƠ HỌC VIÊN 
    <div class="sub header">
      Chỉnh sửa : <?php echo e($hoso->hoten); ?>

    </div>
	</h2>
	
	<?php if(session('error')): ?>
	  	<div class="ui error message">
		  	<i class="close icon"></i>
		  	<div class="header">
		    	Thông Báo !
		  	</div>
		  	<p><?php echo e(session('error')); ?></p>
		</div>
	<?php else: ?>
		<?php if(session('status')): ?>
		  	<div class="ui message">
			  	<i class="close icon"></i>
			  	<div class="header">
			    	Thông Báo !
			  	</div>
			  	<p><?php echo e(session('status')); ?></p>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<form class="ui form" action="" method="post" name="form_1" autocomplete="off" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>

		<div class="ui segments">
	        <div class="ui segment">

	          <div class="ui secondary menu">
	          	<div class="left menu">
					<a class="item">
                    <a href="<?php echo e(url('/hoso/testmiss')); ?>" class="ui labeled icon red button"><i class="arrow left icon"></i>Kiểm Tra</a>
                  </a>
	          	</div>
	              <div class="right menu">
			        <a href="<?php echo e(url('/hoso')); ?>" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
				<button type="submit" class="ui labeled icon button green"><i class="save icon"></i>Lưu</button>
	              </div>
	            </div>
	     	</div>
	     	<div class="ui segment">
				<div class="ui column centered main-content">	
					<div class="column">
						<div class="ui top attached tabular menu">
						  <a class="item active" data-tab="soyeulylich">Sơ yếu lý lịch</a>						  
						  <a class="item" data-tab="thongtin">Thông tin bổ sung</a>
						  <a class="item" data-tab="kitucxa">Kí túc xá</a>
						</div>
			
						<div class="ui bottom attached tab segment active" data-tab="soyeulylich">			
							
								<h3 class="ui header centered blue">SƠ YẾU LÝ LỊCH</h3>

								<?php 
									$timestamp_image = strtotime($hoso->created_at);
									$year_image = date("Y", $timestamp_image);
									$month_image = date("m", $timestamp_image);
								?>
								<?php if(strlen($hoso->hinhanh) >= 100): ?>
									<div class="ui steps">
										<div class="step">
											<img width="70" id="upload-demo-img" <?php if($hoso->hinhanh): ?> src="<?php echo e($hoso->hinhanh); ?>" <?php else: ?> src="/images/admin/avatar.png"  <?php endif; ?>>
											<input type="hidden" id="feature-image" name="featureImage" value="<?php echo e($hoso->hinhanh); ?>">									
										</div>
									</div>
								<?php else: ?>
									<div class="ui steps">
										<div class="step">
											<img width="70" id="upload-demo-img" <?php if($hoso->hinhanh): ?> src="<?php echo e('/hocviens/'.$year_image.'/'.$month_image.'/'.$hoso->hinhanh); ?>?rand=<?php echo e(md5(time())); ?>" <?php else: ?> src="/images/admin/avatar.png"  <?php endif; ?>>
											<input type="hidden" id="feature-image" name="featureImage" value="<?php echo e($hoso->hinhanh); ?>">									
										</div>
									</div>
								<?php endif; ?>
								<div class="ui modal mini modal-img-upload">
									<div class="header">Thay ảnh đại diện</div>
								    <div class="content">
								    	<div class="ui stackable grid">										
										    <div id="upload-demo" style="width:350px;">	
										   	</div>									     
																				 
										</div>
										<input type="file" id="upload">
								  	</div>
							     	<div class="actions"> 							    
								      	<a class="ui labeled icon button blue done_image"><i class="check icon"></i>Đồng ý</a>
										<a class="ui labeled icon button cancle-image"><i class="x icon"></i>Hủy</a>
									</div>
								</div>
								
							   	<script type="text/javascript">									
							   		$('#upload-demo-img').on('click',function(){
							   			$(".modal-img-upload").modal('show');
							   		});					   		
							   		$uploadCrop = $('#upload-demo').croppie({
									    enableExif: true,
									    viewport: {
									      width:170,
									      height:216,
									      type:'square'
									    },
									    boundary:{
									      width:250,
									      height:250,
									    }
									});
									$('.cr-image').attr('src','/images/admin/avatar.png');
									$('.cr-image').attr('width','250');
							   		$('#upload').on('change', function () { 
										var reader = new FileReader();
									    reader.onload = function (e) {
									    	$uploadCrop.croppie('bind', {
									    		url: e.target.result
									    	}).then(function(){

									    	});									    	
									    }
									    reader.readAsDataURL(this.files[0]);	
									});
									$('.done_image').click(function(){
									    var data = $uploadCrop.croppie('result', {
									      type: 'canvas',
									      size: 'viewport'
									    }).then(function(response){
											$('#feature-image').attr('value',response);	
											$('#upload-demo-img').prop('src',response);	
											$(".modal-img-upload").modal('hide');

										});
								    });
								    $('.cancle-image').click(function(){
								    	$(".modal-img-upload").modal('hide');
								    });
							   	</script>
								<h4 class="ui dividing header centered">THÔNG TIN CÁ NHÂN</h4>
								<div class="field thongtin">			
								<div class="four fields">
									<div class="field">
										<label>Họ và tên (*)</label>
										<div class="ui input left icon">							
										<i class="user icon"></i>
										<input type="text" name="hoten" value="<?php echo e($hoso->hoten); ?>" required>
										</div>
									</div>
									<div class="field">
										<label>Ngày sinh (*)</label>
										<div class="ui calendar">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input id="ngaysinh" type="text" name="ngaysinh" value="<?php echo e(date_format(date_create($hoso->ngaysinh), "d-m-Y")); ?>" required>
										    </div>
										</div>
									</div>
									
									<div class="field <?php if($hoso->dienthoai == null): ?> error <?php endif; ?>">
										<label>Điện thoại (*)</label>
										<div class="ui input left icon">
											<i class="mobile alternate icon"></i>
											<input type="text" id="phone" name="dienthoai" value="<?php echo e($hoso->dienthoai); ?>">
										</div>
									</div>
									<div class="field <?php if($hoso->dtnguoithan == null): ?> error <?php endif; ?>">
										<label>ĐT người thân</label>
										<div class="ui input left icon">
											<i class="mobile alternate icon"></i>
											<input type="text" id="phone1" name="dtnguoithan" value="<?php echo e($hoso->dtnguoithan); ?>">
										</div>
									</div>
								</div>
								<div class="three fields">
									<div class="field">
										<div class="two fields">
											<div class="eleven wide field  <?php if($hoso->noisinh == null): ?> error <?php endif; ?>">
												<label>Nơi sinh (*)</label>
												<div class="ui input left icon">
													<i class="map marker alternate icon"></i>
													<input type="text" name="noisinh" value="<?php echo e($hoso->noisinh); ?>">
												</div>
											</div>
											<div class="five wide field  <?php if($hoso->mien == null): ?> error <?php endif; ?>">
												<label>Miền</label>
												 <select name="mien">
												 	<option value="<?php echo e($hoso->mien); ?>"><?php echo e($hoso->mien); ?></option>						 
										      		<option value="Bắc">Bắc</option>
										      		<option value="Trung">Trung</option>
										      		<option value="Nam">Nam</option>						      	
											    </select>
											</div>
										</div>
									</div>
								</div>
								<div class="fields">
									<?php if($hoso->diachi): ?>
									<div class="sixteen wide field  <?php if($hoso->diachi == null): ?> error <?php endif; ?>">
										<label>Địa chỉ hộ khẩu (*)</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="diachi" value="<?php echo e($hoso->diachi); ?>">
										</div>
									</div>	
									<div class="four wide field">
										<label>Tỉnh thành</label>
										 <select name="tinhthanh">
									      	<?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      		<?php if($ct->id == $hoso->tinhthanh): ?>
									      		<option value="<?php echo e($ct->id); ?>"><?php echo e($ct->ten); ?></option>
									      		<?php endif; ?>
									      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									      	<?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      		<option value="<?php echo e($ct->id); ?>"><?php echo e($ct->ten); ?></option>
									      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									    </select>
									</div>
									<?php else: ?>
									<div class="four wide field  <?php if($hoso->dchk_dc == null): ?> error <?php endif; ?>">
										<label>địa chỉ (ấp/khu phố)</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="dchk_dc" value="<?php echo e($hoso->dchk_dc); ?>">
										</div>
									</div>
									<div class="four wide field  <?php if($hoso->dchk_xa == null): ?> error <?php endif; ?>">
										<label>Phường/xã</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="dchk_xa" value="<?php echo e($hoso->dchk_xa); ?>">
										</div>
									</div>
									<div class="four wide field  <?php if($hoso->dchk_huyen == null): ?> error <?php endif; ?>">
										<label>Quận/Huyện</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="dchk_huyen" value="<?php echo e($hoso->dchk_huyen); ?>">
										</div>
									</div>
									<div class="four wide field">
										<label>Tỉnh thành</label>
										 <select name="tinhthanh">
									      	<?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      		<?php if($ct->id == $hoso->tinhthanh): ?>
									      		<option value="<?php echo e($ct->id); ?>"><?php echo e($ct->ten); ?></option>
									      		<?php endif; ?>
									      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									      	<?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									      		<option value="<?php echo e($ct->id); ?>"><?php echo e($ct->ten); ?></option>
									      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									    </select>
									</div>
									<?php endif; ?>
								</div>
								<div class="four fields">
									<div class="field ">
										<label>Giới tính</label>
									    <select name="gioitinh">
									    	<?php if($hoso->gioitinh == 0): ?>
									    		<option value="0">Nữ</option>
									    	<?php else: ?>	
									    		<option value="1">Nam</option>
									    	<?php endif; ?>
										     	<option value="1">Nam</option>
										     	<option value="0">Nữ</option>
									    </select>						    
									</div>
									<div class="field <?php if($hoso->honnhan == null): ?> error <?php endif; ?>">
										<label>Hôn nhân</label>
										<div class="ui input left icon">
											<i class="heart icon"></i>
											<input type="text" name="honnhan" value="<?php echo e($hoso->honnhan); ?>">
										</div>
									</div>
									<div class="field <?php if($hoso->benhan == null): ?> error <?php endif; ?>">
										<label>Bệnh án</label>
										<div class="ui input left icon">
											<i class="heartbeat icon"></i>
											<input type="text" name="benhan" value="<?php echo e($hoso->benhan); ?>">
										</div>
									</div>
									<div class="field <?php if($hoso->tongiao == null): ?> error <?php endif; ?>">
										<label>Tôn giáo</label>
										<div class="ui input left icon">
											<i class="balance scale icon"></i>
											<input type="text" name="tongiao" value="<?php echo e($hoso->tongiao); ?>">
										</div>
									</div>
								</div>
								<div class="five fields">
									<div class="field <?php if($hoso->chieucao == null): ?> error <?php endif; ?>">
										<label>Chiều cao</label>						
										<div class="ui right labeled input">
											<input type="number" name="chieucao" value="<?php echo e($hoso->chieucao); ?>">
											<div class="ui basic label">
										    cm
										  	</div>
									 	</div>
									</div>
									<div class="field <?php if($hoso->cannang == null): ?> error <?php endif; ?>">
										<label>Cân nặng</label>
										<div class="ui right labeled input">
											<input type="number" name="cannang" value="<?php echo e($hoso->cannang); ?>">
											<div class="ui basic label">
										    kg
										  	</div>
									 	</div>						
									</div>	
									<div class="field <?php if($hoso->nhommau == null): ?> error <?php endif; ?>">
										<label>Nhóm máu</label>
										<select name="nhommau">
											<?php if($hoso->nhommau == 'A'): ?>
												<option value="A">A</option>
											<?php elseif($hoso->nhommau == 'B'): ?>
												<option value="B">B</option>
											<?php elseif($hoso->nhommau == 'AB'): ?>
												<option value="AB">AB</option>
											<?php elseif($hoso->nhommau == 'O'): ?>
												<option value="O">O</option>
											<?php endif; ?>
											<option value=""></option>											
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="AB">AB</option>
											<option value="O">O</option>
										</select>
									</div>				
									<div class="field <?php if($hoso->mattrai == null): ?> error <?php endif; ?>">
										<label>Thị lực (trái)</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="mattrai" value="<?php echo e($hoso->mattrai); ?>">
										</div>
									</div>
									<div class="field <?php if($hoso->matphai == null): ?> error <?php endif; ?>">
										<label>Thị lực (phải)</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="matphai" value="<?php echo e($hoso->matphai); ?>">
										</div>
									</div>
								</div>
							</div>	
								<h4 class="ui dividing header centered">TAY THUẬN</h4>
								<div class="four fields taythuan">
								    <div class="field">
								    	<div class="ui labeled input">
											  <div class="ui label">
											  Công việc
											  </div>
									        <select name="congviec">
									        	<?php if($hoso->congviec == 0): ?>
									        		<option value="0">Phải</option>
									        	<?php else: ?>
									        		<option value="1">Trái</option>
									        	<?php endif; ?>
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								    <div class="field">
								    	<div class="ui labeled input">
											<div class="ui label">
											Đũa
											</div>
									        <select name="dua">
									        	<?php if($hoso->dua == 0): ?>
									        		<option value="0">Phải</option>
									        	<?php else: ?>
									        		<option value="1">Trái</option>
									        	<?php endif; ?>
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								    <div class="field">
								    	<div class="ui labeled input">
											<div class="ui label">
											  Kéo
											</div>
									        <select name="keo">
									        	<?php if($hoso->keo == 0): ?>
									        		<option value="0">Phải</option>
									        	<?php else: ?>
									        		<option value="1">Trái</option>
									        	<?php endif; ?>
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								    <div class="field">
								    	<div class="ui labeled input">
											<div class="ui label">
											Viết
											</div>
									        <select name="viet">
									        	<?php if($hoso->viet == 0): ?>
									        		<option value="0">Phải</option>
									        	<?php else: ?>
									        		<option value="1">Trái</option>
									        	<?php endif; ?>
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								</div>
								<h4 class="ui dividing header centered">QUÁ TRÌNH HỌC TẬP</h4>
								<div id="hoctap" data-count="<?php echo e(count($hoctap)+1); ?>">
								<div class="three fields " >
									<div class="field">
										<label>Thời gian học</label>
									</div>
									<div class="field">
										<label>Tên trường</label>
									</div>
									<div class="field">
										<label>Địa chỉ trường</label>
									</div>
								</div>
								<?php $__currentLoopData = $hoctap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ht): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div id="hoctap-<?php echo e($key+1); ?>" class="three fields " style=" margin: 0em -0.5em;">
									<div class="field ">
										<div class="two fields">
											<div class="field">
												<div class="ui calendar">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input class="thoigianhocbd" type="text"  name="thoigianhocbd[]" value="<?php echo e($ht->thoigianbd); ?>" >
												    </div>
											    </div> 
										    </div>												
											<div class="field">
												<div class="ui calendar" id="thoigiankt">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhockt" name="thoigianhockt[]" value="<?php echo e($ht->thoigiankt); ?>">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="building icon"></i>
											<input type="text" name="tentruong[]" value="<?php echo e($ht->tentruong); ?>">
										</div>	
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]" value="<?php echo e($ht->diachi); ?>">
										</div>
									</div>
									<i class="trash alternate icon red trash_hoctap"></i>

								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<div id="hoctap-<?php echo e(count($hoctap) + 1); ?>" class="three fields <?php if(count($hoctap)<=0): ?> error <?php endif; ?>" style=" margin: 0em -0.5em;">
									<div class="field ">	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" class="thoigianbd">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar" id="thoigiankt">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhockt" name="thoigianhockt[]">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="building icon"></i>
											<input type="text" name="tentruong[]">
										</div>	
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]">
										</div>
									</div>
									<i class="plus icon blue add_truong"></i>
								</div> 
								</div>
								<h4 class="ui dividing header centered">QUÁ TRÌNH LÀM VIỆC</h4>
								<div id="congviec" data-count="<?php echo e(count($lamviec)); ?>">
									<div class="three fields">
										<div class="field">
											<label>Thời gian làm việc</label>
										</div>
										<div class="field">
											<label>Tên công ty</label>
										</div>
										<div class="field">
											<label>Nội dung công việc</label>
										</div>
									</div> 
									<?php $__currentLoopData = $lamviec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div id="congviec-<?php echo e($key+1); ?>" class="three fields" style=" margin: 0em -0.5em;">
											<div class="field">	
												<div class="two fields">
													<div class="field">
														<div class="ui calendar" id="thoigianlamviecbd-<?php echo e($key+1); ?>">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamviecbd" name="thoigianlamviecbd[]" value="<?php echo e($lv->thoigianbd); ?>">
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar" id="thoigianlamvieckt-<?php echo e($key+1); ?>">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamvieckt" name="thoigianlamvieckt[]" value="<?php echo e($lv->thoigiankt); ?>">
														    </div>
													    </div> 
													</div>
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="building icon"></i>
													<input type="text" name="tencongty[]" value="<?php echo e($lv->tencongty); ?>">
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="briefcase icon"></i>
													<input type="text" name="ndcongviec[]" value="<?php echo e($lv->congviec); ?>">
												</div>
											</div>
											<i class="trash alternate icon red trash_congviec"></i>
										</div>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<div id="congviec-<?php echo e(count($lamviec)+1); ?>" class="three fields  <?php if(count($lamviec) <=0): ?> error <?php endif; ?>" style=" margin: 0em -0.5em;">
											<div class="field">	
												<div class="two fields">
													<div class="field">
														<div class="ui calendar" id="thoigianlamviecbd-<?php echo e(count($lamviec)+1); ?>">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamviecbd" name="thoigianlamviecbd[]">
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar" id="thoigianlamvieckt-<?php echo e(count($lamviec)+1); ?>">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamvieckt" name="thoigianlamvieckt[]">
														    </div>
													    </div> 
													</div>
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="building icon"></i>
													<input type="text" name="tencongty[]">
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="briefcase icon"></i>
													<input type="text" name="ndcongviec[]">
												</div>
											</div>
											<i class="plus icon blue add_congviec"></i>
										</div>
								</div>

								<h4 class="ui dividing header centered">NGOẠI NGỮ</h4>
								<div class="three fields ngoaingu">
								    <div class="field">
								    	<label>Anh ngữ</label>
								        <select name="anhngu">
								        	<?php if($hoso->anhngu == 0): ?>
									        	<option value="0">Không</option>
											<?php elseif($hoso->anhngu == 1): ?>
									        	<option value="1">Bằng A</option>
									        <?php elseif($hoso->anhngu == 2): ?>
									        	<option value="2">Bằng B</option>
									        <?php elseif($hoso->anhngu == 3): ?>	
									        	<option value="3">Bằng C</option>						    
									        <?php endif; ?>
									        <option value="0">Không</option>
											<option value="1">Bằng A</option>
											<option value="2">Bằng B</option>
											<option value="3">Bằng C</option>
										</select>
								    </div>
								    <div class="field  <?php if($hoso->nhatngu == null): ?> error <?php endif; ?>">
								    	<label>Nhật ngữ</label>
								        <input type="text" name="nhatngu" value="<?php echo e($hoso->nhatngu); ?>">
								    </div>
								    <div class="field">
								    	<label>Khác</label>
								    	<div class="ui input left icon">
								    		<i class="language icon"></i>
								        	<input type="text" name="ngoaingukhac" value="<?php echo e($hoso->ngoaingukhac); ?>">
								        </div>
								    </div>
								</div>
								<div class="inline fields">
								    <label>Đã từng đi tới Nhật:</label>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="datungtoinhat" value="1" <?php if($hoso->datungtoinhat == 1): ?> checked <?php endif; ?> >
								        <label><i class="check green icon"></i> Có</label>
								      </div>
								    </div>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="datungtoinhat" value="0" <?php if($hoso->datungtoinhat == 0): ?> checked <?php endif; ?> >
								        <label><i class="close red icon"></i> Không</label>
								      </div>
								    </div>
								    <div class="field"></div>
								</div>
								
								<div class="inline fields">
									<label>Có người thân tại Nhật:</label>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input id="conguoithan" type="radio" name="conguoithantainhat" value="1" <?php if($hoso->conguoithantainhat == 1): ?> checked <?php endif; ?>>
								        <label><i class="check green icon"></i> Có</label>
								      </div>
								    </div>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input id="konguoithan" type="radio" name="conguoithantainhat" value="0" <?php if($hoso->conguoithantainhat == 0): ?> checked <?php endif; ?>>
								        <label><i class="close red icon"></i> Không</label>
								      </div>
								    </div>
								</div>
								<div id="ttnguoithan" data-count="<?php echo e(count($nguoithan) + 1); ?>" <?php if(count($nguoithan) <= 0): ?> style="display: none" <?php endif; ?>>
									
									<?php $__currentLoopData = $nguoithan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div id="ttnguoithan-<?php echo e($key + 1); ?>" class="three fields">
											<div class="field">
												<input type="text" name="hotennguoithan[]" value="<?php echo e($nt->hoten); ?>">
											</div>
											<div class="field">
												<input type="text" name="tuoinguoithan[]" value="<?php echo e($nt->tuoi); ?>">
											</div>
											<div class="field">
												<input type="text" name="quanhenguoithan[]" value="<?php echo e($nt->quanhe); ?>">
											</div>
											<i class="trash alternate icon red trash_icon"></i>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<div id="ttnguoithan-<?php echo e(count($nguoithan) + 1); ?>" class="three fields">
										<div class="field">
											<label>Họ tên</label>
											<input type="text" name="hotennguoithan[]" value="<?php echo e(old('hotennguoithan')); ?>">
										</div>
										<div class="field">
											<label>Tuổi</label>
											<input type="text" name="tuoinguoithan[]" value="<?php echo e(old('tuoinguoithan')); ?>" >
										</div>
										<div class="field">
											<label>Quan hệ</label>
											<input type="text" name="quanhenguoithan[]" value="<?php echo e(old('tuoinguoithan')); ?>" >
										</div>
										<div class="icon_action">
											<i class="plus icon blue add_plus"></i>
										</div>
									</div>
									
								</div>
								<h4 class="ui dividing header centered">THỰC TẬP KỸ NĂNG Ở NHẬT</h4>
								<div class="two fields thuctap">
									<div class="field  <?php if($hoso->mucdich == null): ?> error <?php endif; ?>">
										<label>Mục đích đi Nhật</label>
										<textarea rows="3" name="mucdich"><?php echo e($hoso->mucdich); ?></textarea>
									</div>
									<div class="field  <?php if($hoso->muctieu == null): ?> error <?php endif; ?>">
										<label>Mục tiêu sau khi về nước</label>
										<textarea rows="3" name="muctieu"><?php echo e($hoso->muctieu); ?></textarea>
									</div>
								</div>
								<div class="two fields">
									<div class="field <?php if($hoso->sotientrenthang == null): ?> error <?php endif; ?>">
										<label>Số tiện dự định tiết kiệm mỗi tháng tại Nhật</label>
										<div class="ui right labeled input">
											<label for="amount" class="ui label">$</label>
												<input type="text" id="sotienthang" name="sotientrenthang" value="<?php echo e($hoso->sotientrenthang); ?>">	
											<div class="ui dropdown label">
											    <div class="text">VNĐ</div>
											</div>
									 	</div>	
									</div>
									<div class="field <?php if($hoso->sotientrennam == null): ?> error <?php endif; ?>">
										<label>Số tiền dự định tiết kiệm 3 năm tại Nhật</label>							
										<div class="ui right labeled input">
												<label for="amount" class="ui label">$</label>									
												<input id="sotiennam" type="text" name="sotientrennam" value="<?php echo e($hoso->sotientrennam); ?>">
											<div class="ui dropdown label">
											    <div class="text">VNĐ</div>
											</div>
									 	</div>	
									</div>
								</div>
								<h4 class="ui dividing header centered">KHÁC</h4>
								<div class="two fields khac">
									<div class="field">
										<div class="inline fields">
											<label>Bằng lái:</label>
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input type="radio" name="banglai" value="1" <?php if($hoso->banglai == 1): ?> checked <?php endif; ?>> 
										        <label><i class="check green icon"></i> Có</label>
										      </div>
										    </div>							   
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input type="radio" name="banglai" value="0" <?php if($hoso->banglai == 0): ?> checked <?php endif; ?>>
										        <label><i class="close red icon"></i> Không</label>
										      </div>
										    </div>
										</div>
									</div>
									<div class="field">
										<div class="inline fields">
											<label>Loại xe:</label>
											<div class="field">
											    <div class="ui checkbox">
												  <input type="checkbox" name="xemay" <?php if($hoso->xemay == 1): ?> checked <?php endif; ?>>
												  <label><i class="motorcycle icon"></i> Xe máy</label>
												</div>							
												<div class="ui checkbox">
												  <input type="checkbox" name="oto" <?php if($hoso->oto == 1): ?> checked <?php endif; ?>>
												  <label><i class="car icon"></i> Ôtô</label>
												</div>								
												<div class="ui checkbox">
												  <input type="checkbox" id="xekhac" name="khac" <?php if($hoso->xekhac != '' || $hoso->xekhac != null): ?> checked <?php endif; ?>>
												  <label> Khác</label>
												</div>
												<input style="width: 130px;" type="text" name="xekhac" value="<?php echo e($hoso->xekhac); ?>">
											</div>
										</div>
									</div>
									<script type="text/javascript">
											var xekhac =  document.getElementById('xekhac');
											if(xekhac.checked){
												 $("input[name='xekhac']").css('display','inline-block');
											}
											else{
							                    $("input[name='xekhac']").css('display','none');
							                    $("input[name='xekhac']").val('');
							                }
										document.getElementById('xekhac').onclick = function(e){
							                if (this.checked){
							                    $("input[name='xekhac']").css('display','inline-block');
							                }
							                else{
							                    $("input[name='xekhac']").css('display','none');
							                    $("input[name='xekhac']").val('');
							                }
							            };
									</script>
								</div>
								<div class="two fields">
									<div class="field <?php if($hoso->sothich == null): ?> error <?php endif; ?>">
										<label>Sở thích</label>
										<textarea rows="3" name="sothich" placeholder="Nội dung..."><?php echo e($hoso->sothich); ?></textarea>
									</div>
									<div class="field <?php if($hoso->diemmanh == null): ?> error <?php endif; ?>">
										<label>Điểm mạnh</label>
										<textarea rows="3" name="diemmanh" placeholder="Nội dung..."><?php echo e($hoso->diemmanh); ?></textarea>
									</div>
								</div>
								<h4 class="ui dividing header centered">GIA ĐÌNH</h4>
								<div id="giadinh" data-count="<?php echo e(count($giadinh) + 1); ?>"> 
										<div class="fields">	 								
										<div class="field two wide column">
											<label>Quan hệ</label>
																		
										</div>
										<div class="field three wide column">
											<label>Họ tên</label>

										</div>
										<div class="field two wide column">
											<label>Năm sinh</label>									
											
										</div>

										<div class="field three  wide column">
											<label>Công việc</label>

										</div>
										<div class="field three wide column">
											<label>Nơi làm việc</label>

										</div>
										<div class="field three wide column">
											<label>Thu nhập</label>

										</div>
								    </div>
									<?php $__currentLoopData = $giadinh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div id="giadinh-<?php echo e($key + 1); ?>">
											<div class="fields">	 								
												<div class="field two wide column">
													<input type="text" name="quanhegiadinh[]" value="<?php echo e($gd->quanhe); ?>">									
												</div>
												<div class="field three wide column">
													<input type="text" name="hotengiadinh[]" value="<?php echo e($gd->hoten); ?>">
												</div>
												<div class="field two wide column">									
													<div class="ui calendar" id="namsinhgd">
													      <input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="<?php echo e($gd->namsinh); ?>">
													</div>
												</div>
				
												<div class="field three wide column">
													<input type="text" name="congviecgiadinh[]" value="<?php echo e($gd->congviec); ?>">
												</div>
												<div class="field three wide column">
													<input type="text" name="noilamviecgiadinh[]" value="<?php echo e($gd->noilamviec); ?>">
												</div>
												<div class="field three wide column">
													<input type="text" name="thunhapgiadinh[]" value="<?php echo e($gd->luong); ?>" placeholder="VNĐ">
												</div>
												<i class="trash alternate icon red trash_giadinh"></i>
											</div> 	
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<div id="giadinh-<?php echo e(count($giadinh) + 1); ?>">
										<div class="fields <?php if(count($giadinh) <=0): ?> error <?php endif; ?>">	 								
											<div class="field two wide column <?php if($giadinh == null): ?> error <?php endif; ?>">
												<input type="text" name="quanhegiadinh[]">									
											</div>
											<div class="field three wide column">
												<input type="text" name="hotengiadinh[]">
											</div>
											<div class="field two wide column">									
												<div class="ui calendar" id="namsinhgd">
												      <input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="<?php echo e(old('namsinhgiadinh')); ?>">
												</div>
											</div>
											<div class="field three wide column">
												<input type="text" name="congviecgiadinh[]">
											</div>
											<div class="field three wide column">
												<input type="text" name="noilamviecgiadinh[]">
											</div>
											<div class="field three wide column">
												<input type="text" id="thunhap" name="thunhapgiadinh[]" placeholder="VNĐ">
											</div>
											<i class="plus icon blue add_giadinh"></i>
										</div>
									</div>
								</div>
								<div class="three fields">
									<div class="field">
										<label>Đăng ký ngày</label>
										<div class="ui calendar">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input id="ngaydangky" name="ngaydangky" value="<?php echo e(date_format(date_create($hoso->ngaydangky), "d-m-Y")); ?>">
										    </div>
										</div>
									</div>
									<div class="field <?php if($hoso->nguoiphutrach == null): ?> error <?php endif; ?>">
										<label>Người phụ trách</label>
										<input type="text" name="nguoiphutrach" value="<?php echo e($hoso->nguoiphutrach); ?>">
									</div>
									<div class="field <?php if($hoso->nguoigioithieu == null): ?> error <?php endif; ?>">
										<label>Người giới thiệu</label>
										<input type="text" name="nguoigioithieu" value="<?php echo e($hoso->nguoigioithieu); ?>">
									</div>
								</div>

								<div class="inline field">
									<label>(*) Trường bắt buộc phải nhập</label>
								</div>
						</div>
			
			
			<div class="ui bottom attached tab segment" data-tab="kitucxa">
				<div class="field">
					<label>Tình trạng đóng tiền</label>
					<div class="ui form wrapstatus"  >
						<div class="inline field status" >
						  <div class="ui toggle checkbox cont" >
							<?php if($hoso->trangthaidongtienktx==1): ?>
							<input name="stt" type="checkbox" class="cont" idstatus="<?php echo e($hoso->id); ?>" rootstatus="<?php echo e($hoso->trangthaidongtienktx); ?>" <?php if($hoso->trangthaidongtienktx == 1): ?> checked="" <?php endif; ?>>
							<label>Đã đóng tiền</label>
							<?php else: ?>
							<input name="stt" type="checkbox" class="cont" idstatus="<?php echo e($hoso->id); ?>" rootstatus="<?php echo e($hoso->trangthaidongtienktx); ?>" <?php if($hoso->trangthaidongtienktx == 1): ?> checked="" <?php endif; ?>>
							<label>Chưa đóng tiền</label>
							<?php endif; ?>
							
						  </div>
						</div>
					</div>
				</div>
			</div>
			
			
						<div class="ui bottom attached tab segment" data-tab="thongtin">
							<h3 class="ui dividing header">Điểm IQ</h3>
							<div class="five fields">
							<?php if($hoso->iq == null): ?>
								<?php
								$x = '{"m1":"","m2":"","m3":"","m4":"","m5":""}';
								$iq = json_decode($x);
								?>
							<?php else: ?>
								<?php
								$iq = json_decode($hoso->iq);
								?>
							<?php endif; ?>
									<div class="field">
										<label>M1</label>
										<div class="ui input left icon">							
										<i class="pencil alternate icon"></i>
										<input type="text" name="m1" value="<?php echo e($iq->m1); ?>" >
										</div>
									</div>
									<div class="field">
										<label>M2</label>
										<div class="ui input left icon">							
										<i class="pencil alternate icon"></i>
										<input type="text" name="m2" value="<?php echo e($iq->m2); ?>" >
										</div>
									</div>
									<div class="field">
										<label>M3</label>
										<div class="ui input left icon">							
										<i class="pencil alternate icon"></i>
										<input type="text" name="m3" value="<?php echo e($iq->m3); ?>" >
										</div>
									</div>
									<div class="field">
										<label>M4</label>
										<div class="ui input left icon">							
										<i class="pencil alternate icon"></i>
										<input type="text" name="m4" value="<?php echo e($iq->m4); ?>" >
										</div>
									</div>
									<div class="field">
										<label>M5</label>
										<div class="ui input left icon">							
										<i class="pencil alternateer icon"></i>
										<input type="text" name="m5" value="<?php echo e($iq->m5); ?>">
										</div>
									</div>
							</div>
							<h3 class="ui dividing header">Tình trạng sức khỏe</h3>
							<div class="six fields">
								<div class="field">
									<label>Uống rượu</label>
									<select name="sk_uongruou">
										<option value="0" <?php if($hoso->sk_uongruou == 0): ?> selected <?php endif; ?>>Không</option>
										<option value="1" <?php if($hoso->sk_uongruou == 1): ?> selected <?php endif; ?>>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Hút thuốc</label>
									<select name="sk_hutthuoc">
										<option value="0" <?php if($hoso->sk_hutthuoc == 0): ?> selected <?php endif; ?> >Không</option>
										<option value="1" <?php if($hoso->sk_hutthuoc == 1): ?> selected <?php endif; ?>>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Mù màu</label>
									<select name="sk_mumau">
										<option value="0" <?php if($hoso->sk_mumau == 0): ?> selected <?php endif; ?>>Không</option>
										<option value="1" <?php if($hoso->sk_mumau == 1): ?> selected <?php endif; ?>>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Có dị tật</label>
									<select name="sk_ditat">
										<option value="0" <?php if($hoso->sk_ditat == 0): ?> selected <?php endif; ?>>Không</option>
										<option value="1" <?php if($hoso->sk_ditat == 1): ?> selected <?php endif; ?>>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Hình xăm</label>
									<select name="sk_hinhxam">
										<option value="0" <?php if($hoso->sk_hinhxam == 0): ?> selected <?php endif; ?>>Không</option>
										<option value="1" <?php if($hoso->sk_hinhxam == 1): ?> selected <?php endif; ?>>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Mắt đeo kính</label>
									<select name="sk_deokinh">
										<option value="0" <?php if($hoso->sk_deokinh == 0): ?> selected <?php endif; ?>>Không</option>
										<option value="1" <?php if($hoso->sk_deokinh == 1): ?> selected <?php endif; ?>>Có</option>
									</select>
								</div>				
							</div>
							
							
							<h3 class="ui header dividing">Hộ chiếu</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Số hộ chiếu</label>
										<input type="text" name="hc_sohochieu" value="<?php echo e($hoso->hc_sohochieu); ?>">
									</div>
									<div class="field">
										<label>Nơi cấp</label>
										<input type="text" name="hc_noicap" value="<?php echo e($hoso->hc_noicap); ?>">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-hc-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngaycap" name="hc_ngaycap"  value="<?php echo e($hoso->hc_ngaycap); ?>">
										    </div>
										</div>
									</div>	
									<div class="field">
										<label>Ngày hết hạn</label>
										<div class="ui calendar" id="date-hc-ngayhethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngayhethan" name="hc_ngayhethan"  value="<?php echo e($hoso->hc_ngayhethan); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">	
									<div class="field">
										<label>Ngày nhận</label>
										<div class="ui calendar" id="date-hc-ngaynhan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngaynhan" name="hc_ngaynhan"  value="<?php echo e($hoso->hc_ngaynhan); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field ">
									<label>Đính kèm file</label>
									<input type="hidden" name="file_hc_hidden" value="<?php echo e($hoso->hc_file); ?>">
									<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
  									</label>
  									<input id="hc-file" name='hc_file[]' value="<?php echo e($hoso->hc_file); ?>" type="file" style="display:none;" multiple>
  									<?php 
  										$timestamp = strtotime($hoso->created_at);
        								$year = date("Y", $timestamp);
        								$month = date("m", $timestamp);
  									?>
  									<?php if($hoso->hc_file): ?>
  									<?php 
  										$hc_file = json_decode($hoso->hc_file); 
  									?>
  									<?php $__currentLoopData = $hc_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  									<label class="ui white basic field " style="text-align: left;">
  										<i class="ui download icon"></i>
  										<a href="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/hc/'.$hc)); ?>" target="_blank"><?php echo e($hc); ?></a>
  										<i class="ui trash icon red right removefile" datatype="hc" datafile="<?php echo e($hc); ?>"></i>
  									</label>
  									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  									<?php endif; ?>
								</div>
							</div>
		
							<h3 class="ui header dividing">Chứng minh nhân dân</h3>
							<div class="three fields">
								<div class="field">
									<div class="field">
										<label>Số CMND</label>
										<input type="text" name="cmnd_socmnd" value="<?php echo e($hoso->cmnd_socmnd); ?>">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Nơi cấp</label>
										<input type="text" name="cmnd_noicap" value="<?php echo e($hoso->cmnd_noicap); ?>">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-cmnd-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="cmnd_ngaycap" name="cmnd_ngaycap" value="<?php echo e($hoso->cmnd_ngaycap); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field ">
										<label>Đính kèm file</label>
										<input type="hidden" name="file_cmnd_hidden" value="<?php echo e($hoso->cmnd_file); ?>">
										<label for="cmnd-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
	  									</label>
	  									<input id="cmnd-file" name='cmnd_file[]' value="<?php echo e($hoso->cmnd_file); ?>" type="file" style="display:none;" multiple>
	  									<?php if($hoso->cmnd_file): ?>
	  									<?php 
	  										$cmnd_file = json_decode($hoso->cmnd_file); 
	  									?>
	  									<?php $__currentLoopData = $cmnd_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmnd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  									<label class="ui white basic field " style="text-align: left;">
	  										<i class="ui download icon"></i>
	  										<a href="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/cmnd/'.$cmnd)); ?>" target="_blank"><?php echo e($cmnd); ?></a>
	  										<i class="ui trash icon red right removefile" datatype="cmnd" datafile="<?php echo e($cmnd); ?>"></i>
	  									</label>
	  									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  									<?php endif; ?>
									</div>
								</div>
							</div>

							<h3 class="ui header dividing">Lý lịch tư pháp</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-ll-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_ngaycap" name="ll_ngaycap"  value="<?php echo e($hoso->ll_ngaycap); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày có hiệu lực</label>
										<div class="ui calendar" id="date-ll-ngaycohieuluc">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_ngaycohieuluc" name="ll_ngaycohieuluc"  value="<?php echo e($hoso->ll_ngaycohieuluc); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày hết hiệu lực</label>
										<div class="ui calendar" id="date-ll-hethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_hethan" name="ll_hethan"  value="<?php echo e($hoso->ll_hethan); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field ">
										<label>Đính kèm file</label>
										<input type="hidden" name="file_ll_hidden" value="<?php echo e($hoso->ll_file); ?>">
										<label for="ll-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
	  									</label>
	  									<input id="ll-file" name='ll_file[]' value="<?php echo e($hoso->ll_file); ?>" type="file" style="display:none;" multiple>
	  									<?php if($hoso->ll_file): ?>
	  									<?php 
	  										$ll_file = json_decode($hoso->ll_file); 
	  									?>
	  									<?php $__currentLoopData = $ll_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  									<label class="ui white basic field " style="text-align: left;">
	  										<i class="ui download icon"></i>
	  										<a href="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/ll/'.$ll)); ?>" target="_blank"><?php echo e($ll); ?></a>
	  										<i class="ui trash icon red right removefile" datatype="ll" datafile="<?php echo e($ll); ?>"></i>
	  									</label>
	  									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  									<?php endif; ?>
									</div>
								</div>

							</div>
							
							<h3 class="ui header dividing">Thông tin VISA</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Số hiệu</label>
										<input type="text" name="vs_sohieu" value="<?php echo e($hoso->vs_sohieu); ?>">
									</div>
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-vs-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngaycap" name="vs_ngaycap"  value="<?php echo e($hoso->vs_ngaycap); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày đăng ký</label>
										<div class="ui calendar" id="date-vs-ngaydangky">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngaydangky" name="vs_ngaydangky"  value="<?php echo e($hoso->vs_ngaydangky); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày hết hạn</label>
										<div class="ui calendar" id="date-vs-ngayhethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngayhethan" name="vs_ngayhethan"  value="<?php echo e($hoso->vs_ngayhethan); ?>">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field ">
										<label>Đính kèm file</label>
										<input type="hidden" name="file_vs_hidden" value="<?php echo e($hoso->vs_file); ?>">
										<label for="vs-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
	  									</label>
	  									<input id="vs-file" name='vs_file[]' value="<?php echo e($hoso->vs_file); ?>" type="file" style="display:none;" multiple>
	  									<?php if($hoso->vs_file): ?>
	  									<?php 
	  										$vs_file = json_decode($hoso->vs_file); 
	  									?>
	  									<?php $__currentLoopData = $vs_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  									<label class="ui white basic field " style="text-align: left;">
	  										<i class="ui download icon"></i>
	  										<a href="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/vs/'.$vs)); ?>" target="_blank"><?php echo e($vs); ?></a>
	  										<i class="ui trash icon red right removefile" datatype="vs" datafile="<?php echo e($vs); ?>"></i>
	  									</label>
	  									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  									<?php endif; ?>
									</div>
								</div>
							</div>
							
							<h3 class="ui header dividing">Khác</h3>
							<div class="field">
						          <label>Giấy tờ bổ sung</label>
						          <div class="wrap-giayto-dropdown" data-item-selected="<?php echo e($hoso->tt_giayto); ?>">
						            <div class="ui fluid multiple search selection dropdown giayto-dropdown">
						              <input name="tt_giayto" type="hidden">
						              <i class="dropdown icon"></i>
						              <div class="default text">Chọn loại giấy tờ</div>
						              <div class="menu">
						                  <div class="item" data-value="1">Chứng minh nhân dân</div>
						                  <div class="item" data-value="2">Sơ yếu lý lịch</div>
						                  <div class="item" data-value="3">Hộ chiếu cũ, thẻ cư chú</div>
						                  <div class="item" data-value="4">Giấy khai sinh</div>
						                  <div class="item" data-value="5">Sổ hộ khẩu</div>
						                  <div class="item" data-value="6">Bằng tốt nghiệp</div>
						                  <div class="item" data-value="7">Giấy kết hôn</div>
						                  <div class="item" data-value="8">Giấy xuất ngũ</div>
						              </div>
						            </div>
						          </div>
							 </div>
							
						     <script type="text/javascript">
						     	     $(document).ready(function($) {   
								        var giayto = $('.wrap-giayto-dropdown').attr('data-item-selected').split(",");
								        $('.giayto-dropdown').dropdown('set selected',giayto);
								    });  
						     </script>
							<div class="field">
								<label>Loại khác</label>
								<textarea name="tt_loaikhac" rows="5"><?php echo e($hoso->tt_loaikhac); ?></textarea>
							</div>
							<div class="field">
								<label>Ghi chú thêm</label>
								<textarea name="tt_ghichu" rows="5"><?php echo e($hoso->tt_ghichu); ?></textarea>
							</div>
							<h3 class="ui header">File scan</h3>
							<div class="field">
							   <div class="field ">
								   <input type="hidden" name="file_scan_hidden" value="<?php echo e($hoso->scan_file); ?>">
								   <label for="scan-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
									   <i class="ui upload icon"></i> <b> Tải Lên File  ( PDF, DOC, DOCX ) </b>
									 </label>
									 <input id="scan-file" accept="application/pdf" name='scan_file[]' value="<?php echo e($hoso->scan_file); ?>" type="file" style="display:none;" multiple>
									 <?php if($hoso->scan_file): ?>
									 <?php 
										 $scan_file = json_decode($hoso->scan_file); 
									 ?>
									 <?php $__currentLoopData = $scan_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									 <label class="ui white basic field " style="text-align: left;">
										 <i class="ui download icon"></i>
										 <a href="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/scan/'.$scan)); ?>" target="_blank"><?php echo e($scan); ?></a>
										 <i class="ui trash icon red right removefile" datatype="scan" datafile="<?php echo e($scan); ?>"></i>
									 </label>
									 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									 <?php endif; ?>
							   </div>
						   </div>
							
							<div class="ui modal tiny test">
							  	<div class="header">Xóa File </div>
							  	<div class="content">
							    	<p><b>Lưu ý:</b> file sẽ bị xóa vĩnh viễn khỏi hệ thống</p>
							  	</div>
							  	<div class="actions">
							    	<div class="ui approve button green approve-delete"> <i class="icon check"></i> OK</div>
							    	<div class="ui cancel button red temp-delete"> <i class="icon linkify"></i>Thêm file xóa</div>
							    	<div class="ui cancel button red cancel-delete"> <i class="icon refresh"></i> Hủy</div>
							  	</div>
							</div>
							
							<script type="text/javascript">
								$(document).ready(function(){
								  	$("#ngaysinh,#ngaydangky,#hc_ngaycap,#hc_ngayhethan,#hc_ngaynhan,#cmnd_ngaycap,#ll_hethan,#ll_ngaycohieuluc,#ll_ngaycap,#vs_ngayhethan,#vs_ngaycap,#vs_ngaydangky").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
									$(".thoigianhocbd,.thoigianhockt,.namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});
									$(".thoigianlamviecbd,.thoigianlamvieckt").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});

								  $('#phone,#phone1').inputmask({ mask: "0999.999.999"});
								  $("#thunhap").inputmask("numeric", {
										radixPoint: ".",
										groupSeparator: ",",
										digits: 2,
										autoGroup: true,
										rightAlign: false,
										oncleared: function () { self.Value(''); }
									});	
								});
							</script>
							<script type="text/javascript">
								$('.ui.dropdown').dropdown('show')
							</script>
							<script type="text/javascript">
							$('.menu .item')
							  .tab()
							;
							</script>
						</div>
			
					

					</div>
				</div>
			</div>					
	        <div class="ui segment">
	          <div class="ui secondary menu">
	          	<div class="left menu">
					<a class="item">
                    <a href="<?php echo e(url('/hoso/testmiss')); ?>" class="ui labeled icon red button"><i class="arrow left icon"></i>Kiểm Tra</a>
                  </a>
	          	</div>
	              <div class="right menu">
			        <a href="<?php echo e(url('/hoso')); ?>" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
				<button type="submit" class="ui labeled icon button green"><i class="save icon"></i>Lưu</button>
	              </div>
	            </div>
	     	</div>
		</div>	     	
	</form>
	<style type="text/css">
	  	.custom-file-upload {
			border: 1px solid #ccc;
			display: inline-block;
			padding: 6px 12px;
			cursor: pointer;
			margin: 10px;
		}
	</style>
	<script type="text/javascript">
		$('#hc-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#hc-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
	 	$('#cmnd-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#cmnd-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
		$('#vs-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#vs-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
		$('#ll-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#ll-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
		$('#scan-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#scan-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
	</script>
	<script>
	$(document).ready(function(){
		$(".removefile").click(function(){
			$(".test").modal('show');
			var ifile =  $(this).attr("datafile");
			var typefile =  $(this).attr("datatype");
			$(".test .header").append("<b>"+ifile+",</b>");
			$(".approve-delete").click(function(){
			    $.get((ifile + "/" + typefile + "/removefile"), function(data, status){
			      location.reload();
			    });
			});
			$(".cancel-delete").click(function(){
				location.reload();
			});
		});
	});
	</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/hoso/add_hoso.js')); ?>"></script>
  
  <script>
	$(document).ready(function(){
		//status
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(".wrapstatus").on('click','.cont',function(e){
			var id = $(this).attr('idstatus');
			var sss = $(this).attr('rootstatus');
			if (sss == 1) {
			status = 0;
			} else {
			status = 1;
			}
			$.post("/hoso/status/"+id,
			{
			status: status
			});
		});
	})
  </script>
  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>