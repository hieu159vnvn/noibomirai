<?php $__env->startSection('title', 'Thêm cảm nhận'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM CẢM NHẬN </h1>
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
			<form class="ui form" action="" method="post" name="form_1">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">			
						<div class="two fields">
							<div class="field">
								<label>Tên học viên)</label>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="tenhocvien" value="<?php echo e(old('tenhocvien')); ?>" required>
								</div>
							</div>
							<div class="field">
								<label>Ngành nghề</label>
								<div class="ui input left icon">							
								<i class="language icon"></i>
								<input type="text" name="nganhnghe" value="<?php echo e(old('nganhnghe')); ?>">
								</div>
							</div>
							<div class="field">
								<label>Ngành nghề jp</label>
								<div class="ui input left icon">							
								<i class="language icon"></i>
								<input type="text" name="nganhnghejp" value="<?php echo e(old('nganhnghejp')); ?>">
								</div>
							</div>
						</div>
						<div class="two fields">
							<div class="field">
								<label>Nội dung</label>
								<div class="ui input left icon">							
								
								<textarea name="noidung" value="<?php echo e(old('noidung')); ?>"></textarea>
								</div>
							</div>
							<div class="field">
								<label>Nội dung JP</label>
								<div class="ui input left icon">							
								
								<textarea name="noidungjp" value="<?php echo e(old('noidungjp')); ?>"></textarea>
								</div>
							</div>
						</div>
						<div class="field">
							<div class="ui medium icon buttons">
								<a class="ui secondary button iframe-btn fancy" href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Ảnh Thumb</a>
								<div class="ui button" onclick="clear_img()"><i class="cancel icon"> </i> HỦY</div>
							</div>
							<br>
							<img src="<?php echo e(url('uploads/no-image.jpg')); ?>" alt="" id="prev_img" class=" medium ui image bordered img-thumbnail ">
							<input name="image" type="hidden" value="" id="none_img" class="form-control">
						</div>	
					</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="<?php echo e(url('camnhan')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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
<link rel="stylesheet" href="fancybox/jquery.fancybox.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<link  href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>