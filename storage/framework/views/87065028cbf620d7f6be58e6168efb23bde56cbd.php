<?php $__env->startSection('title', 'Tạo Đơn Hàng'); ?>
<?php $__env->startSection('PageContent'); ?>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">TẠO ĐƠN HÀNG</h1>
	</div>	
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
	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			<div class="ui segments">
		        <div class="ui segment">
		         	<div class="ui secondary menu">		         		
		                <div class="right menu">
		              	<a href="<?php echo e(url('donhang')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button green btn-align-right"><i class="save icon"></i>Lưu</button>
		              </div>
		            </div>
				 </div>

     			<div class="ui segment">					
						<?php echo e(csrf_field()); ?>

						<div class="field thongtin">
							<div class="field">
								<h2>Thông báo đơn hàng</h2>			
							</div>
							<div class="four fields">
								<div class="field">
									<label>Đơn hàng</label>
									<select name="tendonhang" class="ui search dropdown">					 
							      		<option value="THỰC TẬP SINH">THỰC TẬP SINH</option>
							      		<option value="KỸ SƯ">KỸ SƯ</option>
							      		<option value="ĐIỀU DƯỠNG">ĐIỀU DƯỠNG</option>		
							      		<option value="ĐẶC ĐỊNH">ĐẶC ĐỊNH</option>			      	
								    </select>
								</div>
								
								<div class="field nghiepdoan">
									<label>Tên nghiệp đoàn</label>
									<select name="nghiepdoan" id="nghiepdoan" class="ui search dropdown">
										<option value="">ALL</option>
										<?php $__currentLoopData = $nghiepdoan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							      			<option value="<?php echo e($nd->id); ?>"><?php echo e($nd->tennghiepdoan); ?></option>
							      		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						      	
								    </select>
								</div>
								<div class="field doitac">
									<label>Tên công ty tiếp nhận (JP *)</label>
									<select name="doitac" id="doitac" class="ui search dropdown">
										<option value="">ALL</option>
								    </select>
								</div>
								<div class="field">
									<label>Tên công ty tiếp nhận (VN)</label>
									<input type="text" name="doitacvn" value="<?php echo e(old('doitacvn')); ?>" placeholder="Tên công ty tiếp nhận (vn)">
								</div>
							</div>
							<div class="three fields">
								<div class="field">
									<label>Địa chỉ </label>
									<input type="text" name="diachi" value="<?php echo e(old('diachi')); ?>" placeholder="địa chỉ làm việc">
								</div>
								<div class="field nganhnghe">
									<label>Chọn Ngành nghề</label>
									<select name="congviec" id="nganhnghe" class="ui search dropdown">
										<option value="">ALL</option>
								    </select>
								</div>
								
								<div class="field">
									<label>Thêm Ngành nghề - Công ty</label>
									<input type="hidden" id="iddoitac" value="">
									<select class="ui fluid search dropdown" multiple="" id="nganhnghe_dt" name="nganhnghe_dt[]">
										<?php $__currentLoopData = $nganhnghe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($item->id); ?>"><?php echo e($item->nganhnghe_vn); ?> - "<?php echo e($item->nganhnghe_jp); ?>"</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
									</select>
								</div>


							</div>
							<div class="two fields">
								<div class="field">
									<label>Nội dung công việc</label>
									<input type="text" name="tieudethem" value="<?php echo e(old('tieudethem')); ?>" placeholder="Nội dung công việc tiếng Việt">
								</div>
								<div class="field">
									<label>Nội dung công việc JP</label>
									<input type="text" name="tieudethemjp" value="<?php echo e(old('tieudethemjp')); ?>" placeholder="Nội dung công việc tiếng Nhật">
								</div>
							</div>
							<div class="three fields">
								<div class="field">
									<label>Nơi làm việc</label>
									<input type="text" name="noilamviec" value="<?php echo e(old('noilamviec')); ?>" placeholder="nơi làm việc">
								</div>
								<div class="field">
									<label>Thời gian làm việc</label>
									<input type="text" name="thoigian" value="<?php echo e(old('thoigian')); ?>" placeholder="6h-18h" >
								</div>
								<div class="field">
									<label>Lương cơ bản</label>
									<input type="text" name="luongcoban" value="<?php echo e(old('luongcoban')); ?>" placeholder="Yên" >
								</div>
							</div>
							<div class="four fields">
								
								<div class="field twelve wide column">
									<label>Các khoản khấu trừ (thuế, bảo hiểm, tiền nhà)</label>
									<textarea rows="3" name="khautru" placeholder="thuế: 100 yên + bảo hiểm: 100 yên + tiền nhà: 100 yên "><?php echo e(old('khautru')); ?></textarea>
								</div>
								<div class="field four wide column">
									<label>Lương thực lãnh</label>
									<input type="text" name="luongthuclanh" value="<?php echo e(old('luongthuclanh')); ?>" placeholder="Yên" >
								</div>
							</div>
							<div class="four fields">
								<div class="field">
									<label>Số lượng trúng tuyển</label>
									<input type="text" name="soluongtuyen" value="<?php echo e(old('soluongtuyen')); ?>" placeholder="10 nữ">
								</div>
								<div class="field">
									<label>Số lượng trúng tuyển JP</label>
									<input type="text" name="soluongtuyenjp" value="<?php echo e(old('soluongtuyenjp')); ?>" placeholder="10 nữ (tiếng Nhật) ">
								</div>
								<div class="field">
									<label>Tổng số lượng ứng viên</label>
									<input type="text" name="soluongungvien" value="<?php echo e(old('soluongungvien')); ?>" placeholder="20 nữ ">
								</div>
								<div class="field">
									<label>Tổng số lượng ứng viên JP</label>
									<input type="text" name="soluongungvienjp" value="<?php echo e(old('soluongungvienjp')); ?>" placeholder="20 nữ (tiếng Nhật) ">
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Dự kiến Xuất cảnh</label>
									<div class="ui calendar" >
										<div class="ui input left icon">
											<i class="calendar icon"></i>
											<input type="text" class="date-dukien" name="dukienxc" value="<?php echo e(old('dukienxc')); ?>" >
										</div>
									</div>
								</div>
								<div class="field">
									<label>Trình độ</label>
									<input type="text" name="trinhdo" value="<?php echo e(old('trinhdo')); ?>" placeholder="Cao Đẵng / Đại Học" >
								</div>
								<div class="field">
									<label>Nơi thi</label>
									<input type="text" name="noithi" value="<?php echo e(old('noithi')); ?>"  >
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Ngày tuyển bắt đầu (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" class="date-bd" name="ngaytuyenbd" value="<?php echo e(old('ngaytuyenbd')); ?>" >
									    </div>
									</div>
								</div>
								<div class="field">
									<label>Ngày tuyển kết thúc (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" class="date-kt" name="ngaytuyenkt" value="<?php echo e(old('ngaytuyenkt')); ?>" >
									    </div>
									</div>
								</div>	
							</div>
							<div class="field">
								<label>Yêu cầu khác</label>
								<textarea rows="5" name="yeucau"><?php echo e(old('yeucau')); ?></textarea>
							</div>
							<div class="field">
								<h3>Thông tin đơn hàng</h3>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Người quản lý đơn hàng</label>
									<input type="text" name="nguoiqldh" value="<?php echo e(old('nguoiqldh')); ?>" placeholder="Người quản lý đơn hàng">
								</div>
								<div class="field">
									<label>Người quản lý đơn hàng JP</label>
									<input type="text" name="nguoiqldhjp" value="<?php echo e(old('nguoiqldhjp')); ?>" placeholder="Người quản lý đơn hàng tiếng nhật">
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Ngày phỏng vấn</label>
									<div class="ui calendar">
										<div class="ui input left icon">
											<i class="calendar icon"></i>
											<input type="text" class="date-pv" name="ngaypv" value="<?php echo e(old('ngaypv')); ?>" >
										</div>
									</div>
								</div>
								<div class="field">
									<label>Ngày gửi lý lịch</label>
									<div class="ui calendar">
										<div class="ui input left icon">
											<i class="calendar icon"></i>
											<input type="text" class="date-guill" name="ngayguill" value="<?php echo e(old('ngayguill')); ?>" >
										</div>
									</div>
								</div>
							</div>
							<div class="field">
								<h3>Đính kèm file</h3>
								<div class="ui fluid ">
									<input type="hidden" name="file_hc_hidden" value="create">
									<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
										<i class="ui upload icon"></i> <b> Tải Lên File</b> ( PDF, DOC, DOCX)
									  </label>
									  <input id="hc-file" name='hc_file[]' type="file" style="display:none;" multiple>
								</div>
							</div>
							<div class="inline field">
							<label>(*) Trường bắt buộc phải nhập</label>
							</div>		
						</div>	
					</div>
					<div class="ui segment">
			         	<div class="ui secondary menu">
			              <div class="right menu">
			              	<a href="<?php echo e(url('donhang')); ?>" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
							<button type="submit" class="ui labeled icon button green btn-align-right"><i class="save icon"></i>Lưu</button>
			              </div>
			            </div>
			     	</div>
				</div>	
			</div>
		</div>
	</form>
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
  <script type="text/javascript">

	  $('#hc-file').change(function() {
		  var i = $(this).prev('label').clone();
		  var file = $('#hc-file')[0].files[0].name;
		  $(this).prev('label').text(file);
	  });
  </script>
<script>
	$('.ui.search.dropdown').dropdown({clearable: true});
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
		$('#iddoitac').val(id);
		$.get("/donhang/doitac/"+id+"/ajax", function(data, status){
			$("#nganhnghe").empty();
			function printContentArray(array){
				array.forEach(function print(element){
					$("#nganhnghe").append("<option value='"+element.id+"'>"+element.nganhnghe_vn+" / "+element.nganhnghe_jp+"</option>");
					$("#nganhnghe_dt").append("<option selected value='"+element.id+"'>"+element.nganhnghe_vn+" / "+element.nganhnghe_jp+"</option>");						
				});
			}
			printContentArray(data);	
			console.log(data);
		});	
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>