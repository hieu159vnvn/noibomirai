<?php $__env->startSection('title', 'Danh sách Lớp Học'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH LỚP HỌC
  <div class="sub header">
  </div>
  </h2>
<?php if(session('status')): ?>
  <div class="ui positive message">
  <i class="close icon"></i>
  <div class="header">
    Thông Báo !
  </div>
  <p><?php echo e(session('status')); ?></p>
</div>
<?php endif; ?>
 <div class="ui secondary menu">
    <?php if (\Entrust::can('daotao-create')) : ?>
    <div class="right menu">
      <div class="item">
        <a href="<?php echo e(url('daotao/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
      </div>
    </div>
    <?php endif; // Entrust::can ?>
  </div> 
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN LỚP HỌC</th>
                <th>CƠ SỞ</th>
                <th>GIÁO VIÊN</th>
                <th>NGÀY KHAI GIẢNG</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>

              <?php $__currentLoopData = $daotao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($key+1); ?></td>
                  <td><?php echo e($dt->ten_lop_hoc); ?></td>
                  <td>
                    <?php if($dt->coso == 3): ?>
                      Phòng đào tạo 
                    <?php else: ?>
                      chưa cập nhật
                    <?php endif; ?>
                  </td>  
                  <td>
                    <?php $__currentLoopData = $giaovien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($gv->id == $dt->gvcn): ?>
                         <?php echo e($gv->hoten); ?>

                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                  
                  <td><?php echo e(date('d-m-Y', strtotime($dt->ngay_khai_giang))); ?></td>
                  <td> 
                  <?php if (\Entrust::can('daotao-show')) : ?>                       
                    <a href="<?php echo e(url('daotao/' . $dt->id . '/view')); ?>" class="mini ui icon green button" title="xem"><i class="eye icon"></i></a>
                  <?php endif; // Entrust::can ?>
                  <?php if (\Entrust::can('daotao-edit')) : ?>
                    <a href="<?php echo e(url('daotao/' . $dt->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                  <?php endif; // Entrust::can ?>
                  <?php if (\Entrust::can('daotao-delete')) : ?>
                    <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($dt->id); ?>" data-name="<?php echo e($dt->id); ?>" title="Xóa"><i class="window close icon"></i></button>
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
  <script src="<?php echo e(url('js/admin/daotao/daotao.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>