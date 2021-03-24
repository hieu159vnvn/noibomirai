<?php $__env->startSection('title', 'Danh sách Nhân viên'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH NGÀNH NGHỀ
  <div class="sub header">
  </div>
  </h2>
  <div class="ui secondary menu">
      <?php if (\Entrust::can('nganhnghe-create')) : ?>
      <div class="right menu">
        <div class="item">
          <a href="<?php echo e(url('nganhnghe/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
<?php if(session('error')): ?>
<div class="ui message red">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p><?php echo e(session('error')); ?></p>
</div>
<?php endif; ?>
    <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN NGÀNH NGHỀ VN</th>
                <th>TÊN NGÀNH NGHỀ JP</th>
                <th>GHI CHÚ</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>

              <?php $__currentLoopData = $nganhnghe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($key+1); ?></td>
                  <td><?php echo e($nn->nganhnghe_vn); ?></td>
                  <td><?php echo e($nn->nganhnghe_jp); ?></td>
                  <td><?php echo e($nn->ghichu); ?></td>
                  <td>                        
                  <?php if (\Entrust::can('nganhnghe-edit')) : ?>
                    <a href="<?php echo e(url('nganhnghe/' . $nn->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    <?php endif; // Entrust::can ?>
                  <?php if (\Entrust::can('nganhnghe-delete')) : ?>
                    <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($nn->id); ?>" data-name="<?php echo e($nn->nganhnghe_vn); ?>" title="Xóa"><i class="window close icon"></i></button>
                  <?php endif; // Entrust::can ?>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="full-width"></tfoot>
        </table>
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
  <script src="<?php echo e(url('js/admin/nganhnghe/nganhnghe.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>