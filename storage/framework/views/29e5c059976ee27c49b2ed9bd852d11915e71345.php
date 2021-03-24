<?php $__env->startSection('title', 'Thêm Chức vụ'); ?>
<?php $__env->startSection('PageContent'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM NGÀNH NGHỀ</h1>
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
							<label>Tên Ngành nghề tiếng Việt (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="nganhnghe_vn" value="<?php echo e(old('nganhnghe_vn')); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>Tên Ngành nghề tiếng Nhật (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="nganhnghe_jp" value="<?php echo e(old('nganhnghe_jp')); ?>" required>
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
						<a href="<?php echo e(url('nganhnghe')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/nganhnghes/add_nganhnghe.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>