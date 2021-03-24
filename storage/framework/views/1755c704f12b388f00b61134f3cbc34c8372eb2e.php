<?php $__env->startSection('title', 'Danh sách Cảm nhận'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH CẢM NHẬN
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      
      <div class="right menu">
        <div class="item">
          <a href="<?php echo e(url('camnhan/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
  <div class="ui segments">
      <div class="ui segment">
      <table id="data-table" class="ui selectable celled striped table">
          <thead class="full-width">
            <tr>
              <th>STT</th>
              <th>Tên học viên</th>
              <th>Ngành nghề</th>
              <th>Ngành nghề JP</th>
              <th>Nội dung</th>
              <th>Nội dung JP</th>
              <th>Hình ảnh</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $camnhan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($tt->tenhocvien); ?></td>
                <td><?php echo e($tt->nganhnghe); ?></td>
                <td><?php echo e($tt->nganhnghejp); ?></td>
                <td><?php echo e(str_limit($tt->noidung,30)); ?></td>
                <td><?php echo e(str_limit($tt->noidungjp,30)); ?></td>
                <td>
                  <?php if($tt->image == '0' || $tt->image == null): ?>
                    <img src="uploads/no-image.jpg" alt="logo" style="max-height: 50px;">
                  <?php else: ?>
                    <img src="<?php echo e($tt->image); ?>" alt="logo" style="max-height: 50px;">
                  <?php endif; ?> 
                </td>
                <td>
                
                  <a href="<?php echo e(url('camnhan/' . $tt->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                
                  <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($tt->id); ?>" data-name="<?php echo e($tt->id); ?>" title="Xóa"><i class="window close icon"></i></button>
                
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
<script>
    $('#data-table').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "15%", "targets": 3 },
        { "width": "15%", "targets": 4 }
      ]
    });
    </script>
  <script src="<?php echo e(url('js/miraihuman/index.js')); ?>"></script>
  <script> status_delete('camnhan'); </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>