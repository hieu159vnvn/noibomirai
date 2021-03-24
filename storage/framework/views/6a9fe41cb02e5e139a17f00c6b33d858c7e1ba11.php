<?php $__env->startSection('title', 'Sửa địa chỉ liên hệ'); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA ĐỊA CHỈ LIÊN HỆ</h1>
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
					<a href="<?php echo e(url('dclienhe/add')); ?>" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
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
							<label>Tên chi nhánh (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="ten" value="<?php echo e($dclienhe->ten); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>slug chi nhánh (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="slug" value="<?php echo e($dclienhe->slug); ?>">
							</div>
						</div>
						<div class="field">
							<label>Tên chi nhánh tiếng Nhật</label>
							<div class="ui input left icon">							
							<i class="language icon"></i>
							<input type="text" name="tenjp" value="<?php echo e($dclienhe->tenjp); ?>">
							</div>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Địa chỉ </label>
							<div class="ui input left icon">							
							<i class="building outline icon"></i>
							<input type="text" name="diachi" value="<?php echo e($dclienhe->diachi); ?>">
							</div>
						</div>
						<div class="field">
							<label>Địa chỉ tiếng Nhật </label>
							<div class="ui input left icon">							
							<i class="language icon"></i>
							<input type="text" name="diachijp" value="<?php echo e($dclienhe->diachijp); ?>" >
							</div>
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Điện thoại </label>
							<div class="ui input left icon">
								<i class="mobile alternate icon"></i>
								<input type="text" name="dienthoai" value="<?php echo e($dclienhe->dienthoai); ?>">
							</div>
						</div>
						<div class="field">
							<label>Email </label>
							<div class="ui input left icon">							
							<i class="envelope outline icon"></i>
							<input type="email" name="email" value="<?php echo e($dclienhe->email); ?>" >
							</div>
						</div>
						<div class="field">
							<label>Fax </label>
							<div class="ui input left icon">							
							<i class="fax icon"></i>
							<input type="text" name="fax" value="<?php echo e($dclienhe->fax); ?>" >
							</div>
						</div>
						<div class="field">
							<label>Website </label>
							<div class="ui input left icon">							
							<i class="globe icon"></i>
							<input type="text" name="website" value="<?php echo e($dclienhe->website); ?>" >
							</div>
						</div>
					</div>
					<div class="field">
						<label>ID Bản đồ </label>
						<div class="ui input left icon">							
						<i class="map icon"></i>
						<input type="text" name="bando" value="<?php echo e($dclienhe->bando); ?>" >
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Sắp xếp </label>
							<div class="ui input left icon">							
							<i class="sort icon"></i>
							<input type="number" name="sapxep" value="<?php echo e($dclienhe->sapxep); ?>" >
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui form">
							<div class="inline field">
								<div class="ui toggle checkbox">
									<input name="stt" type="checkbox" <?php if($dclienhe->stt == 1): ?> checked <?php endif; ?> >
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
						<a href="<?php echo e(url('dclienhe')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right-(//)"><i class="save icon"></i>Lưu</button>
					</div>
				</div>

				
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>