<?php $__env->startSection('title', 'Điểm danh'); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="ui two column centered grid wrap-content-header">
	<h1 class="ui header centered page-title">QUẢN LÝ ĐIỂM DANH</h1>
</div>

<?php if(session('status')): ?>
<div class="ui message">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p><?php echo e(session('status')); ?></p>
</div>
<?php endif; ?>	
<div class="ajax-messenger"></div>
<div class="ui two column centered grid main-content">
	<div class="fifteen wide column">
		<form class="ui form" action="" method="post" name="form_1">
			<?php echo e(csrf_field()); ?>	

			<div class="field">


			</div>
			<div class="ui two column centered grid">
				<h2 class="ui header centered ">Ngày 
					<?php
					$date=date_create($mdate);
					echo date_format($date,"d - m - Y");
					?>
				</h2>	
			</div>
			<?php
			if ($mdata) {
				$data = json_decode($mdata, true);
			}else{
				$data = json_decode("{}", true);;
			}
			
			?>	
			<?php $__currentLoopData = $mid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($key == $id): ?>
			<?php $__currentLoopData = $mdaotao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mdt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
				<?php if($key == $mdt->id): ?> 
					<h3><span class="ui basic label">LỚP <?php echo e($mdt->ten_lop_hoc); ?></span> - Phòng đạo tạo <a class="ui label basic blue" href="<?php echo e(url('diemdanh/'.$key.'/add')); ?>"> Cập nhật </a></h3>
					
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<table id="data-table" class="ui selectable celled striped table">
				<input type="text" class="mkey" name="mkey" value="<?php echo e($key); ?>">
				<thead class="full-width">
					<tr style="text-align: left;">
						<th>TÊN HỌC VIÊN</th>
						<th>ĐIỂM DANH</th>
						<th>LÝ DO</th>
						<th>DUYỆT</th>					          
					</tr>
				</thead>
				<tbody style="text-align: left;">
					<?php $__currentLoopData = $hv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lkey => $lhv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr class="diemdanh">
						<td>
							<?php $__currentLoopData = $mhocvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if( $mhv->id == $lhv['id'] ): ?>
									<?php echo e($mhv->hoten); ?>

								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
						<td>
							<span class="comat">
								<input type="checkbox"  class="checked" <?php if($lhv['checked'] == "comat") {echo "checked";} ?> name="diemdanh" value="<?php echo e($lhv['id']); ?>">
							</span>
							<span class="vangmat"><input type="checkbox"  class="checked" <?php if($lhv['checked'] == "khongphep") {echo "checked";} ?> name="vang" value="<?php echo e($lhv['id']); ?>">
							</span>
							<span class="phep">
								<input type="checkbox"  class="checked" <?php if($lhv['checked'] == "cophep") {echo "checked";} ?> name="phep" value="<?php echo e($lhv['id']); ?>">
							</span>
							<span class="tre">
								<input type="checkbox"  class="checked" <?php if($lhv['checked'] == "tre") {echo "checked";} ?> name="tre" value="<?php echo e($lhv['id']); ?>">
							</span>
							<?php if($lhv['checked'] == "comat"): ?>
							<span class="ui blue basic label"><i class="large check icon blue"></i> CÓ MẶT </span>
							<?php elseif($lhv['checked'] == "cophep"): ?>
							<span class="ui orange basic label"><i class="large close icon red"></i> CÓ PHÉP </span>
							<?php elseif($lhv['checked'] == "khongphep"): ?>
							<span class="ui red basic label"><i class="large close icon red"></i> KHÔNG PHÉP </span>
							<?php elseif($lhv['checked'] == "tre"): ?>
							<span class="ui yellow basic label"><i class="large close icon red"></i> ĐI TRỄ </span>
							<?php endif; ?>
						</td>
						<td>
							<?php if(isset($lhv['tre'])): ?>
								<label class="ui basic label">TIẾT <?php echo e($lhv['tre']); ?></label>
							<?php endif; ?>
							<?php if($lhv['ly-do']): ?>
								<span> lý do: <?php echo e($lhv['ly-do']); ?> </span>
							<?php endif; ?>
							<span class="lydo">
								<?php if($lhv['ly-do']): ?>
									<input type="text" class="container" name="lydo" value="<?php echo e($lhv['ly-do']); ?>">
								<?php else: ?>
									<input type="text" class="container" name="lydo" value="">
								<?php endif; ?>
							</span>
							<span class="tretiet">
								<?php if(isset($lhv['tre'])): ?>
									<input type="text" class="container" name="tre" value="<?php echo e($lhv['tre']); ?>">
								<?php else: ?>
									<input type="text" class="container" name="tre" value="">
								<?php endif; ?>
							</span>
						</td>
						<td class="duyet">
							<?php if($lhv['ly-do']): ?>
								<?php if($lhv['duyet'] != "ok"): ?>
									<div class="ui toggle checkbox">
									  <input type="checkbox" class="checked" name="duyet" value="<?php echo e($lhv['id']); ?>">
									  <label>XÁC NHẬN</label>
									</div>
								<?php else: ?>
									<span class="ui blue label">đã xác nhận</span>
									<input type="checkbox" class="checked" name="duyet" checked value="<?php echo e($lhv['id']); ?>" style="display: none;">
								<?php endif; ?>
							<?php else: ?>
								<input type="checkbox" class="checked" name="duyet" value="<?php echo e($lhv['id']); ?>" style="display: none;">
							<?php endif; ?>	
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	

		</tbody>
	</table>
	<p class="p"></p>
	<div class="ui two column centered grid">
		<div class="eight wide column">
			<a href="<?php echo e(url('diemdanh/manage')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
			<button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i>Xác nhận</button>
		</div>
	</div>
