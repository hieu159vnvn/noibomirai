<?php $__env->startSection('title', 'SỬA ĐỐI TÁC'); ?>
<?php $__env->startSection('PageContent'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA CÔNG TY</h1>
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
			<?php if(session('error')): ?>
			<div class="ui red message">
				<i class="close icon"></i>
				<div class="header">
				Thông Báo !
				</div>
				<p><?php echo e(session('error')); ?></p>
			</div>
			<?php endif; ?>
			<?php if(session('status')): ?>
			<div class="ui message">
				<i class="close icon"></i>
				<div class="header">
				Thông Báo !
				</div>
				<p><?php echo e(session('status')); ?></p>
			</div>
			<?php endif; ?>
			<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">			
					<div class="two fields">
						
						
						<div class="field">
							<label>Tên công ty (*)</label>
							<input type="hidden" name="tencongtyhide" value="<?php echo e($doitac->tencongty); ?>">
							<div class="ui fluid search selection dropdown">
								
								<i class="dropdown icon"></i>
								<input class="search tencongty" name="tencongty" value="<?php echo e($doitac->tencongty); ?>">
								<div class="default text"><?php echo e($doitac->tencongty); ?></div>
								<div class="menu">
									<?php $__currentLoopData = $doitacs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="item itemred"><?php echo e($item->tencongty); ?></div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
						<div class="field">
							<label>Tên Nghiệp đoàn (*)</label>
							<select name="nghiepdoan" class="ui search dropdown">
								 <?php $__currentLoopData = $nghiepdoan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                 <?php if($doitac->id_nghiepdoan == $nd->id): ?> 
					                      <option value="<?php echo e($nd->id); ?>"><?php echo e($nd->tennghiepdoan); ?></option>
					                 <?php endif; ?> 
					              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php $__currentLoopData = $nghiepdoan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					      			<option value="<?php echo e($nd->id); ?>"><?php echo e($nd->tennghiepdoan); ?></option>
					      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						      	
							</select>
						</div>
						
						<div class="field">
							<label>Địa chỉ (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="diachi" value="<?php echo e($doitac->diachi); ?>" required>
							</div>
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Người đại diện (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="nguoidaidien" value="<?php echo e($doitac->nguoidaidien); ?>" required>
							</div>
						</div>
						
						<div class="field">
							<label>Ngành nghề</label>
							<select class="ui fluid search dropdown" multiple="" name="nganhnghe[]">
								<?php $__currentLoopData = $nganhnghe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($item->id); ?>"><?php echo e($item->nganhnghe_vn); ?> - "<?php echo e($item->nganhnghe_jp); ?>"</option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($nganhnghearray): ?>
									<?php $__currentLoopData = $nganhnghearray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option selected value="<?php echo e($item->id); ?>"><?php echo e($item->nganhnghe_vn); ?> - "<?php echo e($item->nganhnghe_jp); ?>"</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								
							</select>
						</div>
						<div class="field">
							<label>Email</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="email" value="<?php echo e($doitac->email); ?>">
							</div>
						</div>
					</div>
					<div class="field">
						<label>Ghi chú (Nếu có)</label>
						<textarea rows="10" name="ghichu" placeholder="Nội dung..."><?php echo e($doitac->ghichu); ?></textarea>
					</div>
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>	

				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="<?php echo e(url('doitac')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<style>
		.ui.dropdown .menu>.itemred {
			color: red !important;
		}
		</style>
<script>
$('.ui.search.dropdown').dropdown({clearable: true});
$('.ui.selection.dropdown').dropdown();
</script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>