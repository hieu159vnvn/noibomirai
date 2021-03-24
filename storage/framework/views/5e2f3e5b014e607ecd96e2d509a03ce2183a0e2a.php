<?php $__env->startSection('title', 'Thêm Lớp Học'); ?>
<?php $__env->startSection('PageContent'); ?>
	<?php
		function ym($time) {
			$timestamp = strtotime($time);
			$year = date("Y", $timestamp);
			$month = date("m", $timestamp);
			return $year.'/'.$month;
		}
	?>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM LỚP HỌC</h1>
	</div>
	<?php if(session('status')): ?>
		<div class="alert alert-success">
			<?php echo e(session('status')); ?>

		</div>
	<?php endif; ?>	
	<?php if($errors->any()): ?>
	    <div class="alert alert-danger">
	        <ul>
	            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <li><?php echo e($error); ?></li>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </ul>
	    </div>
	<?php endif; ?>	
	<div class="ajax-messenger"></div>
	<div class="ui two column centered grid main-content">
		<div class="fifteen wide column">
			<form class="ui form" action="" method="post" name="form_1" id="form" data_id="add" autocomplete="off">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">			
					<div class="two fields">
						<div class="field">
							<label>Tên lớp học (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="ten_lop_hoc" value="<?php echo e(old('ten_lop_hoc')); ?>" required>
							</div>
						</div>
						<div class="field">
							<label>Ngày khai giảng (*)</label>
							<div class="ui calendar" id="date-only">
							    <div class="ui input left icon">
							      <i class="calendar icon"></i>
							      <input type="text" name="ngay_khai_giang" value="<?php echo e(old('ngay_khai_giang')); ?>" required >
							    </div>
							    <div class="ngay-sinh">	
							    </div>
							</div>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Giáo viên chủ nhiệm (*)</label>
							<div class="ui fluid search normal selection dropdown">
						        <input type="hidden" name="gvcn" value="">
						        <i class="dropdown icon"></i>
						        <input class="search" autocomplete="off" tabindex="0"><span class="sizer" style=""></span><div class="default text">Chọn giáo viên</div>
						        <div class="menu transition hidden" tabindex="-1">
						        	<?php $__currentLoopData = $giaovien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="item" data-value="<?php echo e($gv->id); ?>">
								        		<img src="<?php echo e($gv->hinhanh); ?>"> <?php echo e($gv->hoten); ?>

									        </div>
									        <option value="<?php echo e($gv->id); ?>"></option>
						            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					        
		      					</div>
							</div>
						</div>
						<div class="field">
							<label>Cơ sở (*)</label>
							<select name="coso">
								<option value="3">Phòng đào tạo</option>
							</select>
						</div>
						
					</div>	
				<div class="field">
					<label>Danh sách học viên</label>

					
					  <div class="sixteen wide column">
						<div class="ui segments">
							<div class="ui segment">
								<table id="myTable" class="ui selectable celled striped table">
									<thead>
										<tr>
											<th>STT</th>
											<th>HỌ & TÊN</th>
											<th>Ảnh</th>
											<th>NGÀY SINH</th>
											<th>GHÉP LỚP</th>
											<th>CHUYỂN LỚP</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<td></td>
											<td>HỌ & TÊN</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

      			</div>
      
				</div>
				<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
				</div>	
				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="<?php echo e(url('daotao')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	 
	 <div class="ui tiny image-modal modal">
        <div class="content" style="text-align: center"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<style>
	.dataTables_wrapper .dataTables_filter {
		float: right;
		padding-right: 10px;
	}

	.ui.form input:not([type]) {
		width: 90%;
	}

	.hagiaovien {
		height: 30px;
	}

</style>
<script>
  	$( "#form" ).on( "click",".image",function (event) {
        $(".image-modal").modal('show');
        var header = '<img src=' +$(this).attr('src') +'>';
        $(".image-modal .content").html(header);
    });


	$.fn.dataTable.ext.errMode = 'throw';
	$(document).ready(function() {
		var id = $("#form").attr("data_id");
		console.log(id);
		var table = $('#myTable').DataTable({
			stateSave: true,
			processing: true,
			serverSide: true,
			ajax: '/datatables/daotao/' + id,
			columns: [{
					data: 'id'
				},
				{
					data: 'hoten'
				},
				{
					data: 'ngaysinh'
				},
				{
					data: 'hinhanh'
				},
				{
					data: 'ghep',
					width: "30%"
				},
				{
					data: 'chuyen',
					width: "20%"
				},
			],
			"columnDefs": [{
				"searchable": true,
				"orderable": false,
				"targets": 1
			}],
			ordering: false,
			order: [0, "desc"],
			language: datatable_language,
			// "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			// 	var index = iDisplayIndexFull + 1;
			// 	$('td:eq(0)',nRow).html(index);
			// 	return nRow;
			// },
			search: {
				"regex": true
			},
			initComplete: function() {
				this.api().columns([1]).every(function() {
					var column = this;
					var input = document.createElement("input");
					input.setAttribute('placeholder', 'TÌM KIẾM');
					$(input).appendTo($(column.footer()).empty())
						.on('keyup change', function() {
							column.search($(this).val(), false, false, false).draw();
						});
				});
			}

		});
	});

</script>


<script type="text/javascript">
        $('.ui.dropdown').dropdown('hide');
        $(document).ready(function() {
            var length = $('.selection option').length;
            var i;
            for (i = 0; i < length; i++) {
                var selected = $('.selection option:eq("' + i + '")').is(':selected');
                if (selected == true) {
                    $('.item1 :eq("' + i + '")').trigger('click');
                };
            }
        });
        var calendarOpts = {
            type: 'date',
            formatter: {
                date: function(date, settings) {
                    if (!date) return '';
                    var day = date.getDate() + '';
                    if (day.length < 2) {
                        day = '0' + day;
                    }
                    var month = (date.getMonth() + 1) + '';
                    if (month.length < 2) {
                        month = '0' + month;
                    }
                    var year = date.getFullYear();
                    return day + '-' + month + '-' + year;
                }
            }
        };
        $('#date-only').calendar(calendarOpts);

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>