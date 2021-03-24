<?php $__env->startSection('title', 'Sửa Đơn Hàng'); ?>
<?php $__env->startSection('PageContent'); ?>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA ĐƠN HÀNG DH-0<?php echo e($donhang->id); ?></h1>
	</div>	

	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			<?php if($errors->any()): ?>
				<div class="ui red message">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php if(session('status')): ?>
				<div class="ui positive message">
					<i class="close icon"></i>
					<div class="header">
						Thông Báo !
					</div>
					<p><?php echo e(session('status')); ?></p>
				</div>
			<?php endif; ?>
			<form class="ui form" action="" method="post" name="form_1" autocomplete="off" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				<div class="field thongtin">
					<input type="hidden" name="hocvien_id" value="<?php echo e($donhang->hocvien_id); ?>">	
					<div class="field">
						<h2>Thông báo đơn hàng</h2>
					</div>		
					<div class="three fields">
						<div class="field">
							<label>Đơn hàng</label>
							<select name="tendonhang" class="ui search dropdown">					 
					      		<option value="THỰC TẬP SINH" <?php if($donhang->tendonhang == 'THỰC TẬP SINH'): ?> selected <?php endif; ?>>THỰC TẬP SINH</option>
					      		<option value="KỸ SƯ" <?php if($donhang->tendonhang == 'KỸ SƯ'): ?> selected <?php endif; ?>>KỸ SƯ</option>
					      		<option value="ĐIỀU DƯỠNG" <?php if($donhang->tendonhang == 'ĐIỀU DƯỠNG'): ?> selected <?php endif; ?>>ĐIỀU DƯỠNG</option>	
					      		<option value="ĐẶC ĐỊNH" <?php if($donhang->tendonhang == 'ĐẶC ĐỊNH'): ?> selected <?php endif; ?>>ĐẶC ĐỊNH</option>				      	
						    </select>
						</div>

						
						<div class="field nghiepdoan">
							<label>Tên nghiệp đoàn</label>
							<select name="nghiepdoan" id="nghiepdoan" class="ui search dropdown">
								<option value="">ALL</option>
								<?php $__currentLoopData = $nghiepdoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									  <option value="<?php echo e($nd->id); ?>" <?php if($nghiepdoan->id == $nd->id): ?> selected <?php endif; ?> ><?php echo e($nd->tennghiepdoan); ?></option>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						      	
							</select>
						</div>

						<div class="field">
							<label>Tên công ty tiếp nhận (*)</label>
							<?php
								$doitacs = DB::table('doitacs')->where('id_nghiepdoan',$nghiepdoan->id)->get();
							?>
							<select name="doitac" id="doitac" class="ui search dropdown">	
					      		<?php $__currentLoopData = $doitacs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					      			<option value="<?php echo e($dt->id); ?>" <?php if($dt->id == $donhang->doitac_id): ?> selected <?php endif; ?> ><?php echo e($dt->tencongty); ?></option>
					      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						      	
						    </select>
						</div>
						<div class="field">
							<label>Tên công ty tiếp nhận (VN)</label>
							<input type="text" name="doitacvn" value="<?php echo e($donhang->doitacvn); ?>" >
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Địa chỉ</label>
							<input type="text" name="diachi" value="<?php echo e($donhang->diachi); ?>" >
						</div>
						<div class="field">
							<label>Chọn Ngành nghề</label>
							
							<select name="congviec" id="nganhnghe" class="ui search dropdown">		      			
								<?php $__currentLoopData = $nganhnghe_dt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($nn->id); ?>" <?php if($nn->id == $donhang->nganhnghe_id): ?> selected <?php endif; ?> ><?php echo e($nn->nganhnghe_vn); ?> / <?php echo e($nn->nganhnghe_jp); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				      	
							</select>
						</div>


						<div class="field">
							<label>Thêm Ngành nghề - Công ty</label>
							<input type="hidden" id="iddoitac" value="<?php echo e($donhang->doitac_id); ?>">
							<select class="ui fluid search dropdown" multiple="" id="nganhnghe_dt" name="nganhnghe_dt[]">
								<?php $__currentLoopData = $nganhnghes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($item->id); ?>"><?php echo e($item->nganhnghe_vn); ?> - "<?php echo e($item->nganhnghe_jp); ?>"</option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php if($nganhnghe_dt): ?>
									<?php $__currentLoopData = $nganhnghe_dt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option selected value="<?php echo e($item->id); ?>"><?php echo e($item->nganhnghe_vn); ?> - "<?php echo e($item->nganhnghe_jp); ?>"</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
								
							</select>
						</div>

					</div>
					<div class="two fields">
						<div class="field">
							<label>Nội dung công việc</label>
							<input type="text" name="tieudethem" value="<?php echo e($donhang->tieudethem); ?>" >
						</div>
						<div class="field">
							<label>Nội dung công việc JP</label>
							<input type="text" name="tieudethemjp" value="<?php echo e($donhang->tieudethemjp); ?>" >
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Nơi làm việc</label>
							<input type="text" name="noilamviec" value="<?php echo e($donhang->noilamviec); ?>">
						</div>
						<div class="field">
							<label>Thời gian làm việc</label>
							<input type="text" name="thoigian" value="<?php echo e($donhang->thoigian); ?>">
						</div>
						<div class="field">
							<label>Lương cơ bản</label>
							<input type="text" name="luongcoban" value="<?php echo e($donhang->luongcoban); ?>">
						</div>
					</div>
					<div class="four fields">
						
						
						<div class="field twelve wide column">
							<label>Các khoản khấu trừ</label>
							<textarea rows="3" name="khautru" placeholder="thuế: 100 yên + bảo hiểm: 100 yên + tiền nhà: 100 yên "><?php echo e($donhang->khautru); ?></textarea>
						</div>
						<div class="field four wide column">
							<label>Lương thực lãnh</label>
							<input type="text" name="luongthuclanh" value="<?php echo e($donhang->luongthuclanh); ?>" >
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Số lượng trúng tuyển</label>
							<input type="text" name="soluongtuyen" value="<?php echo e($donhang->soluongtuyen); ?>" >
						</div>
						<div class="field">
							<label>Số lượng trúng tuyển JP</label>
							<input type="text" name="soluongtuyenjp" value="<?php echo e($donhang->soluongtuyenjp); ?>" >
						</div>
						<div class="field">
							<label>Tổng số lượng ứng viên</label>
							<input type="text" name="soluongungvien" value="<?php echo e($donhang->soluongungvien); ?>" >
						</div>
						<div class="field">
							<label>Tổng số lượng ứng viên JP</label>
							<input type="text" name="soluongungvienjp" value="<?php echo e($donhang->soluongungvienjp); ?>" >
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Dự kiến Xuất cảnh</label>
							<div class="ui calendar">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" class="date-dukien" name="dukienxc" value="<?php echo e($donhang->dukienxc); ?>" >
								</div>
							</div>
						</div>
						<div class="field">
							<label>Trình độ</label>
							<input type="text" name="trinhdo" value="<?php echo e($donhang->trinhdo); ?>" >
						</div>
						<div class="field">
							<label>Nơi thi</label>
							<input type="text" name="noithi" value="<?php echo e($donhang->noithi); ?>" >
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Ngày tuyển bắt đầu (*)</label>
							<div class="ui calendar">
							    <div class="ui input left icon">
							      <i class="calendar icon"></i>
							      <input type="text" class="date-bd" name="ngaytuyenbd" value="<?php echo e($donhang->ngaytuyenbd); ?>" >
							    </div>
							</div>
						</div>
						<div class="field">
							<label>Ngày tuyển kết thúc (*)</label>
							<div class="ui calendar" >
							    <div class="ui input left icon">
							      	<i class="calendar icon"></i>
							      	<input type="text" class="date-kt" name="ngaytuyenkt" value="<?php echo e($donhang->ngaytuyenkt); ?>" >
							    </div>
							</div>
						</div>
					</div>
					<div class="field">
							<label>Yêu cầu khác</label>
							<textarea rows="5" name="yeucau"><?php echo e($donhang->yeucau); ?></textarea>
						</div>
					<div class="field">
						<h2>Thông tin đơn hàng</h2>
						
					</div>	
					<div class="two fields">
						<div class="field">
							<label>Người quản lý đơn hàng</label>
							<input type="text" name="nguoiqldh" value="<?php echo e($donhang->nguoiqldh); ?>">
						</div>
						<div class="field">
							<label>Người quản lý đơn hàng JP</label>
							<input type="text" name="nguoiqldhjp" value="<?php echo e($donhang->nguoiqldhjp); ?>">
						</div>
					</div>
					<div class="two fields">
							<div class="field">
								<label>Ngày phỏng vấn</label>
								<div class="ui calendar">
									<div class="ui input left icon">
										<?php
											$LogintDate = strtotime($donhang->ngaypv);
            								$ngaypv = date('d-m-Y', $LogintDate);
										?>
										<i class="calendar icon"></i>
										<input type="text" class="date-pv" name="ngaypv" value="<?php echo e($ngaypv); ?>" >
									</div>
								</div>
							</div>
							<div class="field">
								<label>Ngày gửi lý lịch</label>
								<div class="ui calendar">
									<div class="ui input left icon">
										<i class="calendar icon"></i>
										<input type="text" class="date-guill" name="ngayguill" value="<?php echo e($donhang->ngayguill); ?>" >
									</div>
								</div>
							</div>
						</div>					
					<div class="field ">
						<h3>Đính kèm file</h3>
						<input type="hidden" name="file_hc_hidden" value="<?php echo e($donhang->hc_file); ?>">
						<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
							<i class="ui upload icon"></i> <b> Tải Lên File </b>  ( PDF, DOC, DOCX ) 
						  </label>
						  <input id="hc-file" name='hc_file[]' value="<?php echo e($donhang->hc_file); ?>" type="file" style="display:none;" multiple>
						  <?php 
							  $timestamp = strtotime($donhang->created_at);
							$year = date("Y", $timestamp);
							$month = date("m", $timestamp);
						  ?>
						  <?php if($donhang->hc_file): ?>
						  <?php 
							  $hc_file = json_decode($donhang->hc_file); 
						  ?>
						  <?php $__currentLoopData = $hc_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <label class="ui white basic field " style="text-align: left;">
							  <i class="ui download icon"></i>
							  <a href="<?php echo e(url('/uploads/donhangpdfs/'.$year.'/'.$month.'/'.$donhang->id.'/hc/'.$hc)); ?>" target="_blank"><?php echo e($hc); ?></a>
							  <i class="ui trash icon red right removefile" datatype="hc" datafile="<?php echo e($hc); ?>"></i>
						  </label>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  <?php endif; ?>
					</div>
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>	

				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="<?php echo e(url('donhang')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
				
				<div class="ui modal tiny test">
					<div class="header">Xóa File </div>
					<div class="content">
					  <p><b>Lưu ý:</b> file sẽ bị xóa vĩnh viễn khỏi hệ thống</p>
					</div>
					<div class="actions">
					  <div class="ui approve button green approve-delete"> <i class="icon check"></i> OK</div>
					  <div class="ui cancel button red temp-delete"> <i class="icon linkify"></i>Thêm file xóa</div>
					  <div class="ui cancel button red cancel-delete"> <i class="icon refresh"></i> Hủy</div>
					</div>
			  </div>
				
			</form>
		</div>
	</div>
