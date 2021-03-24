<?php $__env->startSection('title', 'Danh sách Nhân viên'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH TIN TỨC
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      
      
      
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
              
              <th>TÊN</th>
              <th>Link</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $mangxahoi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mxh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                
                <td><?php echo e($mxh->ten); ?></td>
                <td><?php echo e($mxh->link); ?></td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont<?php echo e($mxh->id); ?>" >
                        <input name="stt" type="checkbox" class="cont" idstatus="<?php echo e($mxh->id); ?>" rootstatus="<?php echo e($mxh->stt); ?>" <?php if($mxh->stt == 1): ?> checked="" <?php endif; ?>>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                
                  <a href="<?php echo e(url('mangxahoi/' . $mxh->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                
                  
                
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
  <script> status_delete('mangxahoi'); </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>