<?php $__env->startSection('title', 'Danh sách Đối tác'); ?>
<?php $__env->startSection('PageContent'); ?>
  <h2 class="ui header center aligned">
        QUẢN LÝ CÔNG TY   
        <div class="sub header">
          Danh sách Công ty tại Nhật
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
      <div class="ui secondary menu">
        <div class="left menu">
          <div class="item">
            <p>Có <?php echo e(count($doitac)); ?> công ty</p>
          </div>
        </div>
        <?php if (\Entrust::can('doitac-create')) : ?>
        <div class="right menu">
          <div class="item">
            <a href="<?php echo e(url('doitac/add')); ?>" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
          </div>
        </div>
        <?php endif; // Entrust::can ?>
      </div>
    </div>
    <div class="ui segment">
      <table id="myTable" class="ui selectable celled striped table">
        <thead>
            <tr>
                <th>STT</th>
                <th>TÊN NGHIỆP ĐOÀN</th>
                <th>TÊN CÔNG TY</th>  
                <th>ĐỊA CHỈ</th>
                <th>NGƯỜI ĐẠI DIỆN</th>
                
                <th>EMAIL</th>
                <th>ACTION</th>
            </tr>
        </thead>
       
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
            stateSave: true,
            processing: true,
            serverSide: true,
            ajax: '/dhdatatables/doitac',
            columns: [
            {data: 'id'},
            {data: 'tennghiepdoan'},
            {data: 'tencongty'},
            {data: 'diachi'},
            {data: 'nguoidaidien'},
            // {data: 'dienthoai'},
            {data: 'email'},
            {data: 'action'}
            ],
            
            "columnDefs": [
              { "width": "10%", "targets": 4 }, 
              { "width": "10%", "targets": 3 }, 
              { "width": "40%", "targets": 2 }, 
              {
            "searchable": true,
            "orderable": true,
            // "targets": [1,4,5,6]
          } ],
          ordering: false,
          order: [0, "desc"],
          language: datatable_language,
          "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              var index = iDisplayIndexFull + 1;
              $('td:eq(0)',nRow).html(index);
              return nRow;
          },

  
        });
    });

  </script> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/doitac/doitac.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>