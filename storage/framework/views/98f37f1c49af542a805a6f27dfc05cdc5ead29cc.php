<?php $__env->startSection('title', 'Danh sách Đơn hàng'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH Đơn hàng
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
  <div class="ui segments">
      <div class="ui segment">
      <table id="data-table" class="ui selectable celled striped table">
          <thead class="full-width">
            <tr>
              <th>STT</th>
              <th>TÊN ĐƠN HÀNG</th>
              <th>NGÀNH NGHỀ</th>
              <th>NGÀY CẬP NHẬT</th>
              <th>TRẠNG THÁI</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $donhangstt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($dh->tendonhang); ?></td>
                <td><?php echo e($dh->nganhnghe_vn); ?></td>
                <td><?php echo e(date_format(date_create($dh->created_at),"d/m/Y")); ?></td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont<?php echo e($dh->id); ?>" >
                        <input name="stt" type="checkbox" class="cont" idstatus="<?php echo e($dh->id); ?>" rootstatus="<?php echo e($dh->stt); ?>" <?php if($dh->stt == 1): ?> checked="" <?php endif; ?>>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
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
  <script> status_delete('donhangstt'); </script>
  <script>
    $('#data-table').DataTable({
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>