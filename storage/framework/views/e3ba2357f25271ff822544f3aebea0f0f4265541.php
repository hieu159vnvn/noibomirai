<?php $__env->startSection('title', 'Hồ Sơ Học Viên'); ?>
<?php $__env->startSection('PageContent'); ?>
<h2 class="ui header center aligned">
  DANH SÁCH HỌC VIÊN  
  <div class="sub header">
    Tổng cộng <?php echo e($nam + $nu); ?> học viên. (<?php echo e($nam); ?> Nam - <?php echo e($nu); ?> Nữ)
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
<div id="tableInfo"></div>
<div class="sixteen wide column">
    <div class="ui segments">
        <div class="ui segment">
            <div class="ui secondary menu">
                <div class="left menu">
                    <a class="item">
                      <a href="<?php echo e(url('/hoso')); ?>" class="ui labeled icon blue button"><i class="sync alternate icon"></i>Làm mới</a>
                    </a>
                </div>
                <?php if (\Entrust::can('hoso-create')) : ?>
                <div class="right menu">
                  <a class="item">
                    <a href="<?php echo e(url('/hoso/testmiss')); ?>" class="ui labeled icon red button"><i class="arrow left icon"></i>Kiểm Tra</a>
                  </a>
                  <a class="item">
                    <a href="<?php echo e(url('/hoso/create')); ?>" class="ui labeled icon blue button"><i class="plus icon"></i>Thêm</a>
                  </a>
                
                </div>
                <?php endif; // Entrust::can ?>
              </div>
        </div>          
        <div class="ui segment">
            <table id="myTable" class="ui selectable celled striped table">
              <thead>
                  <tr>
                      <th>STT</th>
                      <th>NGƯỜI GIỚI THIỆU</th>  
                      <th>ẢNH</th>              
                      <th>HỌ & TÊN</th>
                      <th>NGÀY SINH</th>
                      <th>ĐIỆN THOẠI</th>
                      <th>TÌNH TRẠNG</th>                
                      <th>TĨNH/TP</th>
                      <th>THAO TÁC</th>
                      <th>NGÀY ĐK</th>
                      <th>SỐ CMND</th>
                      <th>NGƯỜI DỊCH</th>
                       <th>NGƯỜI NHẬP</th>
                  </tr>
              </thead>
              <tfoot>
                <tr>
                    <th></th>
                    <th >NGƯỜI GIỚI THIỆU</th>
                    <th></th>        
                    <th >HỌ & TÊN</th>
                    <th></th>
                    <th></th>
                    <th></th>                
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                     <th></th>
                </tr>
              </tfoot>
            </table>
        </div>
        <div class="ui segment">
          <label class="ui label negative">&nbsp;</label>: Đã yêu cầu sửa  
            <label class="ui label positive">&nbsp;</label>: Đã dịch 
            <label class="ui label white">&nbsp;</label>: Chưa dịch
          </div>
    </div>
</div>
<style>
    .ui.table tfoot th{
      padding: 5px !important;
    }
    tfoot {
        display: table-header-group;
    }
    tfoot tr {
      height: 5px !important;
    }
    tfoot th{
      text-align: center !important;
      background: #F9FAFB !important;
    }
    tfoot th input {
      padding: 5px;
      margin: 0px;
      font-family: Lato,'Helvetica Neue',Arial,Helvetica, sans-serif;
      outline: 0;
      -webkit-appearance: none;
      tap-highlight-color: rgba(255,255,255,0);
      line-height: 1.0em;
      /* padding: .67857143em 1em; */
      font-size: 1em;
      background: #fff;
      border: 1px solid rgba(34,36,38,.15);
      color: rgba(0,0,0,.87);
      border-radius: .28571429rem;
      -webkit-box-shadow: 0 0 0 0 transparent inset;
      box-shadow: 0 0 0 0 transparent inset;
      -webkit-transition: color .1s ease,border-color .1s ease;
      transition: color .1s ease,border-color .1s ease;
    }
    .white {
      background: white !important;
      border: 1px solid #DDDDDD !important;
    }
    .positive {
      background: #e5ecd3 !important;   
      color: #d0e0a8 !important;
      border: 1px solid #DDDDDD !important;
    }
    .negative {
      background: #bd7070 !important;
      color: #ffffff!important;
      border: 1px solid #DDDDDD !important;
    }
    .ui.table td.positive, .ui.table tr.positive {
      background: #d0e0a8 !important;   
    }
    .ui.table td.negative, .ui.table tr.negative {
    background: #bd7070 !important;
    color: #ffffff!important;
}
  </style>
<script type="text/javascript">
	$.fn.dataTable.ext.errMode = 'throw';
  // $.fn.DataTable.ext.pager.numbers_length = 13;
  $( document ).ready(function() {
     var table = $('#myTable').DataTable( {
          stateSave: true,
          processing: true,
          serverSide: true,
          ajax: '/datatables/data',
          columns: [
              { data: 'id'},
              { data: 'nguoigioithieu'},   
              { data: 'hinhanh'},         
              { data: 'hoten'},
              { data: 'ngaysinh'},
              { data: 'dienthoai'},
              { data: 'tinhtrang'},
              { data: 'tinhthanh'},
              { data: 'action'},
              { data: 'created_at'},
              { data: 'cmnd_socmnd', searchable: false},
              { data: 'nguoidich', searchable: false},
              { data: 'nguoinhap', searchable: false}
              ],
          "columnDefs": [ {
            "searchable": true,
            "orderable": false,
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
          search: {
              "regex": true
          },
          initComplete: function () {
            this.api().columns([1,3]).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.setAttribute('placeholder', 'TÌM KIẾM');
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                  column.search($(this).val(), false, false, false).draw();
                });
            });
        } 
       
      });
  });

  $('.message .close')
    .on('click', function() {
      $(this).closest('.message').transition('fade');
  });

</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>