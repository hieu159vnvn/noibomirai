<?php $__env->startSection('title', 'Điểm danh'); ?>
<?php $__env->startSection('PageContent'); ?>
<?php
	function yearmonth($created_at){
		$timestamp = strtotime(date("Y-m-d H:i:s"));
    	$year = date("Y", $timestamp);
		$month = date("m", $timestamp);
		return $year."/".$month;
	}
	
?>
<h2 class="ui header center aligned">
ĐIỂM DANH  
<div class="sub header">
	<h3>Lớp Học : <?php echo e($lop->ten_lop_hoc); ?></h3>
</div>
</h2>
<h4>GIÁO VIÊN: <img src="<?php echo e($lop->hinhanh); ?>" alt="" style="height: 40px;"> <?php echo e($lop->hoten); ?></h4> 
<?php if(session('status')): ?>
<div class="ui message">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p><?php echo e(session('status')); ?></p>
</div>
<?php endif; ?>	
<form class="ui form" action="" method="post" name="form_1" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>	
	<div class="field">
	<?php if(!$dbcheck || ($dbcheck == null)): ?>
	
		<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr>
					<th class="td collapsing">TÊN HỌC VIÊN</th>
					<th class="collapsing">HIỆN DIỆN</th>
					<th class="collapsing">NGHỈ PHÉP</th>
					<th>LÝ DO</th>
				</tr>
			</thead>
			<tbody style="text-align: left;">
				<?php $__currentLoopData = $hocvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<input type="hidden" name="id_hocvien[]" value="<?php echo e($hv->id); ?>">
					<tr class="diemdanh">
						<td class="collapsing"><h4><?php echo e($hv->hoten); ?></h4></td>
						<td class="collapsing vangmat">
							<div class="ui toggle checkbox">
								<input type="checkbox"  class="checked" name="vang[]" value="<?php echo e($hv->id); ?>">
								<label>vắng mặt</label>
							</div>
						</td>
						<td class="collapsing phep">
							<span class="container">
								<div class="ui toggle checkbox">
									<input type="checkbox"  class="checked" name="phep[]" value="<?php echo e($hv->id); ?>">
									<label>Có phép</label>
								</div> &nbsp;
								<div class="ui toggle checkbox">
									<input type="checkbox"  class="checkedtre" name="tre[]" value="<?php echo e($hv->id); ?>">
									<label>Đi Trễ</label>
								</div>
							</span>
						</td>
						<td class="lydo">
							<div class="ui form">
								<div class="inline fields">
									<div class="field">
										<div class="container_field">
											<label for="file-<?php echo e($hv->id_hocvien); ?>" class="ui icon button">
												<i class="cloud icon"></i> Phép
											</label>
											<input type="file" name="donphep[]" class="imageUpload" accept=".png, .jpg, .jpeg" id="file-<?php echo e($hv->id_hocvien); ?>" style="display: none">
										</div>
									</div>
									<div class="field">
										<div class="container_close">
											<div class="closed" ><i class="large icon"></i></div>
										</div>
									</div>
									<div class="field">
										<div class="container_preview">
											<img class="imagePreview" src="" alt="" height="35px">
										</div>
									</div>
									<div class="ten wide field">
										<input type="text" class="container" name="lydo[]" value="" placeholder="Lý do">
									</div>
									<div class="field">
										<select name="tiet[]" class="ui dropdown containertre" >
											<option value="">Chọn Tiết</option>
											<?php for( $i = 1; $i < 8; $i++ ): ?>
												<option value="<?php echo e($i); ?>">Tiết <?php echo e($i); ?></option>
											<?php endfor; ?>
										</select>
									</div>
								</div>
							</div>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
			</tbody>
		</table>					
	<?php else: ?>
		<input type="hidden" name="id_lop" value="<?php echo e($dbcheck->id_lop); ?>">
	
		<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr >
					<th class="collapsing">TÊN HỌC VIÊN</th>
					<th class="collapsing">HIỆN DIỆN</th>
					<th class="collapsing">NGHỈ PHÉP</th>
					<th>LÝ DO</th>					          
				</tr>
			</thead>
			<tbody style="text-align: left;">
				<?php $__currentLoopData = $hocvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<input type="hidden" name="id_hocvien[]" value="<?php echo e($hv->id_hocvien); ?>">
				<input type="hidden" name="id_diemdanh[]" value="<?php echo e($hv->id_diemdanh); ?>">
				<input type="hidden" name="id[]" value="<?php echo e($hv->id); ?>">
				<input type="hidden" class="duyet" name="duyet[]" value="<?php echo e($hv->duyet); ?>">
				<tr class="diemdanh">
					<td class="collapsing">
						<?php echo e($hv->hoten); ?>

					</td>
					<td class="collapsing vangmat ">
						<div class="ui toggle checkbox">
						  <input type="checkbox" class="checked" <?php if($hv->vang == 1): ?> checked <?php endif; ?> name="vang[]" value="<?php echo e($hv->id_hocvien); ?>">
						  <label>Vắng mặt</label>
						</div>
					</td>
					<td class="collapsing phep">
						<div class="container">
							<div class="ui toggle checkbox">
								<input type="checkbox" class="checked" <?php if($hv->phep == 1): ?> checked <?php endif; ?> name="phep[]" value="<?php echo e($hv->id_hocvien); ?>">
								<label>Có phép</label>
							</div>&nbsp;
							<div class="ui toggle checkbox">
								<input type="checkbox" <?php if($hv->tre == 1): ?> checked <?php endif; ?>  class="checkedtre" name="tre[]" value="<?php echo e($hv->id_hocvien); ?>">
							 	<label>Đi Trễ</label>
							</div>
						</div>
					</td>
					<td class="lydo">
						<div class="ui form">
							<div class="inline fields">
								<div class="field">
									<div class="container_field">
										<label for="file-<?php echo e($hv->id_hocvien); ?>" class="ui icon button">
											<i class="cloud icon"></i>
										</label>
										<input type="file" name="donphep[]" class="imageUpload" accept=".png, .jpg, .jpeg" id="file-<?php echo e($hv->id_hocvien); ?>" style="display: none">
										<input type="hidden" name="donphephide[]" class="filehide" value="<?php echo e($hv->donphep); ?>">
									</div>
								</div>
								<div class="field">
									<div class="container_close">
										<?php if($hv->donphep): ?>
											<div class="closed"><i class="large icon close gray"></i></div>
										<?php else: ?>
											<div class="closed" ><i class="large icon"></i></div>
										<?php endif; ?>
									</div>
								</div>
								<div class="field">
									<div class="container_preview">
										<?php if($hv->donphep): ?>
											<a href="<?php echo e(url('uploads/daotao/phep')); ?>/<?php echo e(yearmonth($hv->created_at)); ?>/<?php echo e($hv->donphep); ?>?v=<?php echo e(time()); ?>">
												<img class="imagePreview" src="<?php echo e(url('uploads/daotao/phep')); ?>/<?php echo e(yearmonth($hv->created_at)); ?>/<?php echo e($hv->donphep); ?>?v=<?php echo e(time()); ?>" height="35px">
											</a>
										<?php else: ?>							
											<img class="imagePreview" src="" alt="" height="35px">
										<?php endif; ?>
									</div>
								</div>
								<div class="ten wide field">
									<input type="text" class="container" name="lydo[]" value="<?php echo e($hv->lydo); ?>" placeholder="Lý do">
								</div>
								<div class="field">
									<select name="tiet[]" class="ui dropdown containertre" >
										<option value="">Chọn Tiết</option>
										<?php for( $i = 1; $i < 8; $i++ ): ?>
											<option <?php if($hv->tiet == $i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>">Tiết <?php echo e($i); ?></option>
										<?php endfor; ?>
									</select>
								</div>
							</div>
						</div>

					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		
	<?php endif; ?>
	<p class="p"></p>
	<div class="ui two column  grid">
		<div class="eight wide column">
			<?php if($dbcheck || ($dbcheck != null)): ?>
				<?php if($dbcheck->khoaduyet == 1 ): ?>
					<div class="ui labeled icon button red"><i class="circle icon"></i>Đã khóa</div>
					<?php if(Auth::user()->hasRole('Đào Tạo')): ?>
						<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý </button> (trường bộ phận đào tạo có quyền sửa)
					<?php else: ?>
						<div class="ui labeled icon button red checkk"><i class="save icon"></i>Đồng ý</div>
					<?php endif; ?>
				<?php else: ?>
					<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý</button>
				<?php endif; ?>
			<?php else: ?>
				<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý</button>
			<?php endif; ?>
		</div>
	</div>
	<br>
	
	<?php if($dbcheck || ($dbcheck != null)): ?>
		<h3 class="ui red label">Kết quả điểm danh ngày <?php echo e(date("d-m-Y")); ?></h3>
		<table  class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr>
					<th>TÊN HỌC VIÊN</th>
					<th>ĐIỂM DANH</th>
					<th>LÝ DO</th>
					<th>DUYỆT</th>					          
				</tr>
			</thead>
			<tbody style="text-align: left;">
				<?php $__currentLoopData = $hocvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
				<tr>
					<td>
						<?php echo e($hv->hoten); ?>

					</td>
					<td>
						<?php if($hv->vang != 1): ?>
							<span class="ui blue basic label"><i class="small checkmark icon blue"></i> CÓ MẶT </span>
						<?php else: ?>
							<?php if($hv->tre == 1): ?>
								<span class="ui yellow basic label">
									<i class="large close icon red"></i> TRỄ </label>
								</span>
								<div class="ui left pointing black label"> Tiết <?php echo e($hv->tiet); ?></div>	
							<?php else: ?>
								<?php if($hv->phep == 1): ?>
									<span class="ui orange basic label"><i class="large icon close red"></i> CÓ PHÉP </span>
								<?php else: ?>
									<span class="ui red basic label"><i class="large icon close red"></i> KHÔNG PHÉP </span>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if($hv->lydo): ?>
							<label>Lý do: <?php echo e($hv->lydo); ?></label>
						<?php endif; ?>
					</td>
					<td>
						<?php if($hv->duyet || ($dbcheck->khoaduyet == 1)): ?> 
							<span class="ui blue label"> <i class="icon check red"></i> Đã xác nhận</span>
						<?php else: ?>
							<span class="ui red label"> <i class="icon close red"></i> Chưa xác nhận</span>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	<?php endif; ?>
</form>
	
<script type="text/javascript">
$('.ui.dropdown').dropdown();
	function readURL(input, previewId) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(previewId).attr('src',e.target.result)
				$(previewId).hide();
				$(previewId).fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		$('.nutluu').hide();
		var length = $( '.diemdanh').length;
		var i;
			
		$('.phep .container').hide();
		$('.lydo .container').hide();
		$('.lydo .containertre').hide();
		$('.lydo .container_field').hide();
		for (i = 0; i < length; i++) {
			checked(i);
			image(i);
			closed(i);
			popupimg(i);
		}
		function image(i) {
			$(".imageUpload:eq("+i+")").change(function() {
				readURL(this, '.imagePreview:eq('+i+')');
				$(".closed:eq("+i+")").remove();
				$(".container_close:eq("+i+")").append('<div class="closed"><i class="large icon close gray"></i></div>');
			});  
		}
		function closed(i) {
			$("#data-table").on("click",".closed:eq("+i+")",function() {
				$(".imageUpload:eq("+i+")").val('');
				$(".filehide:eq("+i+")").val('');
				$(this).remove();
				$(".imagePreview:eq("+i+")").attr('src','');		
			});  
		}
		function popupimg(i) {
			$('.imagePreview:eq('+i+')').popup();
		}
		function checked(i){
			$('.vangmat .checked:eq('+ i +')').click(function(){
				$('.phep .checked:eq('+ i +')').prop( "checked", false);
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", false);
				var checked = $('.vangmat .checked:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.phep .container:eq('+ i +')  ').show();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .containertre:eq('+ i +')  ').hide();
				}else {
					$('.phep .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .containertre:eq('+ i +')  ').hide();
					$('.lydo .container_field:eq('+ i +')  ').hide();
					$('.lydo .container_preview:eq('+ i +')  ').hide();
					$('.lydo .container_close:eq('+ i +')  ').hide();
					$(".filehide:eq("+i+")").val('');
					$('.lydo .container:eq('+ i +')  ').val('');

				}
			});
			$('.phep .checked:eq('+ i +')').click(function(){
				$('.vangmat .checked:eq('+ i +')').prop( "checked", true );
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", false);
				var checked = $('.phep .checked:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.lydo .container:eq('+ i +')  ').show();
					$('.lydo .containertre:eq('+ i +')  ').hide();
					$('.lydo .container_field:eq('+ i +')  ').show();
				}else {
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').val('');
					$('.lydo .container_field:eq('+ i +')  ').hide();
					$('.lydo .container_preview:eq('+ i +')  ').hide();
					$('.lydo .container_close:eq('+ i +')  ').hide();
				}
			});
			$('.phep .checkedtre:eq('+ i +')').click(function(){
				$('.vangmat .checked:eq('+ i +')').prop( "checked", true );
				$('.phep .checked:eq('+ i +')').prop( "checked", false);
				var checked = $('.phep .checkedtre:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.lydo .containertre:eq('+ i +')  ').show();
					$('.lydo .container:eq('+ i +')  ').show();
					$('.lydo .container_field:eq('+ i +')  ').show();
				}else {
					$('.lydo .containertre:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').val('');
					$('.lydo .container_field:eq('+ i +')  ').hide();
					$('.lydo .container_preview:eq('+ i +')  ').hide();
					$('.lydo .container_close:eq('+ i +')  ').hide();
					// $('.lydo .containertre:eq('+ i +')').prop('selected', function() {
					// 	return this.defaultSelected;
					// });
					$('.lydo .containertre:eq('+ i +')  ').val('');
				}
			});
			if ($('.vangmat .checked:eq('+ i +')').is(":checked") == true) {
				$('.phep .container:eq('+ i +')  ').show();
				$('.lydo .container:eq('+ i +')  ').hide();
			}else {
				$('.phep .container:eq('+ i +')  ').hide();
				$('.lydo .container:eq('+ i +')  ').hide();
				$('.lydo .containertre:eq('+ i +')  ').hide();
			}
			if ($('.phep .checked:eq('+ i +')').is(":checked") == true) {
				$('.lydo .container:eq('+ i +')  ').show();
				$('.lydo .container_field:eq('+ i +')  ').show();
			}
			if ($('.phep .checkedtre:eq('+ i +')').is(":checked") == true) {
				$('.lydo .containertre:eq('+ i +')  ').show();
				$('.lydo .container:eq('+ i +')  ').show();
				$('.lydo .container_field:eq('+ i +')  ').show();
			}
		}
	});
</script>
	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<style>
	.gray1{
		background: gray !important;
	}
</style>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>