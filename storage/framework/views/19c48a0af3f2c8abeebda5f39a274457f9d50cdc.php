<?php $__env->startSection('title', 'Danh sách Lớp Học'); ?>
<?php $__env->startSection('PageContent'); ?>
  <div class="ui two column centered grid wrap-content-header">
    <h1 class="ui header centered page-title">DANH SÁCH HỌC VIÊN</h1>
  </div> 
  <h2 class="ui header centered ">Lớp Học : <?php echo e($dt->ten_lop_hoc); ?> </h2>
  <h2 class="ui header centered ">Giáo Viên : <?php echo e($dt->hoten); ?> </h2>
  <?php
		function ym($time) {
			$timestamp = strtotime($time);
			$year = date("Y", $timestamp);
			$month = date("m", $timestamp);
			return $year.'/'.$month;
		}
	?>
  <?php if(session('status')): ?>
    <div class="alert alert-success">
        <?php echo e(session('status')); ?>

    </div>
  <?php endif; ?>
  <div class="ajax-messenger"></div>
  <table id="data-table" class="ui selectable celled striped table">
      <thead class="full-width">
        <tr>
          <th>STT</th>
          <th>TÊN HỌC VIÊN</th>
          <th>ẢNH</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $hocviens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($key+1); ?></td>
            <td><a href="<?php echo e(url('hoso/'.$hv->id.'/show')); ?>"><?php echo e($hv->hoten); ?></a></td>
            <td> <?php if($hv->hinhanh): ?>
                <img src="<?php echo e(url('')); ?>/hocviens/<?php echo e(ym($hv->created_at)); ?>/<?php echo e($hv->hinhanh); ?>" width="50px">
                <?php else: ?> 
                  <img src="<?php echo e(asset('hocviens/logo.png')); ?>" width="50px"> 
                <?php endif; ?> 
              </td>                    
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
      </tbody>
      <tfoot class="full-width"></tfoot>
  </table>
  <div class="ui two column grid">
          <div class="eight wide column">
          <?php if (\Entrust::can('daotao-list')) : ?>
            <a href="<?php echo e(url('daotao')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
          <?php endif; // Entrust::can ?>
          <?php if (\Entrust::can('daotao-edit')) : ?>
              <a href="<?php echo e(url('daotao/' . $dt->id . '/edit')); ?>" class="ui labeled icon blue button btn-align-left" title="Sửa"><i class="edit icon"></i> Chỉnh sửa lớp</a>
          <?php endif; // Entrust::can ?>
          </div>
        </div>

  <div class="ui tiny del-modal modal">
    <div class="content"></div>
    <div class="actions">
      <div class="ui negative button">
        No
      </div>
      <div class="ui positive right labeled icon button">
        Yes
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/daotao/daotao.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>