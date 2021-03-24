<?php $__env->startSection('title', 'Danh sách liên hệ'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
  DANH SÁCH LIÊN HỆ
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
              <th>Họ và tên</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Tiêu đề</th>
              <th>Nội dung</th>
              <th>Ngày nhận</th>
              <th>Trạng thái<br>(check:đã liên hệ,chưa check:chưa liên hệ)</th>
            </tr>
          </thead>
          <tbody>

            <?php $__currentLoopData = $lienhe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($item->hovaten); ?></td>
                <td><?php echo e($item->email); ?></td>
                <td><?php echo e($item->sodienthoai); ?></td>
                <td><?php echo e($item->tieude); ?></td>
                <td><?php echo e($item->noidung); ?></td>
                <td><?php echo e($item->created_at); ?></td>
                <td><div class="ui toggle checkbox">
                  <input type="checkbox" data-lienhe="<?php echo e($item->id); ?>"<?php if($item->tinhtrang == 1): ?> checked <?php endif; ?>>
                  <label></label>
                </div></td>
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
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#data-table').on('change','input:checkbox',function (event) {
    var id = $(this).attr('data-lienhe');
    $.post("/lienhe/"+id,
      {
        id: id
      });
    });
    </script>
  <script src="<?php echo e(url('js/miraihuman/index.js')); ?>"></script>
  
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>