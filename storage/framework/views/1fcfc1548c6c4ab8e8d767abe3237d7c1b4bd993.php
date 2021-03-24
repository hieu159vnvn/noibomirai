<?php $__env->startSection('title', 'Sửa video'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA VIDEO</h1>
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
					<a href="<?php echo e(url('video/add')); ?>" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
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
					<div class="two fields">
						<div class="field">
							<label>Tên tiêu đề (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="ten" value="<?php echo e($video->ten); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>slug (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="slug" value="<?php echo e($video->slug); ?>" required>
							</div>
						</div>
						
					</div>
					<div class="four fields">
						<div class="field">
							<label>loại link video</label>
							<div class="ui input left icon">							
							<select name="loai" >
								<option value=""  <?php if($video->loai == ''): ?> selected <?php endif; ?>>Chọn</option>
								<option value="youtube" <?php if($video->loai == 'youtube'): ?> selected <?php endif; ?>>youtube</option>
								<option value="JP" <?php if($video->loai == 'JP'): ?> selected <?php endif; ?>>JP</option>
							</select>
							</div>
						</div>
						<div class="twelve wide field">
							<label>Link video</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="link" value="<?php echo e($video->link); ?>" >
							</div>
						</div>
					</div>
					
					
					<div class="four fields">
						<div class="field">
							<label>Sắp xếp </label>
							<div class="ui input left icon">							
							<i class="sort icon"></i>
							<input type="number" name="sapxep" value="<?php echo e($video->sapxep); ?>" >
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui form">
							<div class="inline field">
								<div class="ui toggle checkbox">
									<input name="stt" type="checkbox" <?php if($video->stt == 1): ?> checked <?php endif; ?> >
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
						<a href="<?php echo e(url('video')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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
<script src="fancybox/vhn_customs/config_Fancybox_video.js"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>