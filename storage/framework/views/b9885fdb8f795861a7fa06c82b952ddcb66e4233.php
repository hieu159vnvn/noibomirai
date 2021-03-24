<?php $__env->startSection('title', 'Hồ Sơ Học Viên'); ?>
<?php $__env->startSection('PageContent'); ?>
<h2 class="ui header center aligned">
  DANH SÁCH HỌC VIÊN NGUỒN
  <div class="sub header">
    Tổng cộng <?php echo e($nam + $nu); ?> học viên. (<?php echo e($nam); ?> Nam - <?php echo e($nu); ?> Nữ)
  </div>
</h2>
<?php if(session('status')): ?>
  <div class="ui success message">
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
            <table id="myTable" class="ui selectable celled striped table">
              <thead>
                  <tr>
				            <th>STT</th>
                   
                    <th>NGƯỜI GIỚI THIỆU</th>                
                    <th>HỌ & TÊN</th>
                    <th>TÌNH TRẠNG</th>                
                    <th>TĨNH/TP</th>
                    <th>THAO TÁC</th>
                  </tr>
              </thead>
            </table>
        </div>
    </div>
</div>

<div class="ui modal mini">
  <div class="header">Xóa Học Viên</div>
  <div class="content">
    <p><span class="ui red">Lưu ý: </span> Bạn cần cân nhắc, <br> Hồ sơ này sẽ được xóa khỏi hệ thống vĩnh viễn!</p>
  </div>
  <div class="actions">
      <div class="ui black deny button">Không</div>
      <div class="ui green right labeled icon button">
        <a class="delsource" href="" style="color: white"> Có <i class="checkmark icon"></i> </a>
      </div>
    </div>
</div>
<script type="text/javascript">
function myFunction(idsource) {
  $(".ui.modal").modal('show');
  $(".delsource").attr("href",idsource + "/delsource");
}
</script>
<script type="text/javascript">
  $( document ).ready(function() {
     var table = $('#myTable').DataTable( {
          stateSave: true,
          processing: true,
          serverSide: true,
          ajax: '/datatables/source',
          columns: [
			        { data: 'id'},
              // { data: 'hinhanh'},
              { data: 'nguoigioithieu'},            
              { data: 'hoten'},
              { data: 'tinhtrang'},
              { data: 'tinhthanh'},
              { data: 'action'}],
          "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [1,3,4,5]
          } ],
          order: [0, "desc"],
          language: datatable_language,
		  "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              var index = iDisplayIndexFull + 1;
              $('td:eq(0)',nRow).html(index);
              return nRow;
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