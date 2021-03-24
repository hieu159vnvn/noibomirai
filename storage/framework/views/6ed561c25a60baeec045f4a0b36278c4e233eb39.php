<?php $__env->startSection('title', 'Điểm danh'); ?>
<?php $__env->startSection('PageContent'); ?>

  <h2 class="ui header center aligned">
    QUẢN LÝ ĐIỂM DANH   
    <div class="sub header">
      Tổng cộng <?php echo e(count($daotao)); ?> lớp học.
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

		<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
			<?php echo e(csrf_field()); ?>	
			<div class="ui secondary menu">
	        	<div class="right menu">
					<button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i> Kiểm tra</button>
				</div>
			</div>
			
			<div class="ui segments">
				<div class="ui segment">
					<div class="ui calendar" id="date-only">
						<label>CHỌN NGÀY:</label>
						<div class="ui input left icon">
							<i class="calendar icon"></i>
							<input type="text" name="mdate" value="<?php echo e(date("Y-m-d")); ?>">
						</div>
					</div>
				</div>
				<div class="ui segment">
					<h2 class="ui header centered ">Danh sách Lớp Học Hôm nay </h2>
					<p class="ui header centered"><?php echo e(date("d-m-Y")); ?></p>
					<table id="data-table" class="ui celled striped table left">	
						<thead class="full-width">
						<tr style="text-align: left;">
							<th style="text-align: left;">
								<div class="ui toggle red checkbox">
								<input type="checkbox"  class="checkedall" name="mcheckall" >
								<label>CHECK ALL</label>
								</div>
							</th>
							<th>GIÁO VIÊN</th>
							<th>LỚP HỌC</th>
							<th>ĐIỂM DANH</th>			          
						</tr>
						</thead>
						<tbody>		
							<tr>
								<td colspan="4" style="text-align: left;"><h3 class="ui left">Phòng đào tạo</h3></td>
							</tr>
							<?php $__currentLoopData = $daotao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($dt->coso == 3): ?>
								<tr style="text-align: left;">
									<td>
										<div class="ui toggle checkbox">
											<?php if(in_array($dt->id,$diemdanh)): ?>
												<?php if(in_array($dt->id,$khoaduyet)): ?>
													<input type="checkbox" class="checked" name="mcheck[]" value="<?php echo e($dt->id); ?>"> <label style="color: red">Đã duyệt</label>
												<?php else: ?> 
													<input type="checkbox" class="checked" name="mcheck[]" checked  value="<?php echo e($dt->id); ?>"> <label></label>
												<?php endif; ?>
											<?php else: ?>
												<input type="checkbox" class="checked" name="mcheck[]" value="<?php echo e($dt->id); ?>" disabled> <label></label>
											<?php endif; ?>
										</div>
									</td>
									<td>
										<?php $__currentLoopData = $giaovien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($gv->id == $dt->gvcn): ?>
												<strong><?php echo e($gv->hoten); ?></strong>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</td>									
									<td> Lớp <?php echo e($dt->ten_lop_hoc); ?> </td>
									<td>
										<div class="item">
											<?php if(in_array($dt->id,$diemdanh) ): ?>
												<?php if(Auth::user()->hasRole('Đào Tạo')): ?>
													<?php if(in_array($dt->id,$khoaduyet)): ?>
														<a href="<?php echo e(url('diemdanh/' . $dt->id . '/add')); ?>" class="mini ui icon orange button"><i class="check icon"></i> Đã Duyệt</a>														
													<?php else: ?>
														<a href="<?php echo e(url('diemdanh/' . $dt->id . '/add')); ?>" class="mini ui icon blue button"><i class="check icon"></i> Đã Điểm danh</a>
													<?php endif; ?>
												<?php else: ?>
													<div class="mini ui icon blue button"><i class="check icon"></i> Đã điểm danh</div>
												<?php endif; ?>
											<?php else: ?> 
												<?php if(Auth::user()->hasRole('Đào Tạo')): ?>
													<a href="<?php echo e(url('diemdanh/' . $dt->id . '/add')); ?>" class="mini ui icon red button"><i class="circle icon"></i> Chưa điểm danh</a>
												<?php else: ?>
													<div class="mini ui icon red button"><i class="circle icon"></i> Chưa điểm danh</div>
												<?php endif; ?>
											<?php endif; ?>
											<?php if($dt->email == Auth::user()->email): ?>
												<a href="<?php echo e(url('diemdanh/' . $dt->id . '/add')); ?>" class="mini ui icon green button"><i class="check icon"></i> Điểm danh của bạn</a>
											<?php endif; ?>

											

										</div>	
										
									</td>
								</tr>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					<div class="column">
					
					<br/>
					<hr/>
					<div class="ui column">
						<div class="ui selection dropdown">
							Điểm Danh Thay "Phòng đào tạo"
							<i class="dropdown icon"></i>
							<div class="menu">
								<?php $__currentLoopData = $daotao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($dt->coso == 3): ?>
									<a class="item" href="<?php echo e(url('diemdanh/' . $dt->id . '/add')); ?>">Lớp <?php echo e($dt->ten_lop_hoc); ?> -  Phòng đào tạo</a>
									<?php endif; ?> 
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>	
				</div>
				</div>
			</div>
			<div class="ui secondary menu">
	        	<div class="right menu">
					<button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i> Kiểm tra</button>
				</div>
			</div>
		</form>
			
	<script type="text/javascript">
		$('.ui.dropdown').dropdown('hide');
		$(document).ready(function(){
			$(".checkedall").click(function(){
				var checked = $(".checkedall").is(":checked");
				if (checked == true) {
					$('.checked').prop( "checked", true );
				}
				if (checked == false) {
					$('.checked').prop( "checked", false );
				}
			});
			var calendarOpts = {
				type: 'date',
				formatter: {
					date: function (date, settings) {
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
						// return year + '-' + month + '-' + day;
						return day + '-' + month + '-' + year;
		        }
		    }
		};
		$('#date-only').calendar(calendarOpts);
	});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>