<script type="text/javascript">
	// $(".date-dukien").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	// $(".date-bd").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	// $(".date-kt").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	// $(".date-pv").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
	// $(".date-guill").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	$(".date-dukien").inputmask("99/99/9999");
	$(".date-bd").inputmask("99/99/9999");
	$(".date-kt").inputmask("99/99/9999");
	$(".date-pv").inputmask("99/99/9999");
	$(".date-guill").inputmask("99/99/9999");
</script>
<script>
	$('.ui.search.dropdown').dropdown({clearable: true});
	$('.ui.selection.dropdown').dropdown();
</script>

<style type="text/css">
	.custom-file-upload {
	  border: 1px solid #ccc;
	  display: inline-block;
	  padding: 6px 12px;
	  cursor: pointer;
	  margin: 10px;
  }
  label {
	  font-weight: bold !important;
	  color: cadetblue;
  }
</style>
<script type="text/javascript">
  $('#hc-file').change(function() {
	  var i = $(this).prev('label').clone();
	  var file = $('#hc-file')[0].files[0].name;
	  $(this).prev('label').text(file);
  });

</script>
<script>
$(document).ready(function(){
  $(".removefile").click(function(){
	  $(".test").modal('show');
	  var ifile =  $(this).attr("datafile");
	  var typefile =  $(this).attr("datatype");
	  $(".test .header").append("<b>"+ifile+",</b>");
	  $(".approve-delete").click(function(){
		  $.get((ifile + "/" + typefile + "/removefile"), function(data, status){
			location.reload();
		  });
	  });
	  $(".cancel-delete").click(function(){
		  location.reload();
	  });
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<script>
	 $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$("#nganhnghe_dt").on("change", function() {
		var nganhnghe = $(this).val();
		var id = $('#iddoitac').val();
		console.log(id);
		console.log(nganhnghe);
		$.post("/donhang/nganhnghe-dt/"+id+"/ajax",
        {
            nganhnghe: nganhnghe
        },
        function(data){
			$("#nganhnghe").empty();
			function printContentArray(array){
				array.forEach(function print(element){
					$("#nganhnghe").append("<option value='"+element.id+"'>"+element.nganhnghe_vn+" / "+element.nganhnghe_jp+"</option>");		
				});
			}
			printContentArray(data);	
			console.log(data);
      });
	});


	$("#nghiepdoan").on("change", function() {
		var id = $(this).val();
		$.get("/donhang/nghiepdoan/"+id+"/ajax", function(data, status){
			$("#doitac").empty();
			$("#doitac").append("<option value=''>ALL</option>");
			function printContentArray(array){
				array.forEach(function print(element){
					$("#doitac").append("<option value='"+element.id+"'>"+element.tencongty+"</option>");		
				});
			}
			printContentArray(data);	
		});	
	});
	$("#doitac").on("change", function() {
		var id = $(this).val();

		$.get("/donhang/doitac/"+id+"/ajax", function(data, status){
			$("#nganhnghe").empty();
			function printContentArray(array){
				array.forEach(function print(element){
					$("#nganhnghe").append("<option value='"+element.id+"'>"+element.nganhnghe_vn+" / "+element.nganhnghe_jp+"</option>");		
				});
			}
			printContentArray(data);	
			console.log(data);
		});	
	});



</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>