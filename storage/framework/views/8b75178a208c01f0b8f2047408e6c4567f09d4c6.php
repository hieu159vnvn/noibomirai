<?php $__env->startSection('title', 'Danh sách Banner'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH BANNER
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      
      <div class="right menu">
        <div class="item">
          <a href="<?php echo e(url('banner/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
              <th>BANNER</th>
              <th>LINK</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td >
                <?php if($bn->image == '0' || $bn->image == null): ?>
                  <img src="uploads/no-image.jpg" alt="banner" style="max-height: 50px;">
                <?php else: ?>
                  <img src="<?php echo e($bn->image); ?>" alt="banner" style="max-height: 50px;">
                <?php endif; ?> 
                </td>
                <td><?php echo e($bn->link); ?></td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont<?php echo e($bn->id); ?>" >
                        <input name="stt" type="checkbox" class="cont" idstatus="<?php echo e($bn->id); ?>" rootstatus="<?php echo e($bn->stt); ?>" <?php if($bn->stt == 1): ?> checked="" <?php endif; ?>>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                
                  <a href="<?php echo e(url('banner/' . $bn->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                
                  <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($bn->id); ?>" data-name="<?php echo e($bn->id); ?>" title="Xóa"><i class="window close icon"></i></button>
                
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
  <script src="<?php echo e(url('js/miraihuman/index.js')); ?>"></script>
  <script> status_delete('banner'); </script>
  <script>
    $('#data-table').DataTable({
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>