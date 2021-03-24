<?php $__env->startSection('title', 'ERROR'); ?>
<?php $__env->startSection('PageContent'); ?>
<div class="ui two column centered grid wrap-content-header">
	<h3>Xin lỗi! Bạn không thể truy cập vào mục này. Chi tiết liên hệ bộ phận IT.</h3>
</div>	

<div class="ui two column centered grid main-content">	
	<img height="500" src="<?php echo e(url('images/admin/logo.png')); ?>">
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>