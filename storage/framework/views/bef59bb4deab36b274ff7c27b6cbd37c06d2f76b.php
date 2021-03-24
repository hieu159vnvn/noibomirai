<?php $__env->startSection('title', 'Danh sách Nhân viên'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH CHỨC VỤ
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      <?php if (\Entrust::can('chucvu-create')) : ?>
      <div class="right menu">
        <div class="item">
          <a href="<?php echo e(url('chucvu/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
        </div>
      </div>
      <?php endif; // Entrust::can ?>
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
  <div class="ui segments">
      <div class="ui segment">
      <table id="data-table" class="ui selectable celled striped table">
          <thead class="full-width">
            <tr>
              <th>STT</th>
              <th>TÊN CHỨC VỤ VN</th>
              <th>TÊN CHỨC VỤ JP</th>
              <th>GHI CHÚ</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $chucvu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($cv->chucvu_vn); ?></td>
                <td><?php echo e($cv->chucvu_jp); ?></td>
                <td><?php echo e($cv->ghichu); ?></td>
                <td>
                <?php if (\Entrust::can('chucvu-edit')) : ?>                        
                  <a href="<?php echo e(url('chucvu/' . $cv->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('chucvu-delete')) : ?>
                  <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($cv->id); ?>" data-name="<?php echo e($cv->chucvu_vn); ?>" title="Xóa"><i class="window close icon"></i></button>
                <?php endif; // Entrust::can ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          <tfoot class="full-width"></tfoot>
      </table>
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
  <script src="<?php echo e(url('js/admin/chucvu/chucvu.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>