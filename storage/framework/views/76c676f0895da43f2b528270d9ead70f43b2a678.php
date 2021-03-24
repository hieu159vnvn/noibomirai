<?php $__env->startSection('title', 'Sửa Banner'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA BANNER</h1>
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
				
				<div class="right menu">
					<div class="item">
					<a href="<?php echo e(url('banner/add')); ?>" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
					</div>
				</div>
				
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
						<div class="field">
							<div class="ui medium icon buttons">
								<a class="ui secondary button iframe-btn fancy" href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Ảnh Logo</a>
								<div class="ui button" onclick="clear_img()"><i class="cancel icon"> </i> HỦY</div>
							</div>
							<br>
							<?php if($banner->image): ?>
								<img src="<?php echo e(url($banner->image)); ?>" alt="" id="prev_img" class="medium  ui image bordered img-thumbnail">
							<?php else: ?>
								<img src="<?php echo e(url('uploads/no-image.jpg')); ?>" alt="" id="prev_img" class="medium  ui image bordered img-thumbnail">
							<?php endif; ?>
							
							<input name="image" type="hidden" value="<?php echo e(url($banner->image)); ?>" id="none_img" class="form-control">
						</div>
						<div class="field">
							<label>Link</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="link" value="<?php echo e($banner->link); ?>" >
							</div>
						</div>
						<div class="field">
							<div class="ui form">
								<div class="inline field">
									<div class="ui toggle checkbox">
										<input name="stt" type="checkbox" tabindex="0" <?php if($banner->stt == 1): ?> checked <?php endif; ?>>
										<label>Phát hành</label>
									</div>
								</div>
							</div>
						</div>		
					</div>	
					<div class="ui ">
						<div class="eight wide column">
							<a href="<?php echo e(url('banner')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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
<link rel="stylesheet" href="fancybox/jquery.fancybox.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<link  href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox.js"></script>

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>