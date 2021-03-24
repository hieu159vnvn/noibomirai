<?php $__env->startSection('title', 'Danh sách công ty của nghiệp đoàn '); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
    Danh sách công ty của nghiệp đoàn <?php echo e($nghiepdoan->tennghiepdoan); ?>  
    <div class="sub header">
    </div>
  </h2> 

  <?php if(session('status')): ?>
    <div class="ui message">
    <i class="close icon"></i>
    <div class="header">
      Thông Báo !
    </div>
    <p><?php echo e(session('status')); ?></p>
    </div>
  <?php endif; ?>
  <?php if(session('error')): ?>
  <div class="ui message red">
  <i class="close icon"></i>
  <div class="header">
    Thông Báo !
  </div>
  <p><?php echo e(session('error')); ?></p>
  </div>
<?php endif; ?>
  <div class="ui segments">
        <div class="ui segment">
            <table id="myTable" class="ui selectable celled striped table">
              <thead>
                  <tr>
                      <th>STT</th>
                      <th>TÊN CÔNG TY</th>  
                      <th>ĐỊA CHỈ</th>
                      <th>NGƯỜI ĐẠI DIỆN</th>
                      <th>EMAIL</th>
                  </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $doitac; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($item->tencongty); ?></td>
                    <td><?php echo e($item->diachi); ?></td>
                    <td><?php echo e($item->nguoidaidien); ?></td>
                    <td><?php echo e($item->email); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
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
    $( document ).ready(function() {
      
       var table = $('#myTable').DataTable( {
  
        });
    });

  </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/nghiepdoan/nghiepdoan.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>