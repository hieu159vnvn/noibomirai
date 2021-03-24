<?php $__env->startSection('title', 'In Đơn Hàng'); ?>
<?php $__env->startSection('PageContent'); ?>
<?php
function getAge($birthdate = '0000/00/00') {
    if ($birthdate == '0000/00/00') return 'Unknown';
    $bits = explode('/', $birthdate);
    $age = date('Y') - $bits[0] - 1;
    $arr[1] = 'm';
    $arr[2] = 'd';
    for ($i = 1; $arr[$i]; $i++) {
        $n = date($arr[$i]);
        if ($n < $bits[$i])
            break;
        if ($n > $bits[$i]) {
            ++$age;
            break;
        }
    }
    return $age;
}
function stringtodate($var) {
	$date = str_replace('/', '-', $var);
	return date('Y-m-d', strtotime($date));
}
function khongdau($str) {
	  $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	  $str = preg_replace("/(đ)/", 'd', $str);
	  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	  $str = preg_replace("/(Đ)/", 'D', $str);
	  return $str;
	}
?>
	<h2 class="ui header center aligned">
    	ĐƠN HÀNG - <?php echo e($donhang->tendonhang); ?>    
	    <div class="sub header">
	      	Công ty <strong><?php echo e($doitac->tencongty); ?></strong>. Nghiệp đoàn <strong><?php echo e($nghiepdoan->tennghiepdoan); ?></strong>.
	    </div>
 	</h2>

	<div class="ui grid right aligned">
		<div class="column">
			<a href="<?php echo e(url('donhang')); ?>" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
			<?php if(count($hoso)>0): ?>
				<a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('listorder')"><i class="save icon"></i>IN DANH SÁCH</a>
				<a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('resultorder')"><i class="save icon"></i>IN KẾT QUẢ PHỎNG VẤN</a>
				<a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('coverorder')"><i class="save icon"></i>IN BÌA</a>	
				<a class="ui labeled icon green button" id="print" href=""> <i class="print icon"></i>in</a>
			<?php else: ?>
				<?php if (\Entrust::can('donhang-show')) : ?>
	            <a href="<?php echo e(url('donhang/' . $donhang->id . '/create')); ?>" class="ui labeled icon blue button" title="Ghép đơn hàng"><i class="plus icon"></i>GHÉP ĐƠN HÀNG</a>
	            <?php endif; // Entrust::can ?>
            <?php endif; ?>
		</div>
	</div>
	<div class="ui segments">
		<div class="ui segment">
			<div class="ui two column main-content">	
				<div class="fifteen wide column">
					<form class="ui form" action="" method="post" name="form_1">
						<?php echo e(csrf_field()); ?>

						<div class="field thongtin">
							<?php if(count($hoso)>0): ?>
							 <table id="data-table" class="ui selectable celled striped table">
							      <thead class="full-width">
							        <tr>
							          <th>SỐ THỨ TỰ</th>
							          <th>ẢNH</th>
							          <th>HỌ TÊN</th>
							          <th>NGÀY SINH</th>
							          <th>ĐIỆN THOẠI</th>
									  <?php if (\Entrust::can('donhang-check')) : ?>
							          <th>ĐẬU - RỚT</th>
									  <?php endif; // Entrust::can ?>
							        </tr>
							      </thead>
							      <tbody>
							        <?php $__currentLoopData = $hoso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							            <tr>
								            <td><input style="width: 70px" type="number" class="change-stt" name="stt" value="<?php echo e($hs->stt); ?>" data-id="<?php echo e($hs->id); ?>"></td>
											<td>
												
												<?php
													$timestamp_image = strtotime($hs->created_at);
													$year_image = date("Y", $timestamp_image);
													$month_image = date("m", $timestamp_image);
												?>
												<?php if(($hs->hinhanh != NULL) && (strlen($hs->hinhanh) < 100)): ?>
													<img src="<?php echo e(url('')); ?>/hocviens/<?php echo e($year_image); ?>/<?php echo e($month_image); ?>/<?php echo e($hs->hinhanh); ?>" width="50px">
												<?php else: ?>
													<img src="<?php echo e($hs->hinhanh); ?>" width="50px">
												<?php endif; ?>
											</td>
											<td>
												<a href="<?php echo e(url('hoso/' . $hs->id . '/show')); ?>"><?php echo e($hs->hoten); ?></a>
												<a href="<?php echo e(url('hoso/'.$hs->id.'/tran')); ?>" class="mini ui icon <?php if($hs->id_hocvien): ?> yellow <?php else: ?> blue <?php endif; ?>  button" title="Dịch"><i class="language icon"></i></a>
												<div class="ui checkbox print"><input type="checkbox" class="printcheck" name="print" print="<?php echo e($hs->id); ?>"><label>IN</label></div>
											</td>
								            <td><?php echo e($hs->ngaysinh); ?></td>
								            <td><?php echo e($hs->dienthoai); ?></td>
											<?php if (\Entrust::can('donhang-check')) : ?>
								            <td>
								            	<div class="ui mini buttons">
												  <div class="ui button pvdau <?php if($hs->tinhtrang == 2): ?> green <?php endif; ?> " data-id="<?php echo e($hs->id); ?>">Đậu</div>
												  <div class="or"></div>
												  <div class="ui button pvrot <?php if($hs->tinhtrang == 4): ?> red <?php endif; ?>" data-id="<?php echo e($hs->id); ?>">Rớt</div>
												</div>
								            </td>
											<?php endif; // Entrust::can ?>
							         	</tr>
							        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							      </tbody>
							      <tfoot class="full-width"></tfoot>
							  </table>
							<?php endif; ?>

				            <h3 class="ui header">THÔNG TIN ĐƠN HÀNG</h3>
							<div class="three fields">
								<div class="field">
									<label>Tên công ty tiếp nhận (*)</label>
									<input name="doitac" value="<?php echo e($doitac->tencongty); ?>" readonly="">						
								</div>
								<div class="field">
									<label>Công việc (Ngành nghề)</label>
									<input name="congviec" value="<?php echo e($nganhnghe->nganhnghe_vn); ?>" readonly="">
								</div>
								<div class="field">
									<label>Thời gian làm việc</label>
									<input type="text" name="thoigian" value="<?php echo e($donhang->thoigian); ?>" readonly="">
								</div>
								
							</div>
							<div class="three fields">
								<div class="field">
									<textarea rows="3" readonly=""> <?php echo e($donhang->khautru); ?></textarea>
								</div>
								<div class="field">
									<label>Lương cơ bản</label>
									<input type="text" name="luongcoban" value="<?php echo e($donhang->luongcoban); ?>" readonly="">
								</div>
								<div class="field">
									<label>Lương thực lãnh</label>
									<input name="luongthuclanh" value="<?php echo e($donhang->luongthuclanh); ?>" readonly="" >
								</div>
							</div>
							<div class="four fields">
								<div class="field">
									<label>Số lượng tuyển</label>
									<input name="soluongtuyen" value="<?php echo e($donhang->soluongtuyen); ?>" readonly="" >
								</div>
								<div class="field">
									<label>Dự kiến Xuất cảnh</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="dukienxc" value="<?php echo e($donhang->dukienxc); ?>" readonly="">
									    </div>
									</div>
								</div>
								<div class="field">
									<label>Trình độ</label>
									<input type="text" name="trinhdo" value="<?php echo e($donhang->trinhdo); ?>" readonly="">
								</div>
								<div class="field">
									<label>Nơi thi</label>
									<input type="text" name="noithi" value="<?php echo e($donhang->noithi); ?>" readonly="" >
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Ngày tuyển bắt đầu (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="ngaytuyenbd" value="<?php echo e($donhang->ngaytuyenbd); ?>" readonly="">
									    </div>
									</div>
								</div>
								<div class="field">
									<label>Ngày tuyển kết thúc (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="ngaytuyenkt" value="<?php echo e($donhang->ngaytuyenkt); ?>" readonly="">
									    </div>
									</div>
								</div>
							</div>
							<div class="field">
								<label>Yêu cầu khác</label>
								<textarea rows="5" name="yeucau" readonly=""><?php echo e($donhang->yeucau); ?></textarea>
							</div>

							<div class="inline field">
							<label>(*) Trường bắt buộc phải nhập</label>
							</div>		
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>

<div id="listorder" style="display: none;">
	<style type="text/css">
		.body {
			-webkit-print-color-adjust:exact;
		}
		table {
		    margin: auto;
			background-color: white;
		}
		tr {
			height: 20px;
		}
		tr td {
			font-family: "Times New Roman", Times, serif;
			text-align:center;
			font-size:12px;
			border-left:1px solid;
			border-top: none;
			border-bottom: 1px solid;
			border-right: none;
			border-color:#000000;
		}
		h2 {
		    padding: 0px;
		    margin: 15px;
		    font-size: 30px;
		}

		p{margin: 2px;}
	</style>
	<div class="body">
		<table width="1125" border="1" cellspacing="0" style="border: 1px solid black; border-top: 2px solid black; border-right: 2px solid black">
		  <tr>
		    <td colspan="20">
		      <span style="float: left;"><img src="<?php echo e(url('images/admin/logo.png')); ?>" width="100" ></span>
		        <h2>実習生の面接リスト</h2>
		    </td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">会社名</td>
		    <td colspan="7"><?php echo e($doitac->tencongty); ?></td>
		    <td colspan="4" style="font-weight: bold;">協同組合名</td>
		    <td colspan="8"><?php echo e($nghiepdoan->tennghiepdoan); ?></td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">会社住所</td>
		    <td colspan="7"><?php echo e($doitac->diachi); ?></td>
		    <td colspan="4" style="font-weight: bold;">組合の住所</td>
		    <td colspan="8"><?php echo e($nghiepdoan->diachi); ?></td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">代表者</td>
		    <td colspan="7"><?php echo e($doitac->nguoidaidien); ?></td>
		    <td colspan="4" style="font-weight: bold;">代表者</td>
		    <td colspan="8"><?php echo e($nghiepdoan->nguoidaidien); ?></td>
		  </tr>
		  <tr>
			<td colspan="3" style="font-weight: bold;">面接日</td>
		    <td colspan="7"><?php if($donhang->ngaypv): ?><?php echo e(date_format(date_create(stringtodate($donhang->ngaypv)),"Y年m月d日")); ?> <?php endif; ?> </td>
		    <td colspan="4" style="font-weight: bold;">入国予定日</td>
			<td colspan="8"><?php if($donhang->dukienxc): ?> <?php echo e(date_format(date_create(stringtodate($donhang->dukienxc)),"Y年m月d日")); ?> <?php endif; ?></td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">職種名</td>
		    <td colspan="7"><?php echo e($nganhnghe->nganhnghe_jp); ?></td>
		    <td colspan="4" style="font-weight: bold;">作業名</td>
		    <td colspan="8"><?php echo e($donhang->tieudethemjp); ?></td>
		  </tr>

		  <tr>
		    <td colspan="20" style="font-weight: bold;">
		    <p>学歴</p>
		    <p>Ｓ：中学校卒業　Ｈ：高等学校卒業　Ｖ：専門学校・職業訓練学校卒業　 Ｕ：大学卒業</p>
		    </td>
		  </tr>
		  <tr>
		    <td width="40" style="font-weight: bold;">番号</td>
		    <td width="200" style="font-weight: bold;">氏名</td>
		    <td width="35" style="font-weight: bold;">写真</td>
		    <td width="30" style="font-weight: bold;">年齢</td>
		    <td width="100" style="font-weight: bold;">生年月日</td>
		    <td width="80" style="font-weight: bold;">出身地</td>
		    <td width="50" style="font-weight: bold;">身長</td>
		    <td width="50" style="font-weight: bold;">体重</td>
		    <td width="75" style="font-weight: bold;">婚姻</td>
		    <td width="71" style="font-weight: bold;">血液型</td>
		    <td width="27" style="font-weight: bold;">学歴</td>
		    <td colspan="6" style="font-weight: bold;">IQ テスト</td>
		    
		    <td width="105" style="font-weight: bold;">面接</td>
		    <td width="105" style="font-weight: bold;">その他</td>
		  </tr>
		  <tr>
		    <td>No</td>
		    <td>Full Name </td>
		    <td>Photo</td>
		    <td>Age</td>
		    <td>D.O.B</td>
		    <td>Place of birth </td>
		    <td><p>Heigh (cm)</p>    </td>
		    <td><p>Weight (kg)</p>    </td>
		    <td>Marital status </td>
		    <td>Blood Group </td>
		    <td>EDU</td>
		    <td width="27">M1 (10) </td>
		    <td width="27">M2 (10) </td>
		    <td width="27">M3 (10) </td>
		    <td width="27">M4 (10) </td>
		    <td width="27">M5 (10) </td>
		    <td width="21">IQ (50) </td>
		    
		    <td>Interview</td>
		    <td>Remark</td>
		  </tr>
		  
		  	<?php $__currentLoopData = $hoso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  	<tr>
				<?php if($hs->iq == null): ?>
					<?php
					$x = '{"m1":"0","m2":"0","m3":"0","m4":"0","m5":"0"}';
					$iq = json_decode($x);
					?>
				<?php else: ?>
					<?php
					$iq = json_decode($hs->iq);
					?>
				<?php endif; ?>		
				<?php
					$timestamp_image = strtotime($hs->created_at);
					$year_image = date("Y", $timestamp_image);
					$month_image = date("m", $timestamp_image);
				?>		        
			    <td><?php echo e($hs->stt); ?></td>
				<td><?php echo e(khongdau($hs->hoten)); ?> <br> <?php echo e($hs->hotenjp); ?></td>
			    <td style="text-align: center;"><img src="<?php echo e(url('')); ?>/hocviens/<?php echo e($year_image); ?>/<?php echo e($month_image); ?>/<?php echo e($hs->hinhanh); ?>" height="50"></td>
			    <td><?php echo e(getAge(date_format(date_create($hs->ngaysinh), "Y/m/d"))); ?></td>
			    <td><?php echo e(date_format(date_create($hs->ngaysinh),"Y年m月d日")); ?></td>
				<td><?php echo e($hs->noisinhjp); ?></td>
			    <td><?php echo e($hs->chieucao); ?></td>
			    <td><?php echo e($hs->cannang); ?></td>
			    <td><?php echo e($hs->honnhanjp); ?></td>
			    <td><?php echo e($hs->nhommau); ?></td>
			    <td></td>
			    <td><?php echo e($iq->m1); ?></td>
			    <td><?php echo e($iq->m2); ?></td>
			    <td><?php echo e($iq->m3); ?></td>
			    <td><?php echo e($iq->m4); ?></td>
			    <td><?php echo e($iq->m5); ?></td>
			    <td><?php echo e($iq->m1 + $iq->m2 + $iq->m3 + $iq->m4 + $iq->m5); ?></td>
			    
			    <td></td>
			    <td></td>
		    </tr>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  
		</table>
	</div>
</div>


<div id="resultorder" style="display: none;">
	<style type="text/css">
		.body {
			-webkit-print-color-adjust:exact;
		}
		table {
		    margin: auto;
			background-color: white;
		}
		tr {
			height: 20px;
		}
		tr td {
			font-family: "Times New Roman", Times, serif;
			text-align:center;
			font-size:12px;
			border-left:1px solid;
			border-top: none;
			border-bottom: 1px solid;
			border-right: none;
			border-color:#000000;
		}
		h2 {
		    padding: 0px;
		    margin: 15px;
		    font-size: 30px;
		}

		p{margin: 2px;}
	</style>
	<div class="body">
		<table width="1125" cellspacing="0" style="border: 1px solid black; border-top: 2px solid black; border-right: 2px solid black">
		  <tr>
		    <td colspan="7">
		      <span style="float: left;"><img src="<?php echo e(url('images/admin/logo.png')); ?>" width="100" ></span>
		        <h2>面接結果</h2>
		    </td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;" width="100">会社名</td>
		    <td colspan="3" style="font-weight: bold;" width="450"><?php echo e($doitac->tencongty); ?></td>
		    <td colspan="1" style="font-weight: bold; ">協同組合名</td>
		    <td colspan="2" style="font-weight: bold;" width="450" ><?php echo e($nghiepdoan->tennghiepdoan); ?></td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">会社住所</td>
		    <td colspan="3"><?php echo e($doitac->diachi); ?></td>
		    <td colspan="1" style="font-weight: bold;">組合の住所</td>
		    <td colspan="2"><?php echo e($nghiepdoan->diachi); ?></td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">代表者</td>
		    <td colspan="3"><?php echo e($doitac->nguoidaidien); ?></td>
		    <td colspan="1" style="font-weight: bold;">代表者</td>
		    <td colspan="2"><?php echo e($nghiepdoan->nguoidaidien); ?></td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">面接日</td>
		    <td colspan="3"><?php if($donhang->ngaypv): ?> <?php echo e(date_format(date_create(stringtodate($donhang->ngaypv)),"Y年m月d日")); ?> <?php endif; ?> </td>
		    <td colspan="1" style="font-weight: bold;">入国予定日</td>
		    <td colspan="2"><?php if($donhang->dukienxc): ?> <?php echo e(date_format(date_create(stringtodate($donhang->dukienxc)),"Y年m月d日")); ?> <?php endif; ?></td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">職種名</td>
		    <td colspan="3"><?php echo e($nganhnghe->nganhnghe_jp); ?></td>
		    <td colspan="1" style="font-weight: bold;">作業名</td>
		    <td colspan="2"><?php echo e($donhang->tieudethemjp); ?></td>
		  </tr>

		  <tr>
		    <td  style="font-weight: bold;">番号</td>
		    <td  style="font-weight: bold;">氏名</td>
		    <td style="font-weight: bold;">年齢</td>
		    <td  style="font-weight: bold;">生年月日</td>
		    <td  style="font-weight: bold; width:200px">出身地</td>
		    <td style="font-weight: bold;">サイン</td>
		    <td  style="font-weight: bold;">その他</td>
		  </tr>
		  <tr>
		    <td>No</td>
		    <td>Full Name </td>
		    <td>Age</td>
		    <td>D.O.B</td>
		    <td>Place of birth </td>
		    <td>SIGN</td>
		    <td>Remark</td>
		  </tr>
		  
		  	<?php $__currentLoopData = $hoso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  	<tr>			        
				<td><?php echo e($hs->stt); ?></td>
				<td><?php echo e(khongdau($hs->hoten)); ?> <br> <?php echo e($hs->hotenjp); ?></td>
				<td><?php echo e(getAge(date_format(date_create($hs->ngaysinh), "Y/m/d"))); ?></td>
				<td><?php echo e(date_format(date_create($hs->ngaysinh),"Y年m月d日")); ?></td>
				<td><?php echo e($hs->noisinhjp); ?></td>
				<td></td>
				<td></td>
		    </tr>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td colspan="7" style="text-align: left; padding: 5px; font-weight: bold">
					<div style="font-size: 16px;"><span > &#9711; : </span> 合格 </div> <br>
					<div style="font-size: 16px;"><span style="font-size: 20px;"> &#9651; : </span> 補欠 </div>
				</td>
			</tr>
			<tr>
				<td colspan="7" style="text-align: left; padding: 5px; font-size: 20px; font-weight: bold">
					署名：	
				</td>
			</tr>
		</table>
	</div>
</div>


<div id="coverorder" style="display: none">
		<style type="text/css">
		  .body1 {
			-webkit-print-color-adjust:exact;
		  }
		  .body1 table{
			  margin: auto;
				background-color: white;
				 border:1px solid black;
				 font-weight: bold;
		  }
		  .body1 tr td {
			  font-weight: bold;
			  padding: 5px;
			  font-size: 16px;
		  }
		 
			</style>
		<div class="body1">
  <!-- 794 -->
		<table class="in" width="794" cellspacing="0"  >
			<tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 25px;">MIRAI HUMAN送り出し機関</td>
		  </tr>
		  <tr>
			  <td colspan="11"></td>
		  </tr>
		  <tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 25px;">ベトナム人候補者名簿</td>
		  </tr>
		  <tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 25px;">DANH SÁCH ỨNG  CỬ VIÊN DỰ TUYỂN</td>
		  </tr>
		  <tr>
			  <td colspan="11"></td>
		  </tr>
		  <tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 20px;">選定日（Ngày tuyển):  <?php if($donhang->ngaytuyenbd): ?><?php echo e(date_format(date_create(stringtodate($donhang->ngaytuyenbd)),"Y年m月d日")); ?> <?php endif; ?></td>
		  </tr>
		  <tr>
			  <td colspan="11"></td>
		  </tr>
		  <tr>
			  <td colspan="2">受入企業名</td>
			  <td colspan="1"></td>
			  <td colspan="1">:</td>
			  <td rowspan="2" colspan="3"><?php echo e($doitac->tencongty); ?></td>
			  <td colspan="2">候補者人数  </td>
			  <td colspan="1">: </td>
		  <td colspan="1"><?php echo e($donhang->soluongungvienjp); ?></td>
		  </tr>
		  <tr>
			  <td colspan="3">Xí nghiệp tiếp nhận</td>
			  <td colspan="1">:</td>
			  <td colspan="2">Tổng số ứng viên</td>
			  <td colspan="1">:</td>
			  <td colspan="1"><?php echo e($donhang->soluongungvien); ?></td>
		  </tr>
		  <tr>
			  <td colspan="3">職種（仕事の内容）</td>
			  <td colspan="1">:</td>
		  	  <td colspan="3"><?php echo e($donhang->tieudethemjp); ?></td>
			  <td colspan="2">合格人数　</td>
			  <td colspan="1">:</td>
		  	  <td colspan="1"><?php echo e($donhang->soluongtuyenjp); ?></td>
			  
		  </tr>
		  <tr>
			  <td colspan="3">Nội dung công việc</td>
			  <td colspan="1">:</td>
			  <td colspan="3"><?php echo e($donhang->tieudethem); ?></td>
			  <td colspan="2">Trúng tuyển</td>
			  <td colspan="1">:</td>
			  <td colspan="1"><?php echo e($donhang->soluongtuyen); ?> </td>
		  </tr>
		  <tr>
			  <td colspan="3">選考コード </td>
			  <td colspan="1">:</td>
		  	  <td colspan="3">
					<?php if($donhang->tendonhang == 'THỰC TẬP SINH'): ?> 
						実習生
					<?php elseif($donhang->tendonhang == 'KỸ SƯ'): ?>
						工程师
					<?php elseif($donhang->tendonhang == 'ĐIỀU DƯỠNG'): ?>
						看護
					<?php endif; ?>
				</td>
			  
			  <td colspan="2">履歴書担当者</td>
			  <td colspan="1">:</td>
			  <td colspan="1"><?php echo e($donhang->nguoiqldhjp); ?></td>
		  </tr>
		  <tr>
			  <td colspan="3">Kỳ thi tuyển </td>
			  <td colspan="1">:</td>
			  <td colspan="3"><?php echo e($donhang->tendonhang); ?></td>
			  <td colspan="2">Phụ trách lý lịch</td>
			  <td colspan="1">:</td>
		  	  <td colspan="1"><?php echo e($donhang->nguoiqldh); ?></td>
		  </tr>
		</table>
		</body>
	  </div>
<script>
//////////////////////////
var list = [];
  $("body").on('click','tr .printcheck',function(e){
    var id = $(this).attr('print');
    
    
    var includeId = list.includes(id);
    if (includeId == false) {
      list.push(id);
    }
    else{
      var i = list.indexOf(id);
      if (i != -1) {
        list.splice(i,1);
      }
    }
    console.log(list);
    var liststring = list.toString();
    var listlink = liststring.replace(/,/g, '-');
    $("#print").attr("href", "/hoso/print/"+listlink);	
  });
</script>
<script type="text/javascript">
function In_Content(strid){   
    var prtContent = document.getElementById(strid);
    var WinPrint = window.open('','','letf=0,top=0,width=800,height=auto');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
  <script src="<?php echo e(url('js/admin/donhang/show_donhang.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>