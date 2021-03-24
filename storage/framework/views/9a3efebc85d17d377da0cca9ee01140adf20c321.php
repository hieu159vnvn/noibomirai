<?php $__env->startSection('title', 'Danh sách hỏi đáp'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH HỎI ĐÁP
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      
      <div class="right menu">
        <div class="item">
          <a href="<?php echo e(url('hoidap/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
              <th>TIÊU ĐỀ HỎI</th>
              <th>LOẠI CÂU HỎI</th>
              <th>TIÊU ĐỀ HỎI JP</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $hoidap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($hd->hoi); ?></td>
                <td> 
                  <?php $__currentLoopData = $loaihoidap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->id == $hd->id_loaicauhoi): ?>
                        <?php echo e($item->tenloai); ?>

                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </td>
                <td><?php echo e($hd->hoijp); ?></td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont<?php echo e($hd->id); ?>" >
                        <input name="stt" type="checkbox" class="cont" idstatus="<?php echo e($hd->id); ?>" rootstatus="<?php echo e($hd->stt); ?>" <?php if($hd->stt == 1): ?> checked="" <?php endif; ?>>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                
                  <a href="<?php echo e(url('hoidap/' . $hd->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                
                  <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($hd->id); ?>" data-name="<?php echo e($hd->id); ?>" title="Xóa"><i class="window close icon"></i></button>
                
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
  <script> status_delete('hoidap'); </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>