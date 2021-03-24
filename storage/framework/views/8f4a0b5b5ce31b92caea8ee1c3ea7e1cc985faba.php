 
<?php $__env->startSection('content'); ?>
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Danh sách Phân Quyền</h2>
	        </div>
	        <div class="pull-right">
	        	<?php if (\Entrust::can('role-create')) : ?>
	            <a class="btn btn-success" href="<?php echo e(route('roles.create')); ?>"> Thêm</a>
	            <?php endif; // Entrust::can ?>
	        </div>
	    </div>
	</div>
	<?php if($message = Session::get('success')): ?>
		<div class="alert alert-success">
			<p><?php echo e($message); ?></p>
		</div>
	<?php endif; ?>
	<table class="table table-bordered">
		<tr>
			<th>#</th>
			<th>Quyền</th>
			<th>Mô tả</th>
			<th width="280px">Thao tác</th>
		</tr>
	<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td><?php echo e(++$i); ?></td>
		<td><?php echo e($role->display_name); ?></td>
		<td><?php echo e($role->description); ?></td>
		<td>
			<a class="btn btn-info" href="<?php echo e(route('roles.show',$role->id)); ?>">Xem</a>
			<?php if (\Entrust::can('role-edit')) : ?>
			<a class="btn btn-primary" href="<?php echo e(route('roles.edit',$role->id)); ?>">Sửa</a>
			<?php endif; // Entrust::can ?>
			<?php if (\Entrust::can('role-delete')) : ?>
			<?php echo Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']); ?>

            <?php echo Form::submit('Xóa', ['class' => 'btn btn-danger']); ?>

        	<?php echo Form::close(); ?>

        	<?php endif; // Entrust::can ?>
		</td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</table>
	<?php echo $roles->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>