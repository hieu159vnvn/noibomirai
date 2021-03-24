<?php $__env->startSection('title', 'LỊCH SỬ CÁC THAO TÁC'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  LỊCH SỬ CÁC THAO TÁC
  <div class="sub header">
  </div>
  </h2>
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>THAO TÁC</th>
                <th>TÊN PHÒNG</th>
                <th>TÊN HỌC VIÊN</th>
                <th>NGÀY SINH</th>
                <th>LÍ DO</th>
                <th>NGƯỜI THAO TÁC</th>
                <th>NGÀY THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $lichsu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($key+1); ?></td>
                  <td><?php echo e($item->thaotac); ?></td>
                  <td>
                    <?php $__currentLoopData = $kitucxa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ktx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($ktx->id == $item->id_kitucxa): ?>
                            <?php echo e($ktx->tenphong); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                  <td>
                    <?php $__currentLoopData = $hocvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($hv->id == $item->id_hocvien): ?>
                            <?php echo e($hv->hoten); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                  <td>
                    <?php $__currentLoopData = $hocvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($hv->id == $item->id_hocvien): ?>
                            <?php echo e(date('d-m-Y', strtotime($hv->ngaysinh))); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                  <td><?php echo e($item->lido); ?></td>
                  <td><?php echo e($item->creator); ?></td>
                  <td><?php echo e(date('H:i:s d-m-Y', strtotime($item->created_at))); ?></td>
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