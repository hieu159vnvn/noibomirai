<?php $__env->startSection('title', 'Thêm ký túc xá'); ?>
<?php $__env->startSection('PageContent'); ?>
	<?php
		function ym($time) {
			$timestamp = strtotime($time);
			$year = date("Y", $timestamp);
			$month = date("m", $timestamp);
			return $year.'/'.$month;
		}
	?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM KÝ TÚC XÁ</h1>
	</div>
	
	<?php if($errors->any()): ?>
	    <div class="alert alert-danger">
	        <ul>
	            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <li><?php echo e($error); ?></li>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </ul>
	    </div>
	<?php endif; ?>	
	<div class="ajax-messenger"></div>
	<div class="ui two column centered grid main-content">
		<div class="fifteen wide column">
			<?php if(session('status')): ?>
				<div class="ui positive message">
				<i class="close icon"></i>
				<div class="header">
					Thông Báo !
				</div>
				<p><?php echo e(session('status')); ?></p>
				</div>
			<?php endif; ?>
			<?php if(session('error')): ?>
				<div class="ui negative message">
				<i class="close icon"></i>
				<div class="header">
					Thông Báo !
				</div>
				<p><?php echo e(session('error')); ?></p>
				</div>
			<?php endif; ?>
			<form class="ui form" action="" method="post" name="form_1" id="form" data_id="add" autocomplete="off">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">			
					<div class="field">
						<label>Tên phòng (*)</label>
						<div class="ui input left icon">							
						<i class="home icon"></i>
						<input type="text" name="tenphong" value="<?php echo e(old('tenphong')); ?>" required>
						</div>
					</div>
					<div class="field">
						<label>Số học viên tối đa (*)</label>
						<div class="ui input left icon">							
						<i class="user icon"></i>
						<input type="number" name="sohocvien" value="<?php echo e(old('sohocvien')); ?>" required>
						</div>
					</div>
				</div>
				<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
				</div>	
				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="<?php echo e(url('/kitucxa/danhsachphong')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>