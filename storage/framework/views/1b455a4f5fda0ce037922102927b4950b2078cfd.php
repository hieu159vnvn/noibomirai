<!DOCTYPE html>
<html>
<head>
	<?php $__env->startSection('CssLibraries'); ?><?php echo $__env->yieldSection(); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/semanticui/semantic.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/mmenu/jquery.mmenu.all.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/mmenu/style_mmenu.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/calendar/calendar.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/admin/style.css')); ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
	
	<script src="<?php echo e(url('libraries/sweetalert.js')); ?>"></script>
	
    <script src="<?php echo e(url('libraries/jquery-3.3.1.min.js')); ?>"></script>
	<script src="<?php echo e(url('libraries/mmenu/jquery.mmenu.min.all.js')); ?>"></script>
	<script src="<?php echo e(url('libraries/calendar/calendar.js')); ?>"></script>
	<script src="<?php echo e(url('libraries/semanticui/semantic.min.js')); ?>"></script>
	<script src="<?php echo e(url('libraries/jquery.inputmask.bundle.min.js')); ?>"></script>
	
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
	<script src="<?php echo e(url('libraries/ckeditor/ckeditor.js')); ?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

	<title><?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>	
	<div id="main-content">
		<div id="sidebar-content">
			<?php echo $__env->make('admin.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<div id="wrap-content">	
			<?php echo $__env->make('admin.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<div class="main-content">		
			<?php $__env->startSection('PageContent'); ?><?php echo $__env->yieldSection(); ?>
			</div>
			<?php echo $__env->make('admin.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>			
		</div>
	</div>	
		
    <script src="<?php echo e(url('js/admin/init.js')); ?>"></script>
	<?php $__env->startSection('JsLibraries'); ?><?php echo $__env->yieldSection(); ?>
</body>
</html>
