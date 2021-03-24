<?php $__env->startSection('title', 'QUẢN LÝ KÝ TÚC XÁ'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  QUẢN LÝ KÝ TÚC XÁ
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
<?php if(session('error')): ?>
				<div class="ui negative message">
				<i class="close icon"></i>
				<div class="header">
					Thông Báo !
				</div>
				<p><?php echo e(session('error')); ?></p>
				</div>
			<?php endif; ?>
 <div class="ui secondary menu">
    <div class="right menu">
      <div class="item">
        <a href="<?php echo e(url('kitucxa/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
      </div>
    </div>
  </div> 
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN PHÒNG</th>
                <th>SỐ HỌC VIÊN HIỆN TẠI</th>
                <th>SỐ HỌC VIÊN TỐI ĐA</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $danhsach; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($key+1); ?></td>
                  <td><?php echo e($item->tenphong); ?></td>
                  <?php
                      $demhocvien=DB::table('kitucxa_hocvien')->where('id_kitucxa',$item->id)->count();
                  ?>
                  <?php if($demhocvien > $item->sohocvien): ?>
                    <td style="background-color: #f38383"><?php echo e($demhocvien); ?></td>
                  <?php else: ?>
                    <td><?php echo e($demhocvien); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($item->sohocvien); ?></td>
                  <td> 
                    <a href="<?php echo e(url('kitucxa/view/'.$item->id.'')); ?>" class="mini ui icon green button" title="Xem phòng"><i class="eye icon"></i></a>
                    <a href="<?php echo e(url('kitucxa/' . $item->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->id); ?>" title="Xóa"><i class="window close icon"></i></button>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="full-width"></tfoot>
        </table>
    </div>
  </div>
  <h2 class="ui header center aligned">PHÒNG ĐẶC BIỆT</h2>
  <div class="ui secondary menu">
    <div class="right menu">
      <div class="item">
        <a href="<?php echo e(url('kitucxa/adddacbiet')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
      </div>
    </div>
  </div> 
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table1" class="ui selectable celled striped table " style="text-align: center">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN PHÒNG</th>
                <th>SỐ HỌC VIÊN HIỆN TẠI</th>
                <th>SỐ HỌC VIÊN TỐI ĐA</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $danhsachdacbiet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($key+1); ?></td>
                  <td><?php echo e($item->tenphong); ?></td>
                  <?php
                      $demhocvien=DB::table('kitucxa_hocvien')->where('id_kitucxa',$item->id)->count();
                  ?>
                  <?php if($demhocvien > $item->sohocvien): ?>
                    <td style="background-color: #f38383"><?php echo e($demhocvien); ?></td>
                  <?php else: ?>
                    <td><?php echo e($demhocvien); ?></td>
                  <?php endif; ?>
                  <td><?php echo e($item->sohocvien); ?></td>
                  <td> 
                    <a href="<?php echo e(url('kitucxa/view/'.$item->id.'')); ?>" class="mini ui icon green button" title="Xem phòng"><i class="eye icon"></i></a>
                    <a href="<?php echo e(url('kitucxa/' . $item->id . '/editdacbiet')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->id); ?>" title="Xóa"><i class="window close icon"></i></button>
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
<script src="<?php echo e(url('js/miraihuman/index.js')); ?>"></script>
<script> status_delete('danhsach'); </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>