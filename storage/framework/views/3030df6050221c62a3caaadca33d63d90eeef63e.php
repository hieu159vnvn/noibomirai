<?php $__env->startSection('title', 'Thay Đổi Mật Khẩu'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h1 class="ui header centered page-title">Thay Đổi Mật Khẩu Tài Khoản: <?php echo e($user->username); ?></h1>
  <?php if(session('error')): ?>
      <div class="ui error message">
        <i class="close icon"></i>
        <div class="header">
          Thông Báo !
        </div>
        <p><?php echo e(session('error')); ?></p>
    </div>
  <?php else: ?>
    <?php if(session('status')): ?>
        <div class="ui message">
          <i class="close icon"></i>
          <div class="header">
            Thông Báo !
          </div>
          <p><?php echo e(session('status')); ?></p>
      </div>
    <?php endif; ?>
  <?php endif; ?>
  <div class="ui two column centered grid"> 
    <div class="column">
      <?php if($errors->any()): ?>
          <div class="alert alert-danger">
              <ul>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
      <?php endif; ?>
      <form class="ui form" action="" method="post">
        <?php echo e(csrf_field()); ?>

        <div class="field">
          <label>Email (*)</label>
          <input type="email" id="email" name="email" data-old-value="<?php echo e($user->email); ?>" placeholder="Email" value="<?php echo e($user->email); ?>" required readonly>
          <p id="error-email" class="error-messenger">Email đã tồn tại</p>
        </div>
        <div class="field">
          <label>Tên</label>
          <input type="text" id="name" name="name" placeholder="Tên" value="<?php echo e($user->name); ?>" readonly>
        </div>
        <div class="field">
          <label>Password Đang Dùng (*)</label>
          <input type="password" id="oldpassword" name="oldpassword" placeholder="Password Đang Dùng">
        </div>
        <div class="field">
          <label>Password (*)</label>
          <input type="password" id="password" name="password" placeholder="Password">
        </div>
        <p id="error-password" class="error-messenger">Password không trùng nhau</p>
        <div class="field">
          <label>Nhập Lại Password (*)</label>
          <input type="password" id="repassword" name="repassword" placeholder="Nhập lại Password">
        </div>
        
        <a href="<?php echo e(url('/')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Về Trang Chủ</a>
        <button type="submit" id="btn-submit" class="ui labeled icon button blue btn-align-right"><i class="plus circle icon"></i>Lưu thay đổi</button>
      </form>
    </div>
  </div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/user/edit_user.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>