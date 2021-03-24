<?php $__env->startSection('title', 'Thêm hình ảnh'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM HÌNH ẢNH </h1>
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
								<label>Tên tiêu đề (*)</label>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="ten" value="<?php echo e(old('ten')); ?>" required>
								</div>
							</div>
							<div class="field">
								<label>Tên tiêu đề (tiếng Nhật)</label>
								<div class="ui input left icon">							
								<i class="language icon"></i>
								<input type="text" name="tenjp" value="<?php echo e(old('tenjp')); ?>">
								</div>
							</div>
						</div>
						<div class="field">
							<div class="">
								<a class="ui secondary button iframe-btn fancy" 
								href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Gallery (555x370)</a>
							</div>
							<br>
							<div class="grid-container">
								
							</div>
							<input type="hidden" id="none_img">
						</div>
						<div class="four fields">
							<div class="field">
								<label>Sắp xếp </label>
								<div class="ui input left icon">							
								<i class="sort icon"></i>
								<input type="number" name="sapxep" value="<?php echo e(old('sapxep')); ?>" >
								</div>
							</div>
						</div>
						<div class="field">
							<div class="ui form">
								<div class="inline field">
									<div class="ui toggle checkbox">
										<input name="stt" type="checkbox" tabindex="0" checked>
										<label>Phát hành</label>
									</div>
								</div>
							</div>
						</div>
						<div class="inline field">
						<label>(*) Trường bắt buộc phải nhập</label>
						</div>		
					</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="<?php echo e(url('hinhanh')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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
<link rel="stylesheet" href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox_gallery.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>