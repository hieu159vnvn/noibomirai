<?php $__env->startSection('title', 'Thêm Nghiệp Đoàn'); ?>
<?php $__env->startSection('PageContent'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM NGHIỆP ĐOÀN</h1>
	</div>	

	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			<?php if($errors->any()): ?>
				<div class="ui red message">
					<i class="close icon"></i>
					<div class="header">
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <li><?php echo e($error); ?></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			<?php endif; ?>
			<form class="ui form" action="" method="post" name="form_1">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">
									
					<div class="two fields">
						<div class="field">
							<label>Tên nghiệp đoàn (*)</label>
							<div class="ui fluid search selection dropdown">
								
								<i class="dropdown icon"></i>
								<input class="search tennghiepdoan" name="tennghiepdoan">
								<div class="default text">Nhập tên nghiệp đoàn</div>
								<div class="menu">
									<?php $__currentLoopData = $nghiepdoan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="item"><?php echo e($item->tennghiepdoan); ?></div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
						<div class="field">
							<label>Địa chỉ (*)</label>
							<div class="ui input left icon">							
							<i class="map icon"></i>
							<input type="text" name="diachi" value="<?php echo e(old('diachi')); ?>" required>
							</div>
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Người đại diện (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="nguoidaidien" value="<?php echo e(old('nguoidaidien')); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>Số điện thoại</label>
							<div class="ui input left icon">							
							<i class="mobile icon"></i>
							<input type="text" name="dienthoai" value="<?php echo e(old('dienthoai')); ?>">
							</div>
						</div>
						<div class="field">
							<label>Email</label>
							<div class="ui input left icon">							
							<i class="mail icon"></i>
							<input type="text" name="email" value="<?php echo e(old('email')); ?>">
							</div>
						</div>
					</div>
					<div class="field">
						<label>Ghi chú (Nếu có)</label>
						<textarea rows="10" name="ghichu" placeholder="Nội dung..."><?php echo e(old('ghichu')); ?></textarea>
					</div>
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>	

				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="<?php echo e(url('nghiepdoan')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<script>
	$('.ui.selection.dropdown').dropdown({clearable: true});
</script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>