</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".mkey").hide();
		$(".comat").hide();
		$(".vangmat").hide();
		$(".phep").hide();
		$(".lydo").hide();
		$(".tre").hide();
		$(".tretiet").hide();
		$(".nutluu").click(function(){
		var sArr = new Array();
		var jlength = $( 'table').length;
		for (var j = 0; j < jlength; j++) {
			$("table:eq("+j+")").addClass("table"+j);
			var length = $( 'table:eq("'+j+'") .diemdanh').length;
			var i;
			var arr = new Array();
			for (i = 0; i < length; i++) {
				var vang = $('table:eq("'+j+'") .vangmat .checked:eq('+ i +')').is(":checked");
				var phep = $('table:eq("'+j+'") .phep .checked:eq('+ i +')').is(":checked");
				var duyet = $('table:eq("'+j+'") .duyet .checked:eq('+ i +')').is(":checked");
				var tre = $('table:eq("'+j+'") .tre .checked:eq('+ i +')').is(":checked");
				if (vang == true) {
					arr.push('{"id":'+ '"'+$(".table:eq("+j+")"+" .phep .checked:eq("+i+")").val()+'","checked":"khongphep","ly-do":"","duyet":""}');
				}else{
					if (phep == true) {
						if (duyet == true) {
							arr.push('{"id":'+'"'+$(".table:eq("+j+")"+" .phep .checked:eq("+i+")").val()+'","checked":"cophep","ly-do":"'+$('.table:eq('+j+')'+' .lydo .container:eq('+ i +')').val()+'","duyet":"ok"}');
						}else{
						arr.push('{"id":'+'"'+$(".table:eq("+j+")"+" .phep .checked:eq("+i+")").val()+'","checked":"cophep","ly-do":"'+$('.table:eq('+j+')'+' .lydo .container:eq('+ i +')').val()+'","duyet":""}');
						}
					}
					else if (tre == true) {
						if (duyet == true) {
							arr.push('{"id":'+'"'+$(".table:eq("+j+")"+" .tre .checked:eq("+i+")").val()+'","checked":"tre","ly-do":"'+$('.table:eq('+j+')'+' .lydo .container:eq('+ i +')').val()+'","duyet":"ok","tre":"'+$('.table:eq('+j+')'+' .tretiet .container:eq('+ i +')').val()+'"}');
						}else{
						arr.push('{"id":'+'"'+$(".table:eq("+j+")"+" .tre .checked:eq("+i+")").val()+'","checked":"tre","ly-do":"'+$('.table:eq('+j+')'+' .lydo .container:eq('+ i +')').val()+'","duyet":"","tre":"'+$('.table:eq('+j+')'+' .tretiet .container:eq('+ i +')').val()+'"}');
						}
					}
					else {
						arr.push('{"id":'+'"'+$(".table:eq("+j+")"+" .comat .checked:eq("+i+")").val()+'","checked":"comat","ly-do":"","duyet":""}');
					}
				}
			}
			var a = $(".mkey:eq('"+j+"')").val();
			sArr[i] = ',"'+a+'":['+arr.toString()+']';
		}
		var str = sArr.join("");
		console.log(str);
		$(".p").append(" <input type='hidden' name='diemdanhsave' value='"+str+"'>");
});
	});
</script>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<script src="<?php echo e(url('js/admin/hoso/add_hoso.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>