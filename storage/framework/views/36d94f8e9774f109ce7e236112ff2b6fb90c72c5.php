<?php $__env->startSection('title', 'Sửa Dịch sang tiếng Nhật'); ?>
<?php $__env->startSection('PageContent'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/croper/croppie.css')); ?>">
<script src="<?php echo e(url('libraries/croper/croppie.js')); ?>"></script>
<?php
function khongdau($str) {
	  $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	  $str = preg_replace("/(đ)/", 'd', $str);
	  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	  $str = preg_replace("/(Đ)/", 'D', $str);
	  return $str;
	}
?>
	<h2 class="ui header center aligned">
    CHỈNH SỬA DỊCH THUẬT
    <div class="sub header">
      Cập nhật học viên : <span class="ui teal label"><?php echo e($hoso->hoten); ?> </span> sang tiếng Nhật
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
	<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
	<?php echo e(csrf_field()); ?>

		<div class="ui segments">
			<div class="ui segment">
				<div class="ui secondary menu">
					<div class="left menu">
						<a href="<?php echo e(url('/hoso')); ?>" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
					</div>
				</div>
			</div>

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
			<img width="70" id="upload-demo-img" <?php if($hoso->hinhanh): ?> src="<?php echo e('/hocviens/'.$year_image.'/'.$month_image.'/'.$hoso->hinhanh); ?>" <?php else: ?> src="/images/admin/avatar.png"  <?php endif; ?>>
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
					enableExif: false,
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
<div class="infohead">
	<p>
		<b>Ngày post: <span class="ui teal label"><?php echo e(date_format(date_create($hoso->created_at), "d-m-Y")); ?></span></b> 
	</p>
	<p>
		<b>Người Tư Vấn:  <span class="ui teal label"><?php if(isset($user->name)): ?><?php echo e($user->name); ?><?php endif; ?></span></b>
	</p>
	<p>
		<b>Người phụ trách:  <span class="ui teal label"><?php echo e($hoso->nguoiphutrach); ?></span></b>
	</p>
	<p>
		<b>Ngày sinh: <span class="ui teal label"><?php echo e(date_format(date_create($hoso->ngaysinh), "d-m-Y")); ?></span></b> 
	</p>	
	<p>	
		<b>Điện thoại:  <span class="ui teal label"><?php echo e($hoso->dienthoai); ?></span></b>
	</p>				
</div>

	     	<div class="ui segment">
				<div class="ui column centered main-content">	
					<div class="column">
							
						<div class="ui top attached tabular menu">
						  <a class="item active" data-tab="soyeulylich">Tiếng Nhật</a>	
						  <a class="item" data-tab="scan">Scan file</a>						  
						</div>
						<div class="ui bottom attached tab segment " data-tab="scan">
							<?php 
								$timestamp = strtotime($hoso->created_at);
							  	$year = date("Y", $timestamp);
							  	$month = date("m", $timestamp);
							?>
								<h3 class="ui header">File scan</h3>
								<div class="field">
								   <div class="field ">
										 <?php if($hoso->scan_file): ?>
										 <?php 
											 $scan_file = json_decode($hoso->scan_file); 
										 ?>
										 <?php $__currentLoopData = $scan_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											  <object style="width: 100%; min-height: 1000px;" data="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/scan/'.$scan)); ?>" type="application/pdf">
												<embed src="<?php echo e(url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/scan/'.$scan)); ?>" type="application/pdf" />
											</object>
										 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										 <?php endif; ?>
								   </div>
							   </div>
						</div>
						<div class="ui bottom attached tab segment active" data-tab="soyeulylich">			
							
								<h3 class="ui header centered blue"></h3>
								<h4 class="ui dividing header centered">THÔNG TIN CÁ NHÂN</h4>
								<div class="field thongtin">
								<input type="hidden" name="id_hocvien" value="<?php echo e($hoso->id); ?>">	
								
								<div class="ui form">
									<div class=" fields">
										<div class="four wide field">
											<label>Họ và tên (*)</label>
											<div class="ui input left icon">							
												<i class="user icon"></i>
												<input type="text" name="hoten" value="<?php echo e($hosojp->hoten); ?>" data-content="<?php echo e($hoso->hoten); ?>">
											</div>
										</div>
										<?php
										if ( strstr($hosojp->noisinh,"省")) {
											$strs = "省";
										}elseif (strstr($hosojp->noisinh,"市")) {
											$strs = "市";
										}else{
											$strs = "null";
										}
										?>
										<div class="three wide field">		
											<label>Nơi sinh (*)</label>
											<div class="ui input left icon">
												<i class="map marker alternate icon"></i>
												<input type="text" name="noisinh" value="<?php echo e(rtrim($hosojp->noisinh,$strs)); ?>" data-content="<?php echo e($hoso->noisinh); ?>" >
											</div>
										</div>
										<div class="field">
											<label>Tỉnh/thành</label>
											<select name="noisinhplus" class=" selection ui dropdown " >
												<option value="省" <?php if($strs == "省"): ?> selected <?php endif; ?>>省</option> 
												<option value="市" <?php if($strs == "市"): ?> selected <?php endif; ?>>市</option>  
												<option value="" <?php if($strs == ""): ?> selected <?php endif; ?>></option>
											</select>
										</div>
										<div class="field">
											<label>Miền (<?php echo e($hoso->mien); ?>)</label>
											<select name="mien" class="selection ui dropdown " >
												<option value=""><?php echo e($hoso->mien); ?></option>
												<option value="南部" <?php if($hosojp->mien == "南部"): ?> selected <?php endif; ?> >南部</option> 
												<option value="中部" <?php if($hosojp->mien == "中部"): ?> selected <?php endif; ?> >中部</option>  
												<option value="北部" <?php if($hosojp->mien == "北部"): ?> selected <?php endif; ?> >北部</option>  
											</select>	
										</div>
										
									</div>
									
									<?php if($hoso->diachi): ?>
									
									<div class="fields">
										<div class="twelve wide field">
											<label>Địa chỉ hộ khẩu (*)</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="diachi" value="<?php echo e(khongdau($hosojp->diachi)); ?>" data-content="<?php echo e($hoso->diachi); ?>" >
											</div>
										</div>
										<div class="field">
											<label>Đ/c miền</label>
											<select name="diachimien" class="selection dropdown " >
												<option value="南部" <?php if($hosojp->diachimien == "南部"): ?> selected <?php endif; ?> >南部</option> 
												<option value="中部" <?php if($hosojp->diachimien == "中部"): ?> selected <?php endif; ?> >中部</option> 
												<option value="北部" <?php if($hosojp->diachimien == "北部"): ?> selected <?php endif; ?> >北部</option> 
												<option value=""> </option>
											</select>	
										</div>
									</div>
									<?php else: ?>
									<?php
										$dchk = json_decode($hosojp->dchk);
									?>
									<?php if($dchk): ?>
									<div class="fields">
										<div class="three wide field">
											<label>Địa chỉ (ấp/khu phố)</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_dc"  value="<?php echo e($dchk->dchk_dc); ?>" data-content="<?php echo e($hoso->dchk_dc); ?>" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_dc_plus"  >
												<option value="村" <?php if($dchk->dchk_dc_plus == "村"): ?> selected <?php endif; ?> >村</option>
												<option value="" <?php if($dchk->dchk_dc_plus == ""): ?> selected <?php endif; ?>> </option>
											</select>
										</div>
										<div class="three wide field">
											<label>Phường/xã</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_xa" value="<?php echo e(khongdau($dchk->dchk_xa)); ?>" data-content="<?php echo e($hoso->dchk_xa); ?>" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_xa_plus"  >
												<option value="町" <?php if($dchk->dchk_xa_plus == "町"): ?> selected <?php endif; ?> >町</option>
												<option value="" <?php if($dchk->dchk_xa_plus == ""): ?> selected <?php endif; ?>> </option>
											</select>
										</div>
										<div class="three wide field">
											<label>Quận/huyện</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_huyen" value="<?php echo e(khongdau($dchk->dchk_huyen)); ?>" data-content="<?php echo e($hoso->dchk_huyen); ?>" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_huyen_plus"  >
												<option value="区" <?php if($dchk->dchk_huyen_plus == "区"): ?> selected <?php endif; ?> >区</option>
												<option value="" <?php if($dchk->dchk_huyen_plus == ""): ?> selected <?php endif; ?>>  </option>
											</select>
										</div>
										<div class="two wide field">
											<label>Tỉnh/thành</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_tinh" placeholder="<?php echo e(strtoupper(khongdau($city->ten))); ?>" value="<?php echo e(strtoupper(khongdau($city->ten))); ?>" data-content="<?php echo e($city->ten); ?>" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_tinh_plus" class=" selection dropdown " >
												<option value="省" <?php if($dchk->dchk_tinh_plus == "省"): ?> selected <?php endif; ?>>省</option> 
												<option value="市" <?php if($dchk->dchk_tinh_plus == "市"): ?> selected <?php endif; ?>>市</option>  
												<option value=""> </option>
											</select>
										</div>
										<div class="field">
											<label>Đ/c miền</label>
											<select name="diachimien" class="selection dropdown " >
												<option value="南部" <?php if($hosojp->diachimien == "南部"): ?> selected <?php endif; ?> >南部</option> 
												<option value="中部" <?php if($hosojp->diachimien == "中部"): ?> selected <?php endif; ?> >中部</option> 
												<option value="北部" <?php if($hosojp->diachimien == "北部"): ?> selected <?php endif; ?> >北部</option> 
												<option value=""> </option>
											</select>	
										</div>				
									</div>
									<?php endif; ?>
									<?php endif; ?>
								</div>
								<div class="three fields">
									<div class="field honnhan">
										<label><i class="balance scale icon"></i> Hôn nhân - "<?php echo e($hoso->honnhan); ?>"
											<a class="honnhannutnhap"><i class="pencil alternate icon"></i>nhập tay</a>
											<a class="honnhannutchon"><i class="thumbtack icon"></i>chọn sẵn</a>
										</label>
										<select name="honnhan" class="honnhanchon selection ui dropdown " >
											<option value=""><?php echo e($hoso->honnhan); ?></option>
											<option value="独身" <?php if($hosojp->honnhan == "独身"): ?> selected <?php endif; ?>>独身</option> 
											<option value="既婚" <?php if($hosojp->honnhan == "既婚"): ?> selected <?php endif; ?>>既婚</option>  
											<option value="離婚" <?php if($hosojp->honnhan == "離婚"): ?> selected <?php endif; ?>>離婚</option>  
										</select>
										<div  class="honnhannhap">
											<input type="hidden" class="honnhanhidden" value="<?php echo e($hosojp->honnhan); ?>">
										</div>
									</div>
									<div class="field ">
										<label>Bệnh án (<?php echo e($hoso->benhan); ?>)</label>
										<select name="benhan" class="selection ui dropdown " >
											<option value=""><?php echo e($hoso->benhan); ?></option>
											<option value="無" <?php if($hosojp->benhan == "無"): ?> selected <?php endif; ?> >無</option> 
											<option value="有" <?php if($hosojp->benhan == "有"): ?> selected <?php endif; ?> >有</option> 
										</select>
									</div>

									<div class="field tongiao">
										<label><i class="balance scale icon"></i> Tôn giáo - "<?php echo e($hoso->tongiao); ?>"
											<a class="tongiaonutnhap"><i class="pencil alternate icon"></i>nhập tay</a>
											<a class="tongiaonutchon"><i class="thumbtack icon"></i>chọn sẵn</a>
										</label>
										<select name="tongiao" class="tongiaochon selection ui dropdown " >
											<option value=""><?php echo e($hoso->tongiao); ?></option>
											<option value="無" <?php if($hosojp->tongiao == "無"): ?> selected <?php endif; ?>>無</option> 
											<option value="仏教" <?php if($hosojp->tongiao == "仏教"): ?> selected <?php endif; ?>>仏教</option>  
											<option value="キリスト教" <?php if($hosojp->tongiao == "キリスト教"): ?> selected <?php endif; ?>>キリスト教</option>  
										</select>
										<div  class="tongiaonhap">
											<input type="hidden" class="tongiaohidden" value="<?php echo e($hosojp->tongiao); ?>">
				
										</div>
									</div>
									<div class="field">
										<label>Mắt trái</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="mattrai" value="<?php echo e($hosojp->mattrai); ?>" placeholder="<?php echo e($hosojp->mattrai); ?>" data-content="<?php echo e($hoso->mattrai); ?>">
										</div>
									</div>
									<div class="field">
										<label>Mắt phải</label>
										<div class="ui input left icon">
											<i class="eye scale icon"></i>
											<input type="text" name="matphai" value="<?php echo e($hosojp->matphai); ?>" placeholder="<?php echo e($hosojp->matphai); ?>" data-content="<?php echo e($hoso->matphai); ?>">
										</div>
									</div>
								</div>
							</div>	
							<?php
								$sttht = 0;
								$hoctap = json_decode($hosojp->hoctap);
								if (isset($hoctap->thoigianbd) && $hoctap->thoigianbd != null) {
									$counthoctap = count($hoctap->thoigianbd);	
								}else{
									$counthoctap = 0;
								}
								if ($ehoctap) {
									$ehoctap = $ehoctap;
									$countehoctap = count($ehoctap);
								}else{
									$ehoctap = null;
									$countehoctap = 0;
								}	
								$j = 0;
								$arrhoctap = array("小学校", "中学校", "高等学校");
								// ['cap 1','cap 2', 'cap 3']
								function replace($text){
									$arrayText = array('TRUONG TIEU HOC','TRUONG THCS', 'TRUONG THPT');
									$str = "";
									for ($i=0; $i < 3 ; $i++) { 
										if (strpos($text, $arrayText[$i]) !== false) {
											$str = str_replace($arrayText[$i],"",$text);
										}
									}
									return $str;
								}
							?>

								<h4 class="ui dividing header centered">QUÁ TRÌNH HỌC TẬP</h4>
								<div id="hoctap" data-count="1">
								<div class="three fields">
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
								<?php $__currentLoopData = $ehoctap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(($counthoctap -1) > $j): ?>
									<div class="three fields" style=" margin: 0em -0.5em;">
										<div class="field">
											<div class="two fields">
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														  <i class="calendar icon"></i>
														  
														  <?php
														  $vthoigianbd = "";
															  if(isset($hoctap->thoigianbd[$j]) && strlen($hoctap->thoigianbd[$j]) == 4){
																  $vthoigianbd = "09-".$hoctap->thoigianbd[$j];
															  }else{
																$vthoigianbd = $hoctap->thoigianbd[$j];
															  }
														  ?>
														  <input type="text" name="thoigianhocbd[]"  <?php if(isset($hoctap->thoigianbd[$j])): ?> value="<?php echo e($vthoigianbd); ?>"  <?php endif; ?> class="thoigianhocbd"  data-content="<?php echo e($item->thoigianbd); ?>" >
														</div>
													</div> 
												</div>								
					
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														  <i class="calendar icon"></i>

														  <?php
														  $vthoigiankt = "";
															  if(isset($hoctap->thoigiankt[$j]) && strlen($hoctap->thoigiankt[$j]) == 4){
																  $vthoigiankt = "05-".$hoctap->thoigiankt[$j];
															  }else{
																$vthoigiankt = $hoctap->thoigiankt[$j];
															  }
														  ?>
														  <input type="text" name="thoigianhockt[]"  <?php if(isset($hoctap->thoigiankt[$j])): ?> value="<?php echo e($vthoigiankt); ?>"  <?php endif; ?> class="thoigianhockt" data-content="<?php echo e($item->thoigiankt); ?>">
														</div>
													</div> 
												</div>
							
											</div>
										</div>
										<div class="field">
											<div class="ui input left icon">
												<i class="building icon"></i>
												<input type="text" name="tentruong[]" <?php if(isset($hoctap->tentruong[$j])): ?> value="<?php echo e(khongdau($hoctap->tentruong[$j])); ?>"  <?php endif; ?> data-content="<?php echo e($item->tentruong); ?>">
											</div>	
										</div>							
										<div class="field">
											<div class="ui grid">
												<div class="twelve wide column">
													<div class="ui input left icon">
														<i class="map icon"></i>
														<input type="text" name="diachitruong[]" <?php if(isset($hoctap->diachitruong[$j])): ?> value="<?php echo e(khongdau($hoctap->diachitruong[$j])); ?>" <?php else: ?> value="<?php echo e(khongdau($item->diachi)); ?>" <?php endif; ?> data-content="<?php echo e($item->diachi); ?>">
													</div>
												</div>
												<div class="four wide column">
													<select name="dctinh[]" class=" dc selection dropdown " >
														<?php if(isset($hoctap->dctinh[$j])): ?>
															<option value="省" <?php if($hoctap->dctinh[$j] == "省"): ?> selected <?php endif; ?> >省</option> 
															<option value="市" <?php if($hoctap->dctinh[$j] == "市"): ?> selected <?php endif; ?> >市</option> 
															<option value=""></option> 
														<?php else: ?>
															<option value=""></option>
															<option value="省" >省</option> 
															<option value="市" >市</option>  
														<?php endif; ?>					
													</select>									
												</div>
											</div>
										</div>
									</div>
								<?php else: ?>
									<div class="three fields" style=" margin: 0em -0.5em;">
										<div class="field">
											<div class="two fields">
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														<i class="calendar icon"></i>
														<input type="text" name="thoigianhocbd[]"  value="09-<?php echo e($item->thoigianbd); ?>"  class="thoigianhocbd" data-content="<?php echo e($item->thoigianbd); ?>" >
														</div>
													</div> 
												</div>								
					
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														<i class="calendar icon"></i>
														<input type="text" name="thoigianhockt[]" value="05-<?php echo e($item->thoigiankt); ?>" class="thoigianhockt" data-content="<?php echo e($item->thoigiankt); ?>">
														</div>
													</div> 
												</div>
							
											</div>
										</div>
						
										<div class="field">
											<div class="ui input left icon">
												<i class="building icon"></i>
												<?php if($j > 2): ?> 
													<input type="text" name="tentruong[]" value="<?php echo e(khongdau($item->tentruong)); ?>"  data-content="<?php echo e($item->tentruong); ?>">
												<?php else: ?>
													<input type="text" name="tentruong[]"  value="<?php echo e(replace(khongdau($item->tentruong))); ?>" data-content="<?php echo e($item->tentruong); ?>">
												<?php endif; ?>
												
											</div>	
										</div>							
										<div class="field">
											<div class="ui grid">
												<div class="twelve wide column">
													<div class="ui input left icon">
														<i class="map icon"></i>
														<input type="text" name="diachitruong[]" <?php if(isset($hoctap->diachitruong[$j])): ?> value="<?php echo e(khongdau($hoctap->diachitruong[$j])); ?>" <?php else: ?> value="<?php echo e(khongdau($item->diachi)); ?>" <?php endif; ?> data-content="<?php echo e($item->diachi); ?>">
													</div>
												</div>
												<div class="four wide column">
													<select name="dctinh[]" class=" dc selection dropdown " >
														<?php if(isset($hoctap->dctinh[$j])): ?>
															<option value="省" <?php if($hoctap->dctinh[$j] == "省"): ?> selected <?php endif; ?> >省</option> 
															<option value="市" <?php if($hoctap->dctinh[$j] == "市"): ?> selected <?php endif; ?> >市</option> 
															<option value=""></option> 
														<?php else: ?>
															<option value=""></option>
															<option value="省" >省</option> 
															<option value="市" >市</option>  
														<?php endif; ?>					
													</select>									
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>
								<?php
									$j++;
								?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
									
<?php if($counthoctap > $countehoctap): ?>
<div class="three fields" style=" margin: 0em -0.5em;">
		<div class="field">
			<div class="two fields">
				<div class="field">
					<div class="ui calendar" >
						<div class="ui input left icon">
						  <i class="calendar icon"></i>
						  <input type="text" class="thoigianhocbd" name="thoigianhocbd[]" value="<?php echo e($hoctap->thoigianbd[$counthoctap -1]); ?>" >
						</div>
					</div> 
				</div>								

				<div class="field">
					<div class="ui calendar" >
						<div class="ui input left icon">
						  <i class="calendar icon"></i>
						  <input type="text" name="thoigianhockt[]" value="<?php echo e($hoctap->thoigiankt[$counthoctap -1]); ?>" >
						</div>
					</div> 
				</div>
			</div>
		</div>

		<div class="field">
			<div class="ui input left icon">
				<i class="building icon"></i>
				<input type="text" name="tentruong[]" value="<?php echo e($hoctap->tentruong[$counthoctap -1]); ?>">
			</div>	
		</div>							
		<div class="field">
			<div class="ui grid">
				<div class="twelve wide column">
					<div class="ui input left icon">
						<i class="map icon"></i>
						<input type="text" name="diachitruong[]" value="<?php echo e($hoctap->diachitruong[$counthoctap -1]); ?>">
					</div>
				</div>
				<div class="four wide column">
					
						<select name="dctinh[]" class=" dc selection dropdown " >
							<option value="市">市</option>  
							<option value="省">省</option> 
							<option value=""></option> 
						</select>							
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
<div class="three fields" style=" margin: 0em -0.5em;">
		<div class="field">
			<div class="two fields">
				<div class="field">
					<div class="ui calendar" >
						<div class="ui input left icon">
						  <i class="calendar icon"></i>
						  <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
						</div>
					</div> 
				</div>								

				<div class="field">
					<div class="ui calendar" >
						<div class="ui input left icon">
						  <i class="calendar icon"></i>
						  <input type="text" name="thoigianhockt[]" value="現在に至る">
						</div>
					</div> 
				</div>
			</div>
		</div>
		<div class="field">
			<div class="ui input left icon">
				<i class="building icon"></i> 
				<input type="text" name="tentruong[]" value="MIRAI HUMAN 日本語教育センター">
			</div>	
		</div>							
		<div class="field">
			<div class="ui grid">
				<div class="twelve wide column">
					<div class="ui input left icon">
						<i class="map icon"></i>
						<input type="text" name="diachitruong[]" value="HO CHI MINH">
					</div>
				</div>
				<div class="four wide column">
					
						<select name="dctinh[]" class=" dc selection dropdown " >
							<option value="市">市</option>  
							<option value="省">省</option> 
							<option value=""></option> 
						</select>							
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</div>
	
								

<div class="ui grid">
	<div class="six wide column">
		
		<h5 class="ui dividing header">NGOẠI NGỮ</h5>
		<div class="two fields">
		<div class="field">
			<label >CHỌN BÀI HỌC</label>
			<div class="ui input left icon select_nhatngu">
				<select name="" id="select_nhatngu" class="ui selection dropdown">
					<option value=" "></option>
					<option value="みんなの日本語 [カナ]">みんなの日本語 [カナ]</option>
					<option value="みんなの日本語 [第5課]">みんなの日本語 [第5課]</option>
				</select>
			</div>
		</div>
		<div class=" field">
			<label>NHẬT NGỮ</label>
			<div class="ui input left icon">
				<i class="language icon"></i>
				<input type="text" id="show_nhatngu" name="nhatngu" value="<?php echo e($hosojp->nhatngu); ?>"  data-content="<?php echo e($hoso->nhatngu); ?>">
			</div>
		</div>
		</div>
	</div>
	<div class="ten wide column">
		<h5 class="ui dividing header">Điểm IQ</h5>
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
</div>
</div>


								
<h4 class="ui dividing header centered">QUÁ TRÌNH LÀM VIỆC</h4>
<?php
	$sttlv = 0;
	$lamviec = json_decode($hosojp->lamviec);
	if ($lamviec->thoigianbd != null) {
		$countlamviec = count($lamviec->thoigianbd);
	}else{
		$countlamviec = 0;
	}
	if ($elamviec) {
		$elamviec = $elamviec;
		$countelamviec = count($elamviec);
	}else{
		$elamviec = null;
		$countelamviec = 0;
	}		
?>
<div id="congviec" data-count="1">
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
	<?php $__currentLoopData = $elamviec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $elv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	
	<?php if($countlamviec > $sttlv): ?>
		<div class="three fields" style="margin:0em -0.5em;">
			<div class="field">	
				<div class="two fields">
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamviecbd[]" value="<?php echo e($elv->thoigianbd); ?>"  >
							</div>
						</div> 
					</div>														
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamvieckt[]" value="<?php echo e($elv->thoigiankt); ?>"  >
							</div>
						</div> 
					</div>
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="building icon"></i>
					<input type="text" name="tencongty[]" value="<?php echo e(khongdau($lamviec->tencongty[$sttlv])); ?>" data-content="<?php echo e($elv->tencongty); ?>">
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="briefcase icon"></i>
					<input type="text" name="ndcongviec[]" value="<?php echo e(khongdau($lamviec->ndcongviec[$sttlv])); ?>" data-content="<?php echo e($elv->congviec); ?>">
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="three fields" style="margin:0em -0.5em;">
			<div class="field">	
				<div class="two fields">
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamviecbd[]" value="<?php echo e($elv->thoigianbd); ?>" data-content="<?php echo e($elv->thoigianbd); ?>" >
							</div>
						</div> 
					</div>														
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamvieckt[]"  value="<?php echo e($elv->thoigiankt); ?>" data-content="<?php echo e($elv->thoigiankt); ?>" >
							</div>
						</div> 
					</div>
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="building icon"></i>
					<input type="text" name="tencongty[]" 
					value="<?php echo e(khongdau($elv->tencongty)); ?>" data-content="<?php echo e($elv->tencongty); ?>">
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="briefcase icon"></i>
					<input type="text" name="ndcongviec[]" 
					value="<?php echo e(khongdau($elv->congviec)); ?>" data-content="<?php echo e($elv->congviec); ?>">
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php 
			++$sttlv;
		?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<h4 class="ui dividing header centered">NGƯỜI THÂN TẠI NHẬT <i class="plus icon blue add_plus"></i></h4>
	<div id="ttnguoithan" data-count="1" > 			
	<?php if($hosojp->nguoithan ): ?>
	<div class="three fields">
		<div class="field">
			<label>Họ tên</label>
		</div>
		<div class="field">
			<label>Tuổi</label>
		</div>
		<div class="field">
			<label>Quan hệ</label>
		</div>
	</div> 
	<?php
		$sttnt = 0;
		$nguoithan = json_decode($hosojp->nguoithan);
		if ($nguoithan->hoten != null) {
			$countnguoithan = count($nguoithan->hoten);
		}else{
			$countnguoithan = 0;
		}
		if ($enguoithan) {
			$enguoithan = $enguoithan;
			$countenguoithan = count($enguoithan);
		}else{
			$enguoithan = null;
			$countenguoithan = 0;
		}		
	?>
		
			
			
			<?php for($sttnt = 0; $sttnt < $countnguoithan; $sttnt++): ?>
				
			<?php if($nguoithan->hoten[$sttnt] != null): ?>
				
			
				<div class="three fields" style="margin:1em -0.5em;">
					<div class="field">	
						<div class="field">
							<div class="ui calendar">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" name="hotennguoithan[]"  value="<?php echo e(khongdau($nguoithan->hoten[$sttnt])); ?>"
										> 
								</div>
							</div> 
						</div>														
					</div>
					<div class="field">
						<div class="ui input left icon">
							<i class="building icon"></i>
							<input type="text" name="tuoinguoithan[]" value="<?php echo e(khongdau($nguoithan->tuoi[$sttnt])); ?>" 
								>
						</div>
					</div>
					<div class="field">
						<div class="ui input left icon">
							<i class="briefcase icon"></i>
							<input type="text" name="quanhenguoithan[]" value="<?php echo e(khongdau($nguoithan->quanhe[$sttnt])); ?>"
							>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php endfor; ?>
		
		<?php else: ?>			
			<div id="ttnguoithan-1" class="three fields">
				<div class="field">
					<label>Họ và Tên</label>
				</div>
				<div class="field">
					<label>Tuổi</label>
				</div>
				<div class="field">
					<label>Quan hệ</label>
				</div>
			</div>
		<?php endif; ?>
	</div>
		
			
	
		
	<h4 class="ui dividing header centered">THỰC TẬP KỸ NĂNG Ở NHẬT</h4>

	<div class="two fields thuctap">
		<div class="field">
			<label>Mục đích đi Nhật</label>
			<div class=" select_mucdich">
				<select name="" id="select_mucdich" class="selection dropdown">
					<option value=" "></option>
					<option value="家族のためにお金を稼ぎ、日本人の働き方を学ぶこと">家族のためにお金を稼ぎ、日本人の働き方を学ぶこと</option>
					<option value="家族のためにお金を稼ぎ、日本語や日本人の働き方等を学ぶこと">家族のためにお金を稼ぎ、日本語や日本人の働き方等を学ぶこと</option>
					<option value="家族を経済的に支援し、日本人の働き方や日本文化等を学ぶこと">家族を経済的に支援し、日本人の働き方や日本文化等を学ぶこと</option>
					<option value="家族のためお金を稼ぎ、日本語や知識等を積み重ねること">家族のためお金を稼ぎ、日本語や知識等を積み重ねること</option>
					<option value="家族を経済的に支援し、職業経験を積み重ねること">家族を経済的に支援し、職業経験を積み重ねること</option>
				</select>
			</div>
			<label></label>
			<textarea rows="3" name="mucdich" id="show_mucdich" data-content="<?php echo e($hoso->mucdich); ?>" placeholder="<?php echo e(khongdau($hoso->mucdich)); ?>"><?php echo e($hosojp->mucdich); ?></textarea>
		</div>
		<div class="field">
			<label>Mục tiêu sau khi về nước</label>
			<div class=" select_muctieu">
				<select name="" id="select_muctieu" class="selection dropdown">
					<option value=" "></option>
					<option value="日本語能力認定書N2を取得して日本語の教師になること">日本語能力認定書N2を取得して日本語の教師になること</option>
					<option value="日本語能力認定書N2を取得してベトナムにおける日系企業に勤めること">日本語能力認定書N2を取得してベトナムにおける日系企業に勤めること</option>
					<option value="日本語能力認定書N2を取得して日系企業に通訳者として勤めること">日本語能力認定書N2を取得して日系企業に通訳者として勤めること</option>
					<option value="日本での職業経験を活かしてベトナムにおける日系企業に管理者として勤めること">日本での職業経験を活かしてベトナムにおける日系企業に管理者として勤めること</option>
					<option value="日本での職業経験を活かしてベトナムにおける日系企業に勤めること">日本での職業経験を活かしてベトナムにおける日系企業に勤めること</option>
					<option value="貯金を利用して自分の飲食店を造ること">貯金を利用して自分の飲食店を造ること</option>
					<option value="N2を修得し日本での職業経験を生かして日系企業に管理者として勤めること。">N2を修得し日本での職業経験を生かして日系企業に管理者として勤めること。</option>
					<option value="身に付けた経験を活かして、ベトナムにおける日系企業で働くことです。">身に付けた経験を活かして、ベトナムにおける日系企業で働くことです。</option>
				</select>
			</div>
			<label></label>
			<textarea rows="3" name="muctieu" id="show_muctieu" data-content="<?php echo e($hoso->muctieu); ?>" placeholder="<?php echo e(khongdau($hoso->muctieu)); ?>"><?php echo e($hosojp->muctieu); ?></textarea>
		</div>
	</div>
	<h4 class="ui dividing header centered">KHÁC</h4>
	<div class="two fields">
		<div class="field">
			<label>Sở thích</label>
			<textarea rows="3" name="sothich" placeholder="Nội dung..." data-content="<?php echo e($hoso->sothich); ?>"><?php echo e($hosojp->sothich); ?></textarea>
		</div>
		<div class="field">
			<label>Điểm mạnh</label>
			<textarea rows="3" name="diemmanh" placeholder="Nội dung..." data-content="<?php echo e($hoso->diemmanh); ?>"><?php echo e($hosojp->diemmanh); ?></textarea>
		</div>
	</div>
	<?php									 
		$sttgd = 0;
		$giadinh = json_decode($hosojp->giadinh);
		if ($giadinh->quanhe != null) {
			$countgiadinh = count($giadinh->quanhe);
		}else{
			$countgiadinh = 0;
		}
		if ($egiadinh) {
			$egiadinh = $egiadinh;
			$countegiadinh = count($egiadinh);
		}else{
			$egiadinh = null;
			$countegiadinh = 0;
		}		
	?>
	
	<h4 class="ui dividing header centered">GIA ĐÌNH</h4>
	<div id="giadinh" data-count="1"> 
		<div class="fields">	 								
			<div class="field two wide column">
				<label>Quan hệ</label>															
			</div>
			<div class="field four wide column">
				<label>Họ tên</label>
			</div>
			<div class="field two wide column">
				<label>Năm sinh</label>						
			</div>
			<div class="field two wide column">
				<label>Công việc</label>
			</div>
			<div class="field four wide column">
				<label>Nơi làm việc</label>
			</div>
			<div class="field two wide column">
				<label>Thu nhập</label>
			</div>
		</div>

		<?php $__currentLoopData = $egiadinh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $egd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($countgiadinh > $sttgd): ?>
			<div class="three fields" style="margin-top: 10px; margin-bottom: 10px;">
				<div class="field two wide column">
					<input type="text" name="quanhegiadinh[]" value="<?php echo e($giadinh->quanhe[$sttgd]); ?>" data-content="<?php echo e($egd->quanhe); ?>">	
				</div>
				<div class="field four wide column">
					<input type="text" name="hotengiadinh[]" value="<?php echo e(khongdau($giadinh->hoten[$sttgd])); ?>" data-content="<?php echo e($egd->hoten); ?>">
				</div>
				<div class="field two wide column">									
					<div class="ui calendar" id="namsinhgd">
							<input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="<?php echo e(khongdau($giadinh->namsinh[$sttgd])); ?>" data-content="<?php echo e($egd->namsinh); ?>">
					</div>
				</div>
				<div class="field two wide column">
					<input type="text" name="congviecgiadinh[]" value="<?php echo e(khongdau($giadinh->congviec[$sttgd])); ?>" data-content="<?php echo e($egd->congviec); ?>">
				</div>
				<div class="field four wide column">
					<div class="ui grid">
						<div class="ten wide column">
							<input type="text" name="noilamviecgiadinh[]" value="<?php echo e($giadinh->noilam[$sttgd]); ?>" data-content="<?php echo e($egd->noilamviec); ?>">
						</div>
						<div class="six wide column">
						<?php if(isset($giadinh->dctinh[$sttgd])): ?>
							<select name="gdtinhplus[]" class=" gd selection dropdown " >
								<option value="省" <?php if($giadinh->dctinh[$sttgd] == "省"): ?> selected <?php endif; ?>>省</option> 
								<option value="市" <?php if($giadinh->dctinh[$sttgd] == "市"): ?> selected <?php endif; ?>>市</option>  
								<option value=""></option>
							</select>
						<?php else: ?>
							<select name="gdtinhplus[]" class=" gd selection dropdown " >
								<option value=""></option>
								<option value="省">省</option> 
								<option value="市">市</option>  
								<option value=""></option>  
							</select>
						<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="field two wide column">
					<input type="text" class="thunhap" name="thunhapgiadinh[]" value="<?php echo e($giadinh->thunhap[$sttgd]); ?>" data-content="<?php echo e($egd->luong); ?>">
				</div>												
			</div>
		<?php else: ?>
			<div class="three fields" style="margin-top: 10px; margin-bottom: 10px">
				<div class="field two wide column">
					<input type="text" name="quanhegiadinh[]" value="<?php echo e($egd->quanhe); ?>" data-content="<?php echo e($egd->quanhe); ?>">	
				</div>
				<div class="field four wide column">
					<input type="text" name="hotengiadinh[]" value="<?php echo e(khongdau($egd->hoten)); ?>" data-content="<?php echo e($egd->hoten); ?>">
				</div>
				<div class="field two wide column">									
					<div class="ui calendar" id="namsinhgd">
						<input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="<?php echo e($egd->namsinh); ?>" data-content="<?php echo e($egd->namsinh); ?>">
					</div>
				</div>										
				<div class="field two wide column">
					<input type="text" name="congviecgiadinh[]" value="<?php echo e(khongdau($egd->congviec)); ?>" data-content="<?php echo e($egd->congviec); ?>">
				</div>
				<div class="field four wide column">
					<div class="ui grid">
						<div class="ten wide column">
							<input type="text" name="noilamviecgiadinh[]" value="<?php echo e(khongdau($egd->noilamviec)); ?>" data-content="<?php echo e($egd->noilamviec); ?>">
						</div>
						<div class="six wide column">
							<select name="gdtinhplus[]" class=" gd selection dropdown " >
								<option value=""></option>
								<option value="省">省</option> 
								<option value="市">市</option>  
								<option value=""></option>  
							</select>
						</div>
					</div>
				</div>
				<div class="field two wide column">
					<input type="text" class="thunhap" name="thunhapgiadinh[]" value="<?php echo e($egd->luong); ?>" data-content="<?php echo e($egd->luong); ?>">
				</div>												
			</div>
		<?php endif; ?>
		<?php 
			++$sttgd;
		?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>			
	<div class="inline field">
		<label>(*) Vui lòng nhập đầy đủ thông tin</label>
	</div>
</div>

</div>
</div>
</div>					
	        <div class="ui segment">
	          <div class="ui secondary menu">
	              <div class="right menu">
						<div id="re_edit" class="ui labeled icon button <?php if($hoso->re_edit == 1): ?> red  <?php endif; ?>  " 
							  id_re_edit="<?php echo e($hoso->id); ?>" re_edit="<?php echo e($hoso->re_edit); ?>">
							  <?php if($hoso->re_edit == 1): ?> <i class="check icon"></i>Đã yêu cầu sửa 
							  <?php else: ?> <i class="check icon"></i>Yêu cầu sửa  
							  <?php endif; ?> 
						</div>
						<button type="submit" class="ui labeled icon button green"><i class="save icon"></i>Lưu</button>
				  </div>
				  
	            </div>
	     	</div>
		</div>	     	
	</form>
	
<style>
	.infohead{position: absolute; z-index: 100000; top: 1px; right: 30px;}
</style>
<script type="text/javascript">	
	$("#namsinhgd").calendar({
		type: 'year'
	});		
</script>	
<script type="text/javascript">
$.ajaxSetup({
headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$("#re_edit").click(function(){
var id = $(this).attr('id_re_edit');
var re_edit = $(this).attr('re_edit');
$.post("/hoso/"+"re-edit/"+id,
{
	re_edit: re_edit
},
function(result){
	if (result == 'success') {
		location.reload();	
	}
});
});

$('.menu .item').tab();
$('.ui.selection.dropdown').dropdown({clearable: true});
$('input').popup({on: 'click'});
$('input').popup({on: 'focus'});
$('textarea').popup({ on: 'click'});
$('textarea').popup({on: 'focus'});
// nhập liệu hôn nhân
// $(".honnhannutchon").hide();
$(".honnhan").on('click','.honnhannutnhap',function(e){
	$('.honnhannhap').html('<input type="text" name="honnhan" placeholder="Hôn nhân">');
	$(".honnhanchon").hide();
	$(".honnhannutnhap").hide();
	$(".honnhannutchon").show();
});
$(".honnhan").on('click','.honnhannutchon',function(e){
	$('.honnhannhap').empty();
	$(".honnhanchon").show();
	$(".honnhannutchon").hide();
	$(".honnhannutnhap").show();
});
var valuehonnhan = $(".honnhanhidden").val();
if ((valuehonnhan == "独身") || (valuehonnhan == "既婚") || (valuehonnhan == "離婚") ) {
	$('.honnhannhap').empty();
	$(".honnhanchon").show();
	$(".honnhannutchon").hide();
	$(".honnhannutnhap").show();
}else{
	$('.honnhannhap').html('<input type="text" name="honnhan" placeholder="Hôn nhân" value="'+valuehonnhan+'">');
	$(".honnhanchon").hide();
	$(".honnhannutnhap").hide();
	$(".honnhannutchon").show();
}
//独身, 既婚, 離婚 => doc than, ket hon, ly hon
// nhập liệu tôn giáo
//$(".tongiaonutchon").hide();
$(".tongiao").on('click','.tongiaonutnhap',function(e){
	$('.tongiaonhap').html('<input type="text" name="tongiao" placeholder="Tôn giáo">');
	$(".tongiaochon").hide();
	$(".tongiaonutnhap").hide();
	$(".tongiaonutchon").show();
});
$(".tongiao").on('click','.tongiaonutchon',function(e){
	$('.tongiaonhap').empty();
	$(".tongiaochon").show();
	$(".tongiaonutchon").hide();
	$(".tongiaonutnhap").show();
});
var valuetongiao = $(".tongiaohidden").val();
if ((valuetongiao == "無") || (valuetongiao == "仏教") || (valuetongiao == "キリスト教") ) {
	$('.tongiaonhap').empty();
	$(".tongiaochon").show();
	$(".tongiaonutchon").hide();
	$(".tongiaonutnhap").show();
}else{
	$('.tongiaonhap').html('<input type="text" name="tongiao" placeholder="Tôn giáo" value="'+valuetongiao+'">');
	$(".tongiaochon").hide();
	$(".tongiaonutnhap").hide();
	$(".tongiaonutchon").show();
}
// 無, 仏教, キリスト教 => không, phật, thiên chúa

// nhat ngu
$(".select_nhatngu").on('change','#select_nhatngu',function(e){
	var a = $(this).val();
	$('#show_nhatngu').val(a);
});

// muc dich di nhat
$(".select_mucdich").on('change','#select_mucdich',function(e){
	var a = $(this).val();
	$('#show_mucdich').val(a);
});
// muc tieu ve nuoc
$(".select_muctieu").on('change','#select_muctieu',function(e){
	var a = $(this).val();
	$('#show_muctieu').val(a);
});

$(".thoigianhocbd,.thoigianhockt").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});			
$(".namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});		
$(".thunhap").inputmask("numeric", { radixPoint: ".", groupSeparator: ",",digits: 2, autoGroup: true, rightAlign: false,oncleared: function () { self.Value(''); }});					
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/hoso/add_hoso.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>