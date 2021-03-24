<?php $__env->startSection('title', 'Sửa Lịch Công Tác'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA LỊCH CÔNG TÁC</h1>
	</div>	
	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			<?php if($errors->any()): ?>
			    <div class="alert alert-danger">
			        <ul>
			            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <li><?php echo e($error); ?></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </ul>
			    </div>
			<?php endif; ?>
			<div class="ui secondary menu">
				
				
				
			</div> 
			<?php if(session('status')): ?>
				<div class="ui positive message">
					<i class="close icon"></i>
					<div class="header">
						Thông Báo !
					</div>
					<p><?php echo e(session('status')); ?></p>
				</div>
			<?php endif; ?>
			<form class="ui form" action="" method="post" name="form_1">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">			
					<div class="two fields">
						<div class="field">
							<label>Tên sự kiện (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="event_name" value="<?php echo e($item->event_name); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>Color</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="color" name="color" value="<?php echo e($item->color); ?>" required style="height:34.63px">
							</div>
						</div>
					
					</div>
					<div class="two fields">
						<div class="field">
							<label>Ngày bắt đầu</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="start_date" value="<?php echo e($item->start_date); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>Ngày kết thúc</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="end_date" value="<?php echo e($item->end_date); ?>" required>
							</div>
						</div>
					</div>
					
					
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="<?php echo e(url('danhsachlich')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right-(//)"><i class="save icon"></i>Lưu</button>
					</div>
				</div>

				
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>

<base href="<?php echo e(asset('')); ?>">
<script src="tinymce/tinymce.min.js"></script>
<script src="tinymce/config_Tinymce.js"></script>
<script>
	$('.menu .item').tab();
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>