<?php $__env->startSection('title', 'Danh sách Đơn hàng'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
    QUẢN LÝ ĐƠN HÀNG    
    <div class="sub header">
      Tổng cộng <?php echo e(count($hoso)); ?> học viên đủ điều kiện.
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
      <div class="ui secondary menu">
        <div class="right menu">
          <?php if (\Entrust::can('donhang-create')) : ?>
             <a href="<?php echo e(url('donhang/add')); ?>" class="ui labeled icon blue button"><i class="plus circle icon"></i>Thêm</a>
          <?php endif; // Entrust::can ?>
        </div>
      </div>
            <div class="ui segments">
              <div class="ui segment">
                  <h3>ĐƠN HÀNG MỚI</h3>
              </div>
              <div class="ui segment">
                <table id="data-table" class="ui selectable celled striped table">
                    <thead class="full-width">
                      <tr>
                        <th>STT</th>
                        <th>ĐƠN HÀNG</th>
                        <th>TÊN CÔNG TY</th>
                        <th>NGÀNH NGHỀ</th>
                        <th>NGÀY PHỎNG VẤN</th>
                        <th>SỐ LƯỢNG TUYỂN</th> 
                        <?php if (\Entrust::can('donhang-show')) : ?>
                        <th>DUYỆT ĐH</th>
                        <?php endif; // Entrust::can ?>
                        <th>THAO TÁC</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $donhang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php echo e($dh->tendonhang); ?></td>
                          <td>
                              <?php $__currentLoopData = $doitac; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dt->id == $dh->doitac_id): ?>
                                    <?php echo e($dt->tencongty); ?>

                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </td>
                          <td>
                              <?php $__currentLoopData = $nganhnghe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($nn->id == $dh->nganhnghe_id): ?>
                                    <?php echo e($nn->nganhnghe_vn); ?>

                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                          </td>
                          <td>
                              <?php
                                $LogintDate = strtotime($dh->ngaypv);
                                $ngaypv = date('d-m-Y', $LogintDate);
                              ?>
                            <?php echo e($ngaypv); ?></td>
                          <td><?php echo e($dh->soluongtuyen); ?></td>
                          <?php if (\Entrust::can('donhang-show')) : ?>
                          <td>
                            <div class="ui toggle checkbox">
                              <input type="checkbox" class="duyetdonhang" data-dh="<?php echo e($dh->id); ?>" <?php if($dh->tinhtrang == 1): ?> checked <?php endif; ?>>
                              <label></label>
                            </div>
                          </td>
                          <?php endif; // Entrust::can ?>
                          <td>
                            <?php if (\Entrust::can('donhang-list')) : ?>
                            <a href="<?php echo e(url('donhang/' . $dh->id . '/print')); ?>" class="mini ui icon green button" title="In đơn hàng"><i class="print icon"></i></a>  
                            <?php endif; // Entrust::can ?>  
                            <?php if (\Entrust::can('donhang-edit')) : ?>                    
                            <a href="<?php echo e(url('donhang/' . $dh->id . '/edit')); ?>" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('donhang-delete')) : ?>             
                            <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($dh->id); ?>" data-name="DH-0<?php echo e($dh->id); ?>" title="Xóa"><i class="window close icon"></i></button>
                            <?php endif; // Entrust::can ?>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot class="full-width"></tfoot>
                </table>
              </div>
            </div>
            <div class="ui segments">
              <div class="ui segment">
                  <h3>ĐƠN HÀNG ĐÃ DUYỆT</h3>
              </div>
              <div class="ui segment">
                <table id="data-table-1" class="ui selectable celled striped table">
                    <thead class="full-width">
                      <tr>
                        <th>STT</th>
                        <th>ĐƠN HÀNG</th>
                        <th>TÊN CÔNG TY</th>
                        <th>NGÀNH NGHỀ</th>
                        <th>NGÀY PHỎNG VẤN</th>
                        <th>SỐ LƯỢNG TUYỂN</th> 
                        <?php if (\Entrust::can('donhang-show')) : ?>         
                        <th>GHÉP ĐƠN HÀNG</th>
                        <?php endif; // Entrust::can ?>
                        <th>THAO TÁC</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $donhang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($dh->tinhtrang == 1): ?>
                        <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php echo e($dh->tendonhang); ?></td>
                          <td>
                              <?php $__currentLoopData = $doitac; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dt->id == $dh->doitac_id): ?>
                                    <?php echo e($dt->tencongty); ?>

                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </td>
                          <td>
                              <?php $__currentLoopData = $nganhnghe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($nn->id == $dh->nganhnghe_id): ?>
                                    <?php echo e($nn->nganhnghe_vn); ?>

                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                          </td>
                          <td>
                            <?php
                              $LogintDate = strtotime($dh->ngaypv);
                              $ngaypv = date('d-m-Y', $LogintDate);
                            ?>
                          <?php echo e($ngaypv); ?></td>
                          <td><?php echo e($dh->soluongtuyen); ?></td>
                          
                            <?php if (\Entrust::can('donhang-show')) : ?>
                            <td><a href="<?php echo e(url('donhang/' . $dh->id . '/create')); ?>" class="mini ui icon green button" title="Ghép đơn hàng"><i class="plus icon"></i></a></td>
                            <?php endif; // Entrust::can ?>
                          
                          <td>
                            <?php if (\Entrust::can('donhang-check')) : ?>
                              <a href="<?php echo e(url('donhang/' . $dh->id . '/show')); ?>" class="mini ui icon blue button" title="Xem danh sách"><i class="eye icon"></i></a> 
                            <?php endif; // Entrust::can ?>
                            <?php if (\Entrust::can('donhang-delete')) : ?>             
                            <button type="button" class="mini ui icon red button btn-delete" data-id="<?php echo e($dh->id); ?>" data-name="DH-0<?php echo e($dh->id); ?>" title="Xóa"><i class="window close icon"></i></button>
                            <?php endif; // Entrust::can ?>
                            <button class="mini ui icon green button prints" data-id="<?php echo e($dh->id); ?>" title="In Đơn Hàng"><i class="print icon"></i></button>
                            
                          </td>
                        </tr>
                        <?php endif; ?>
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


  <div class="ui large longer modal">
    <div class="header">PRINT FULL</div>
    <div class="scrolling content">
      <div id="printfull"></div>
    </div>
    <div class="actions">
      <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('listorder')"><i class="save icon"></i>IN DS</a>
        <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('resultorder')"><i class="save icon"></i>IN KQ PHỎNG VẤN</a>
        <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('coverorder')"><i class="save icon"></i>IN BÌA</a>  
        <a class="ui labeled icon green button" href="javascript:void(0)" onclick="In_Content('intiengnhat')"> <i class="print icon"></i>IN HỌC VIÊN</a>
        <a class="ui labeled icon blue button" href="javascript:void(0)" onclick="In_Content('printdoc')"> <i class="print icon"></i>IN DỌC</a>
        <a class="ui labeled icon blue button" href="javascript:void(0)" onclick="In_Content('printngang')"> <i class="print icon"></i>IN NGANG</a>
    </div>
  </div>  

<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<script>
  $(document).ready(function () {
    $( "#data-table-1" ).on( "click", ".prints",function (event) {
      var id = $(this).attr('data-id');
      $("#printfull").load("donhang/"+id+"/printAjax");
      $('.ui.longer.modal').modal('show');
    });
  });
</script>
  <script src="<?php echo e(url('js/admin/donhang/donhang.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>