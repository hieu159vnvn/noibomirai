<?php $__env->startSection('title', 'Danh sách Nhân viên'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
    DANH SÁCH NHÂN VIÊN 
    <div class="sub header">
      Tổng cộng <?php echo e(count($nhanvien)); ?> nhân viên. (<?php echo e($nam); ?> Nam - <?php echo e($nu); ?> Nữ)
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
              <div class="ui secondary menu">
                  <?php if (\Entrust::can('nhanvien-create')) : ?>
                  <div class="right menu">
                    <a class="item">
                      <a href="<?php echo e(url('nhanvien/add')); ?>" class="ui labeled icon green button"><i class="plus icon"></i>Thêm</a>
                    </a>
                  </div>
                  <?php endif; // Entrust::can ?>
                </div>
          </div>          
          <div class="ui segment">
          <table id="data-table" class="ui selectable celled striped table">
              <thead class="full-width">
                <tr>
                  <th>STT</th>
               
                  <th>HÌNH ẢNH</th>
                  <th>HỌ TÊN</th>          
                  <th>CHỨC VỤ</th>
                  <th>ĐIỆN THOẠI</th>                  
                  <th>EMAIL</th>
                  <th>NGÀY VÀO LÀM</th>
                  <th>GHI CHÚ</th>
                  <th>TỈNH/TP</th>
                  <th>THAO TÁC</th>
                </tr>
              </thead>
              <tbody>

                <?php $__currentLoopData = $nhanvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <tr <?php if($nv->ngaynghiviec): ?> class="active" <?php endif; ?>>
                    <td><?php echo e($key+1); ?></td>
               
                    <td><img class="ui avatar image" data-name="<?php echo e($nv->hoten); ?>" <?php if($nv->hinhanh): ?> src="<?php echo e($nv->hinhanh); ?>" <?php else: ?> src="/images/admin/avatar.png"  <?php endif; ?>></td>
                    <td><?php echo e($nv->hoten); ?></td>

                    <td>
                      <?php $__currentLoopData = $chucvu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($nv->chucvu == $cv->id): ?>
                           <?php echo e($cv->chucvu_vn); ?>

                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td><?php echo e($nv->sodienthoai); ?></td>                    
                    <td><?php echo e($nv->email); ?></td>
                    <td><?php echo e($nv->ngayvaolam); ?></td>
                    <td><?php echo e($nv->ghichu); ?></td>
                    <td>
                      <?php $__currentLoopData = $tinhthanh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tinh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($nv->tinhthanh == $tinh->id): ?>
                           <?php echo e($tinh->ten); ?>

                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>                        
                     
                    <?php if (\Entrust::can('nhanvien-edit')) : ?>
                      <a href="<?php echo e(url('nhanvien/' . $nv->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    <?php endif; // Entrust::can ?> 
                    <?php if (\Entrust::can('nhanvien-delete')) : ?>
                      <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($nv->id); ?>" data-name="<?php echo e($nv->hoten); ?>" title="Xóa"><i class="window close icon"></i></button>
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

  <script type="text/javascript">    
        $('.btn-delete').click(function (event) {
          $(".del-modal").modal('show');
          var header = '<p>Có phải bạn có muốn xóa ' + $(this).attr('data-name') + '?</p><i>Lưu ý: Cần cân nhắc trước khi xóa. Sẽ không phục hồi lại được!</i>';
          $(".del-modal .content").html(header);
          $(".del-modal .positive").attr('data-id', $(this).attr('data-id'));
        });

        $('.btn-view').click(function(event){
          $('.view-modal').modal('show');
          $(".view-modal .positive").attr('data-id', $(this).attr('data-id'));
        });

        $('.positive').click(function (event) {
          window.location.href = 'nhanvien/' + $(this).attr('data-id') + '/delete';
        });
  </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/nhanvien/nhanvien.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>