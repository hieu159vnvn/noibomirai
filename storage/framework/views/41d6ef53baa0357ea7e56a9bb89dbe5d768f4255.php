<?php $__env->startSection('title', 'Sửa Bài Viết'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA BÀI VIẾT</h1>
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
							<label>Tên tiêu đề (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="ten" value="<?php echo e($baiviet->ten); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>slug (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="slug" value="<?php echo e($baiviet->slug); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>Tên tiêu đề (tiếng Nhật)</label>
							<div class="ui input left icon">							
							<i class="language icon"></i>
							<input type="text" name="tenjp" value="<?php echo e($baiviet->tenjp); ?>">
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui top attached tabular menu">
							<a class="item active" data-tab="first"><label><i class="edit icon"></i> Nội dung </label></a>
							<a class="item" data-tab="second"><label><i class="language icon"></i> Nội dung (tiếng Nhật) </label></a>
							
						</div>
						<div class="ui bottom attached tab segment active" data-tab="first">
							<textarea name="noidung" class="textarea-1000"><?php echo e($baiviet->noidung); ?></textarea>
						</div>
						<div class="ui bottom attached tab segment" data-tab="second">
							<textarea name="noidungjp" class="textarea-1000"><?php echo e($baiviet->noidungjp); ?></textarea>
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Sắp xếp </label>
							<div class="ui input left icon">							
							<i class="sort icon"></i>
							<input type="number" name="sapxep" value="<?php echo e($baiviet->sapxep); ?>" >
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui form">
							<div class="inline field">
								<div class="ui toggle checkbox">
									<input name="stt" type="checkbox" <?php if($baiviet->stt == 1): ?> checked <?php endif; ?> >
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
						<a href="<?php echo e(url('baiviet')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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