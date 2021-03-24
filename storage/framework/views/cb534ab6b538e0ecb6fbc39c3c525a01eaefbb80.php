<?php $__env->startSection('title', 'In Hồ Sơ'); ?>
<?php $__env->startSection('PageContent'); ?>

<body style="background:#fff !important;">
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
        if ($n >= $bits[$i]) {
            ++$age;
            break;
        }
    }
    return $age;
}
function convert_hoten($str) {
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
	  //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
	  return $str;
	}

	$timestamp_image = strtotime($hoso->created_at);
	$year_image = date("Y", $timestamp_image);
	$month_image = date("m", $timestamp_image);
?>
			<div class="right actions">
		      <a href="javascript:void(0)" onclick="In_Content('intiengviet')">
		        <div class="ui blue icon button">
		         <i class="print icon"></i> IN TIẾNG VIỆT
		        </div>
		      </a>
		      <?php if($hosojp): ?>
		      <a href="javascript:void(0)" onclick="In_Content('intiengnhat')">
		        <div class="ui red icon button">
		         <i class="print icon"></i> IN TIẾNG NHẬT
		        </div>
		      </a>
			  <?php endif; ?>
			  <input class="ui green icon button" type="button" onclick="tableToExcel('testTable', '<?php echo e($hoso->hoten); ?>', '<?php echo e($hoso->hoten); ?>.xls')" value="Export to Excel">
		    </div>
	<div class="ui top attached tabular menu">
	    <a class="item <?php if(!Auth::user()->can('diemdanh-create')): ?> active <?php endif; ?>" data-tab="tiengviet">Tiếng Việt</a>
	    <?php if($hosojp): ?>
	   		 <a class="item" data-tab="tiengnhat">Tiếng Nhật</a>	
		<?php endif; ?>
		<a class="item <?php if(Auth::user()->can('diemdanh-create')): ?> active <?php endif; ?> " data-tab="daotao">Hồ sơ học viên</a>	  
	</div>

	<div class="ui bottom attached tab segment <?php if(!Auth::user()->can('diemdanh-create')): ?> active <?php endif; ?>" data-tab="tiengviet">
		<div id="intiengviet">	
			<style type="text/css">
				body {
					background: #555;
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
					border-left:1px dotted;
					border-top: 1px dotted;
					border-bottom: none;
					border-right: none;
					border-color:#000000;
				}
				.logo-form .span-logo {
					float: left;
				}
				.logo-form {
					padding: 15px;
					min-height:22px;
				}
				.logo-form h2 {
					font-size: 30px;
					font-style: italic;
					font-weight: bold;
					margin: 0px; 
					padding: 0px;
				}
				p {    margin: 2px;}
			</style>
			<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
					<tr class="logo-form">
						<td colspan="26" style="  border: none;border-bottom: 1px solid" >
							<span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
							<h2>MIRAI HUMAN</h2>
						</td>
						<td colspan="5" width="370" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
						<?php if(($hoso->hinhanh != NULL) && (strlen($hoso->hinhanh) < 100)): ?>
								<img src="<?php echo e(url('')); ?>/hocviens/<?php echo e($year_image); ?>/<?php echo e($month_image); ?>/<?php echo e($hoso->hinhanh); ?>" width="100%">
							<?php else: ?>
								<img src="<?php echo e($hoso->hinhanh); ?>" width="100%">
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">SƠ YẾU LÝ LỊCH</td>
					</tr>
					<tr>
						<td colspan="4" rowspan="2" style="border-left: none;">HỌ TÊN</td>
						<td colspan="14" rowspan="2" style="font-size:22px;font-weight:bold;text-transform: uppercase;"><?php echo e($hoso->hoten); ?></td>
						<td colspan="3">ĐIỆN THOẠI</td>
						<td colspan="5"><?php echo e($hoso->dienthoai); ?></td>
					</tr>
					<tr>
						<td colspan="3">ĐT NGƯỜI THÂN</td>
						<td colspan="5"><?php echo e($hoso->dtnguoithan); ?></td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">NGÀY SINH</td>
						<td colspan="10"> <?php echo e(date_format(date_create($hoso->ngaysinh), "d/m/Y")); ?></td>
						<td colspan="2">TUỔI</td>
						<td colspan="2"><?php echo e(getAge(date_format(date_create($hoso->ngaysinh), "Y/m/d"))); ?></td>
						<td colspan="2" rowspan="2">TAY THUẬN </td>
						<td colspan="2">CÔNG VIỆC</td>
						<td style="min-width: 50px"><?php if($hoso->congviec == 0): ?> P <?php else: ?> T <?php endif; ?></td>
						<td colspan="2" style="min-width: 50px">ĐŨA</td>
						<td style="min-width: 50px"><?php if($hoso->dua == 0): ?> P <?php else: ?> T <?php endif; ?></td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">GIỚI TÍNH</td>
						<td colspan="10"><?php if($hoso->gioitinh == 0): ?> NỮ <?php else: ?> NAM <?php endif; ?></td>
						<td colspan="2" rowspan="3">TÔN GIÁO</td>
						<td colspan="2" rowspan="3"><?php echo e($hoso->tongiao); ?></td>
						<td colspan="2" style="min-width: 50px">KÉO</td>
						<td style="min-width: 50px"><?php if($hoso->keo == 0): ?> P <?php else: ?> T <?php endif; ?></td>
						<td colspan="2">VIẾT</td>
						<td style="min-width: 50px"><?php if($hoso->viet == 0): ?> P <?php else: ?> T <?php endif; ?></td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">HÔN NHÂN</td>
						<td colspan="10"><?php echo e($hoso->honnhan); ?></td>
						<td colspan="4">CHIỀU CAO (cm)</td>
						<td colspan="3"><?php echo e($hoso->chieucao); ?></td>
						<td colspan="3">CÂN NẶNG (kg)</td>
						<td colspan="3"><?php echo e($hoso->cannang); ?></td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">BỆNH ÁN</td>
						<td colspan="10"><?php echo e($hoso->benhan); ?></td>
						<td colspan="4">NHÓM MÁU</td>
						<td colspan="9"><?php echo e($hoso->nhommau); ?></td>
					</tr>
					<tr >
						<td colspan="4" style="border-bottom: 1px solid; border-left: none;">NƠI SINH</td>
						<td colspan="10" style="border-bottom: 1px solid"><?php echo e($hoso->noisinh); ?></td>
						<td colspan="2" style="border-bottom: 1px solid">MIỀN</td>
						<td colspan="2" style="border-bottom: 1px solid"><?php echo e($hoso->mien); ?></td>
						<td colspan="2" style="border-bottom: 1px solid">THỊ LỰC</td>
						<td colspan="3" style="border-bottom: 1px solid">TRÁI</td>
						<td colspan="3" style="border-bottom: 1px solid"><?php echo e($hoso->mattrai); ?></td>
						<td colspan="3" style="border-bottom: 1px solid">PHẢI</td>
						<td colspan="2" style="border-bottom: 1px solid"><?php echo e($hoso->matphai); ?></td>
					</tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
					<tr>
					    <td colspan="6" style="border-bottom: 1px solid; border-top: 1px solid; border-left: none;">ĐỊA CHỈ HỘ KHẨU</td>
					    <td colspan="20" style="border-bottom: 1px solid; border-top: 1px solid;text-transform: uppercase;">
					    	
					    	<?php if($hoso->diachi): ?>
								<?php echo e($hoso->diachi); ?>

							<?php else: ?>
								<?php echo e($hoso->dchk_dc.",".$hoso->dchk_xa.",".$hoso->dchk_huyen); ?>

							<?php endif; ?>
					    </td>
					    <td colspan="3" style="border-bottom: 1px solid; border-top: 1px solid">TĨNH/TP</td>
					    <td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid;text-transform: uppercase;">
					    		<?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						      		<?php if($ct->id == $hoso->tinhthanh): ?>
						      		<?php echo e($ct->ten); ?>

						      		<?php endif; ?>
						      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					  </tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
				    <tr>
				        <td colspan="4" rowspan="<?php echo e(count($hoctap) + 1); ?>" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left: none;">QUÁ TRÌNH HỌC TẬP</td>
				        <td colspan="11" style="border-top: 1px solid;">THỜI GIAN HỌC</td>
				        <td colspan="11" style="border-top: 1px solid;">TÊN TRƯỜNG</td>
				        <td colspan="5" style="border-top: 1px solid;">ĐỊA CHỈ TRƯỜNG</td>
				    </tr>
					<?php $__currentLoopData = $hoctap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ht): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td colspan="5"><?php echo e($ht->thoigianbd); ?></td>
							<td style="border-left: none;">~</td>
							<td colspan="5" style="border-left: none;"><?php echo e($ht->thoigiankt); ?></td>
							<td colspan="11"><?php echo e($ht->tentruong); ?></td>
							<td colspan="5" ><?php echo e($ht->diachi); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none;border-top: 1px solid; border-left: none;"></td>
					</tr>
					<tr>
					    <td colspan="4" rowspan="3" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">QUÁ TRÌNH LÀM VIỆC</td>
					    <td colspan="11" style="border-top: 1px solid;">THỜI GIAN LÀM VIỆC</td>
					    <td colspan="11" style="border-top: 1px solid;">TÊN CÔNG TY</td>
					    <td colspan="5" style="border-top: 1px solid;">NỘI DUNG CÔNG VIỆC</td>
				  	</tr>
				  	<?php 
						$subtractlv =( 2 - count($lamviec)); 
						$pluslv = 0;
					?>
					<?php if($subtractlv <= 0): ?>
						<?php $__currentLoopData = $lamviec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($pluslv <= 1 ): ?>
						<tr>
							<td colspan="5">
								<?php echo e(substr($lv->thoigianbd,0,2)."/"); ?><?php echo e(substr($lv->thoigianbd,3)); ?> 
							</td>
							<td style="border-left: none;">~</td>
							<td colspan="5" style="border-left: none;">
								<?php echo e(substr($lv->thoigiankt,0,2)."/"); ?><?php echo e(substr($lv->thoigiankt,3)); ?>

							</td>
							<td colspan="11"><?php echo e($lv->tencongty); ?></td>
							<td colspan="5"><?php echo e($lv->congviec); ?></td>
						</tr>
						<?php endif; ?>
						<?php $pluslv++; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
					<?php else: ?>
						<?php $__currentLoopData = $lamviec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td colspan="5">
									<?php echo e(substr($lv->thoigianbd,0,2)."/"); ?><?php echo e(substr($lv->thoigianbd,3)); ?> 
								</td>
								<td style="border-left: none;">~</td>
								<td colspan="5" style="border-left: none;">
									<?php echo e(substr($lv->thoigiankt,0,2)."/"); ?><?php echo e(substr($lv->thoigiankt,3)); ?>

								</td>
								<td colspan="11"><?php echo e($lv->tencongty); ?></td>
								<td colspan="5"><?php echo e($lv->congviec); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
						<?php for($lvi = 0; $lvi < $subtractlv; $lvi++): ?>
						<tr>
							<td colspan="5"></td>
							<td style="border-left: none;"></td>
							<td colspan="5" style="border-left: none;"></td>
							<td colspan="11"></td>
							<td colspan="5"></td>
						</tr>
						<?php endfor; ?>
					<?php endif; ?>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none;border-top: 1px solid; border-left: none;"></td>
					</tr>
					<tr>
					    <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">NGOẠI NGỮ</td>
				    	<td colspan="3" style="border-top: 1px solid;">ANH NGỮ</td>
				    	<td colspan="11" style="border-top: 1px solid;">
							<?php if($hoso->anhngu == 0): ?>
								KHÔNG
							<?php elseif($hoso->anhngu == 1): ?>
								Bằng A
							<?php elseif($hoso->anhngu == 2): ?>
								Bằng B
							<?php elseif($hoso->anhngu == 3): ?>	
								Bằng C				    
							<?php endif; ?>
				    	</td>
				    	<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">ĐÃ TỪNG TỚI NHẬT</td>
						<td colspan="6" style="border-top: 1px solid;"><?php if($hoso->datungtoinhat == 1): ?> CÓ <?php else: ?> KHÔNG <?php endif; ?></td>
				  	</tr>
					<tr>
						<td colspan="3" rowspan="2">NHẬT NGỮ</td>
						<td colspan="11" rowspan="2">
							<?php if($hoso->nhatngu == 0): ?>
								KHÔNG
							<?php elseif($hoso->nhatngu == 1): ?>
								BẰNG N1
							<?php elseif($hoso->nhatngu == 2): ?>
								BẰNG N2
							<?php elseif($hoso->nhatngu == 3): ?>	
								BẰNG N3
							<?php elseif($hoso->nhatngu == 4): ?>
								BẰNG N4
							<?php elseif($hoso->nhatngu == 5): ?>	
								BẰNG N5	
							<?php endif; ?>
						</td>
						<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">CÓ NGƯỜI THÂN TẠI NHẬT</td>
						<td colspan="6"><?php if($hoso->conguoithantainhat == 1): ?> CÓ <?php else: ?> KHÔNG <?php endif; ?> </td>
					</tr>
					<?php 
						$subtractnt =( 2 - count($nguoithan)); 
						$plusnt1 = 0;
						$plusnt2 = 0;
					?>
					
					<?php if($subtractnt > 1 ): ?>					
						<tr>
							<td>TÊN:</td>
							<td colspan="5">&nbsp;</td>
							<td>TUỔI:</td>
							<td colspan="2">&nbsp;</td>
							<td colspan="2">QUAN HỆ: </td>
							<td colspan="2">&nbsp;</td>
						</tr>
					<?php else: ?> 
						<?php $__currentLoopData = $nguoithan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($plusnt1 == 0): ?>
								<tr>
									<td>TÊN:</td>
									<td colspan="5"><?php echo e($nt->hoten); ?></td>
									<td>TUỔI:</td>
									<td colspan="2"><?php echo e($nt->tuoi); ?></td>
									<td colspan="2">QUAN HỆ: </td>
									<td colspan="2"><?php echo e($nt->quanhe); ?></td>
								</tr>
							<?php endif; ?>
							<?php $plusnt1++; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				  <tr>
				    <td colspan="3" style="border-bottom: 1px solid;">KHÁC</td>
					<td colspan="11" style="border-bottom: 1px solid;"><?php echo e($hoso->ngoaingukhac); ?></td>
					<?php if($subtractnt <= 0 ): ?>
						<?php $__currentLoopData = $nguoithan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($plusnt2 == 1): ?>
							<td style="border-bottom: 1px solid;">TÊN:</td>
				  			<td colspan="5" style="border-bottom: 1px solid;"><?php echo e($nt->hoten); ?></td>
							<td style="border-bottom: 1px solid;">TUỔI:</td>
				  			<td colspan="2" style="border-bottom: 1px solid;"><?php echo e($nt->tuoi); ?></td>
							<td colspan="2" style="border-bottom: 1px solid;">QUAN HỆ:</td>
				  			<td colspan="2" style="border-bottom: 1px solid;"><?php echo e($nt->quanhe); ?></td>
						<?php endif; ?>
						<?php $plusnt2++; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<td style="border-bottom: 1px solid;">TÊN:</td>
						<td colspan="5" style="border-bottom: 1px solid;"></td>
						<td style="border-bottom: 1px solid;">TUỔI:</td>
						<td colspan="2" style="border-bottom: 1px solid;"></td>
						<td colspan="2" style="border-bottom: 1px solid;">QUAN HỆ:</td>
						<td colspan="2" style="border-bottom: 1px solid;"></td>
					<?php endif; ?>
				   
				  </tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
				  <tr>
				    <td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">THỰC TẬP KỸ NĂNG Ở NHẬT</td>
				  </tr>
				  <tr>
				    <td colspan="10" style="border-left: none;">MỤC ĐÍCH ĐI NHẬT</td>
				    <td colspan="21"><?php echo e($hoso->mucdich); ?></td>
				  </tr>
				  <tr>
				    <td colspan="10" style="border-left: none;">SỐ TIỀN DỰ ĐỊNH TIẾT KIỆM MỖI THÁNG TẠI NHẬT</td>
				    <td colspan="6"><?php echo e($hoso->sotientrenthang); ?> VND</td>
				    <td colspan="9">SỔ TIỀN DỰ ĐỊNH TIẾT KIỆM SAU 3 NĂM TẠI NHẬT</td>
				    <td colspan="6"><?php echo e($hoso->sotientrennam); ?> VND</td>
				  </tr>
				  <tr>
				    <td colspan="10" style="border-bottom: 1px solid; border-left: none;">MỤC TIÊU SAU KHI VỀ NƯỚC</td>
				    <td colspan="21" style="border-bottom: 1px solid"><?php echo e($hoso->muctieu); ?></td>
				  </tr>
				  
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none;border-left: none;"></td>
					</tr>
					  <tr>
				    <td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;border-left: none;">KHÁC</td>
				  </tr>
				  <tr>
				    <td colspan="4" style="border-left: none;">BẰNG LÁI</td>
				    <td colspan="6"><?php if($hoso->banglai == 1): ?> CÓ <?php else: ?> KHÔNG <?php endif; ?></td>
				    <td colspan="2"> LOẠI XE </td>
				    <td colspan="19" style="text-align: left;">

				        &nbsp; <?php if($hoso->xemay == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?>  XE MÁY 
				        &nbsp; <?php if($hoso->oto == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> Ô TÔ
				        &nbsp; <?php if($hoso->xekhac != ''): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> KHÁC (&ensp;&ensp;<?php echo e($hoso->xekhac); ?>&ensp;&ensp;)
				    </td>
				  </tr>
				  <tr>
				    <td colspan="4" style="border-bottom: 1px solid; border-left: none;">SỞ THÍCH</td>
				    <td colspan="12" style="border-bottom: 1px solid"><?php echo e($hoso->sothich); ?></td>
				    <td colspan="4" style="border-bottom: 1px solid">ĐIỂM MẠNH</td>
				    <td colspan="11" style="border-bottom: 1px solid"><?php echo e($hoso->diemmanh); ?></td>
					  </tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
					<tr>
						<td colspan="2" rowspan="8" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">GIA ĐÌNH</td>
						<td colspan="9" style="border-top: 1px solid; width: 300px">QUAN HỆ (Cha, Mẹ, Tất cả anh chị em ruột)</td>
						<td colspan="2" style="border-top: 1px solid">NĂM SINH</td>
						<td colspan="6" style="border-top: 1px solid">CÔNG VIỆC</td>
						<td colspan="6" style="border-top: 1px solid">NƠI LÀM VIỆC</td>
						<td colspan="6" style="border-top: 1px solid">THU NHẬP HÀNG THÁNG</td>
					</tr>
					<?php 
						$subtractgd =( 7 - count($giadinh)); 
						$plusgd = 0;
					?>

					<?php if($subtractgd <= 0): ?>
						<?php $__currentLoopData = $giadinh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($plusgd <= 6 ): ?>
						<tr>
							<td colspan="3"><?php echo e($gd->quanhe); ?></td>
							<td colspan="6"><?php echo e($gd->hoten); ?></td>
							<td colspan="2"><?php echo e($gd->namsinh); ?></td>
							<td colspan="6"><?php echo e($gd->congviec); ?></td>
							<td colspan="6"><?php echo e($gd->noilamviec); ?></td>  
							<td colspan="6"><?php echo e($gd->luong); ?> VND</td>
						</tr>
						<?php endif; ?>
						<?php $plusgd++; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
					<?php else: ?>
						<?php $__currentLoopData = $giadinh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td colspan="3"><?php echo e($gd->quanhe); ?></td>
							<td colspan="6"><?php echo e($gd->hoten); ?></td>
							<td colspan="2"><?php echo e($gd->namsinh); ?></td>
							<td colspan="6"><?php echo e($gd->congviec); ?></td>
							<td colspan="6"><?php echo e($gd->noilamviec); ?></td>  
							<td colspan="6"><?php echo e($gd->luong); ?> VND</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
						<?php for($gdi = 0; $gdi < $subtractgd; $gdi++): ?>
						<tr>
							<td colspan="3"></td>
							<td colspan="6"></td>
							<td colspan="2"></td>
							<td colspan="6"></td>
							<td colspan="6"></td>  
							<td colspan="6"></td>
						</tr>
						<?php endfor; ?>
					<?php endif; ?>
			</table>
			<table width="794" cellspacing="0" border="0" >
			    <tr style="height:44px;">
			        <td colspan="15" style="text-align: left; padding-left: 15px; border: none;">
			            <span>Đăng ký ngày: <?php echo e(date_format(date_create($hoso->ngaydangky), "d/m/Y")); ?></span>
			        </td>
			        <td colspan="16" style="text-align: left; padding-left: 15px; border: none;">
			           <span>Người phụ trách: <?php echo e($hoso->nguoiphutrach); ?></span>
			           <span style="float: right;">Người giới thiệu: <?php echo e($hoso->nguoigioithieu); ?> &nbsp;&nbsp;</span> 
			        </td>
			    </tr>
			</table>
		</div>
	</div>


<?php if($hosojp): ?>
	<div class="ui bottom attached tab segment" data-tab="tiengnhat">
		<div id="intiengnhat">
		<style type="text/css">
			body {
				background: #555;
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
				border-left:1px dotted;
				border-top: 1px dotted;
				border-bottom: none;
				border-right: none;
				border-color:#000000;
			}
			.logo-form .span-logo {
				float: left;
			}
			.logo-form {
				padding: 15px;
				min-height:22px;
			}
			.logo-form h2 {
				font-size: 30px;
				font-style: italic;
				font-weight: bold;
				margin: 0px; 
				padding: 0px;
			}
			p {    margin: 2px;}
		</style>
		<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
		<tr class="logo-form">
			<td colspan="26" style="  border: none;border-bottom: 1px solid" >
				<span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
				<h2>MIRAI HUMAN</h2>
			</td>
			<td colspan="5" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
				<p style="text-align: left; font-weight: bold;"> 番号：<?php echo e($hoso->stt); ?></p>
				<?php if(($hoso->hinhanh != NULL) && (strlen($hoso->hinhanh) < 100)): ?>
					<img src="<?php echo e(url('')); ?>/hocviens/<?php echo e($year_image); ?>/<?php echo e($month_image); ?>/<?php echo e($hoso->hinhanh); ?>" width="100%">
				<?php else: ?>
					<img src="<?php echo e($hoso->hinhanh); ?>" width="100%">
				<?php endif; ?>
			</td>
		</tr>
		
		<tr>
			<td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">技能実習生履歴書</td>
		</tr>
	  
		<tr>
			<td colspan="4" rowspan="2" style="border-left: none; width: 100px; ">氏名</td>
			<td colspan="3">英字表記</td>
			<td colspan="19" style="font-size:20px;font-weight:bold; text-transform: uppercase;"><?php echo e(convert_hoten($hoso->hoten)); ?></td>
		</tr>
		<tr>
			<td colspan="3">フリガナ</td>
			<td colspan="19" style="font-size:20px;"><?php echo e($hosojp->hoten); ?></td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">生年月日</td>
			<td colspan="10"><?php echo e(date_format(date_create($hoso->ngaysinh),"Y年m月d日")); ?></td>
			<td colspan="2">年齢</td>
			<td colspan="2"><?php echo e(getAge(date_format(date_create($hoso->ngaysinh),"Y/m/d"))); ?></td>
			<td colspan="2" rowspan="2" style="width: 70px">利き手 </td>
			<td colspan="2">仕事</td>
			<td style="min-width: 50px"><?php if($hoso->congviec == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
			<td colspan="2" style="min-width: 50px">箸</td>
			<td style="min-width: 50px"><?php if($hoso->dua == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">性別</td>
			<td colspan="10"><?php if($hoso->gioitinh == 0): ?> 女 <?php else: ?> 男 <?php endif; ?></td>
			<td colspan="2" rowspan="3">宗教</td>
			<td colspan="2" rowspan="3">
			<?php echo e($hosojp->tongiao); ?></td>
			<td colspan="2" style="min-width: 50px">鋏</td>
			<td style="min-width: 50px"><?php if($hoso->keo == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
			<td colspan="2">ペン</td>
			<td style="min-width: 50px"><?php if($hoso->viet == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">婚姻</td>
			<td colspan="10"><?php echo e($hosojp->honnhan); ?></td>
			<td colspan="4">身長（センチ)</td>
			<td colspan="3"><?php echo e($hoso->chieucao); ?></td>
			<td colspan="3">体重（キロ)</td>
			<td colspan="3"><?php echo e($hoso->cannang); ?></td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">病暦</td>
			<td colspan="10"><?php echo e($hosojp->benhan); ?></td>
			<td colspan="4">血液</td>
			<td colspan="9"><?php echo e($hoso->nhommau); ?></td>
		</tr>
		<tr >
			<td colspan="4" style="border-bottom: 1px solid; border-left: none;">出身地</td>
			<td colspan="10" style="border-bottom: 1px solid"><?php echo e($hosojp->noisinh); ?></td>
			<td colspan="2" style="border-bottom: 1px solid">地方</td>
			<td colspan="2" style="border-bottom: 1px solid"><?php echo e($hosojp->mien); ?></td>
			<td colspan="2" style="border-bottom: 1px solid">視カ</td>
			<td colspan="3" style="border-bottom: 1px solid">左</td>
			<td colspan="3" style="border-bottom: 1px solid"><?php echo e($hosojp->mattrai); ?></td>
			<td colspan="3" style="border-bottom: 1px solid">右</td>
			<td colspan="2" style="border-bottom: 1px solid"><?php echo e($hosojp->matphai); ?></td>
		</tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom: 1px solid; border-top: 1px solid; border-left: none;">戸籍住所</td>
			<td colspan="20" style="border-bottom: 1px solid; border-top: 1px solid">
				<?php if($hosojp->diachi): ?>
					<?php echo e($hosojp->diachi); ?>

				<?php else: ?>
					<?php if($hosojp->dchk): ?>
						<?php $dchk = json_decode($hosojp->dchk);  echo $dchk->dchk_tinh." ".$dchk->dchk_tinh_plus." ".$dchk->dchk_huyen." ".$dchk->dchk_huyen_plus." ".$dchk->dchk_xa." ".
						$dchk->dchk_xa_plus." ".$dchk->dchk_dc." ".$dchk->dchk_dc_plus; ?>
					<?php endif; ?>
				<?php endif; ?>
			</td>				
			<td colspan="3" style="border-bottom: 1px solid; border-top: 1px solid">地方</td>
			<td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid">
				<?php echo e($hosojp->diachimien); ?>

			</td>
		</tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		<?php
			$example=array();
			foreach ($hoctap as $hta) {
				array_push($example,$hta->tentruong);
			}
			$searchword = ['TRƯỜNG TIỂU HỌC','TRƯỜNG THCS','TRƯỜNG THPT'];
			$arrhoctap = array();
			foreach ($searchword as $searchword) {
				foreach($example as $k=>$v) {
					if ($k == 0) {
						if(preg_match("/\b$searchword\b/i", $v)) {
							$arrhoctap[$k] = "小学校";
						}
					}elseif ($k == 1) {
						if(preg_match("/\b$searchword\b/i", $v)) {
							$arrhoctap[$k] = "中学校";
						}
					}elseif ($k == 2) {
						if(preg_match("/\b$searchword\b/i", $v)) {
							$arrhoctap[$k] = "高等学校";
						}
					}
				}
			}
		?>
		<?php
			$hoctap = json_decode($hosojp->hoctap);
		?>
		<?php if($hoctap->thoigianbd[0]): ?>		
	    <tr>
			<td colspan="4" rowspan="<?php echo e(count($hoctap->thoigianbd)+1); ?>" 
				style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">学 歴</td>
	        <td colspan="11" style="border-top: 1px solid;">期 間</td>
	        <td colspan="11" style="border-top: 1px solid;">学 校 名</td>
	        <td colspan="5" style="border-top: 1px solid;">学 校 所 在 地</td>
	    </tr>
		<?php for($i = 0 ; $i < count($hoctap->thoigianbd); $i++): ?>    
		  	<tr>
				<?php
					$thangbd = substr( $hoctap->thoigianbd[$i],  0, 2);
					$nambd = substr( $hoctap->thoigianbd[$i],  3, 7);
					$thangkt = substr( $hoctap->thoigiankt[$i],  0, 2);
					$namkt = substr( $hoctap->thoigiankt[$i],  3, 7);
				?>
			  	<?php if(strlen($hoctap->thoigianbd[$i]) == 4): ?>
					<td colspan="5"><?php echo e($hoctap->thoigianbd[$i]); ?>年09月</td>
					<td style="border-left: none;">~</td>
					<td colspan="5" style="border-left: none;"><?php echo e($hoctap->thoigiankt[$i]); ?>年05月</td>
				<?php elseif( strlen($hoctap->thoigianbd[$i]) == 7): ?>
					<td colspan="5"><?php echo e($nambd); ?>年<?php echo e($thangbd); ?>月</td>
					<td style="border-left: none;">~</td>
					<?php if(strlen($hoctap->thoigiankt[$i]) == 7): ?>
					  <td colspan="5" style="border-left: none;"><?php echo e($namkt); ?>年<?php echo e($thangkt); ?>月</td>
					<?php else: ?>
						<td colspan="5" style="border-left: none;"><?php echo e($hoctap->thoigiankt[$i]); ?></td>
					<?php endif; ?>
				<?php else: ?>
					<td colspan="5"></td>
					<td style="border-left: none;"></td>
					<td colspan="5" style="border-left: none;"></td>
				<?php endif; ?>
		    
				<?php if($i > 2): ?>
					<td colspan="11"><?php echo e($hoctap->tentruong[$i]); ?></td>
				<?php else: ?>
					<td colspan="11"><?php echo e($hoctap->tentruong[$i]); ?> <?php if(isset($arrhoctap[$i])): ?> <?php echo e($arrhoctap[$i]); ?> <?php endif; ?> </td>
				<?php endif; ?>
		    	<td colspan="5"><?php echo e($hoctap->diachitruong[$i]); ?><?php if(isset($hoctap->dctinh)): ?> <?php echo e($hoctap->dctinh[$i]); ?> <?php endif; ?></td>
		  	</tr>
		<?php endfor; ?> 
		<?php else: ?>
			<tr>
				<td colspan="4" rowspan="" 
				style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">学 歴</td>
				<td colspan="11" style="border-top: 1px solid;">期 間</td>
				<td colspan="11" style="border-top: 1px solid;">学 校 名</td>
				<td colspan="5" style="border-top: 1px solid;">学 校 所 在 地</td>
			</tr>
		<?php endif; ?> 
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: 1px solid; border-left: none;"></td>
		</tr>
		<?php
			$lamviec = json_decode($hosojp->lamviec); 
		?>
		<?php if($lamviec->thoigianbd[0]): ?>
			<tr>
				<td colspan="4" rowspan="3" style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">職 歴</td>
				<td colspan="11" style="border-top: 1px solid;">期 間</td>
				<td colspan="11" style="border-top: 1px solid;">勤 務 先</td>
				<td colspan="5" style="border-top: 1px solid;">職 種</td>
			</tr>
			<?php 
				$subtractlvjp =( 2 - count($lamviec->thoigianbd)); 
			?>
			<?php if($subtractlvjp <= 0): ?>
				<?php for($i = 0 ; $i < 2; $i++): ?>
				<tr>
					<td colspan="5">
						<?php echo e(substr($lamviec->thoigianbd[$i],3)."年"); ?><?php echo e(substr($lamviec->thoigianbd[$i],0,2)."月"); ?>

					</td>
					<td style="border-left: none;">~</td>
					<td colspan="5" style="border-left: none;">
						<?php echo e(substr($lamviec->thoigiankt[$i],3)."年"); ?><?php echo e(substr($lamviec->thoigiankt[$i],0,2)."月"); ?>

					</td>
					<td colspan="11"><?php echo e($lamviec->tencongty[$i]); ?></td>
					<td colspan="5"><?php echo e($lamviec->ndcongviec[$i]); ?></td>
				</tr>
				<?php endfor; ?>
			<?php else: ?>
				<?php for($i = 0 ; $i < count($lamviec->thoigianbd); $i++): ?>
				<tr>
					<td colspan="5">
						<?php echo e(substr($lamviec->thoigianbd[$i],3)."年"); ?><?php echo e(substr($lamviec->thoigianbd[$i],0,2)."月"); ?>

					</td>
					<td style="border-left: none;">~</td>
					<td colspan="5" style="border-left: none;">
						<?php echo e(substr($lamviec->thoigiankt[$i],3)."年"); ?><?php echo e(substr($lamviec->thoigiankt[$i],0,2)."月"); ?>

					</td>
					<td colspan="11"><?php echo e($lamviec->tencongty[$i]); ?></td>
					<td colspan="5"><?php echo e($lamviec->ndcongviec[$i]); ?></td>
				</tr>
				<?php endfor; ?>
				<?php for($lvijp = 0; $lvijp < $subtractlvjp; $lvijp++): ?>
				<tr>
					<td colspan="5"></td>
					<td style="border-left: none;"></td>
					<td colspan="5" style="border-left: none;"></td>
					<td colspan="11"></td>
					<td colspan="5"></td>
				</tr>
				<?php endfor; ?>
			<?php endif; ?>
		<?php else: ?>
			<tr>
				<td colspan="4" rowspan="" style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">職 歴</td>
				<td colspan="11" style="border-top: 1px solid;">期 間</td>
				<td colspan="11" style="border-top: 1px solid;">勤 務 先</td>
				<td colspan="5" style="border-top: 1px solid;">職 種</td>
			</tr>
		<?php endif; ?>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: 1px solid; border-left: none;"></td>
		</tr>
	    <tr>
			<td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">外 国 語</td>
			<td colspan="3" style="border-top: 1px solid;">英語</td>
			<td colspan="11" style="border-top: 1px solid;">
				<?php if($hoso->anhngu == 0): ?>
					無
				<?php elseif($hoso->anhngu == 1): ?>
					A
				<?php elseif($hoso->anhngu == 2): ?>
					B
				<?php elseif($hoso->anhngu == 3): ?>	
					C				    
				<?php endif; ?>
			</td>
			<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">訪 日 経 験</td>
			<td colspan="6" style="border-top: 1px solid;"> <?php if($hoso->datungtoinhat == '1'): ?> はい <?php else: ?> 無 <?php endif; ?> </td>
		</tr>
		<tr>
			<td colspan="3" rowspan="2">日本語</td>
			<td colspan="11" rowspan="2">
				<?php echo e($hosojp->nhatngu); ?>

			</td>
			<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">在日本親戚．知人</td>
			<td colspan="6"> <?php if($hoso->conguoithantainhat == '1'): ?> 有 <?php else: ?> 無 <?php endif; ?> </td>
		</tr>
		 <?php
		 	if ($hosojp->nguoithan) {
				$nguoithan = json_decode($hosojp->nguoithan);
				if ($nguoithan->hoten) {
					$subtractntjp =( 2 - count($nguoithan->hoten));					
				}else{
					$subtractntjp = 2;
				}
			}else {
				$nguoithan = json_decode('{"hoten":["",""],"tuoi":["",""],"quanhe":["",""]}');
				$subtractntjp = 0;
			}
		 ?>
		
		<?php if( $subtractntjp < 2 ): ?>
			<tr>
				<td >氏名:</td>
				<td colspan="5"><?php echo e($nguoithan->hoten[0]); ?></td>
				<td>年齢:</td>
				<td colspan="2"><?php echo e($nguoithan->tuoi[0]); ?></td>
				<td colspan="2">続柄: </td>
				<td colspan="2"><?php echo e($nguoithan->quanhe[0]); ?></td>
			</tr>
		<?php else: ?>
			<tr>
				<td style="border-top: 1px solid">氏名:</td>
				<td colspan="5">&nbsp;</td>
				<td>年齢:</td>
				<td colspan="2">&nbsp;</td>
				<td colspan="2">続柄: </td>
				<td colspan="2">&nbsp;</td>
			</tr>
		 <?php endif; ?>
	    <tr>
			<td colspan="3" style="border-bottom: 1px solid;">その他</td>
			<td colspan="11" style="border-bottom: 1px solid;">無</td>
			<?php if( $subtractntjp < 1 ): ?>
				<td style="border-bottom: 1px solid;">氏名:</td>
				<td colspan="5" style="border-bottom: 1px solid;"><?php echo e($nguoithan->hoten[1]); ?></td>
				<td style="border-bottom: 1px solid;">年齢:</td>
				<td colspan="2" style="border-bottom: 1px solid;"><?php echo e($nguoithan->tuoi[1]); ?></td>
				<td colspan="2" style="border-bottom: 1px solid;">続柄: </td>
				<td colspan="2" style="border-bottom: 1px solid;"><?php echo e($nguoithan->quanhe[1]); ?></td>	
			<?php else: ?>
				<td style="border-bottom: 1px solid;">氏名:</td>
				<td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
				<td style="border-bottom: 1px solid;">年齢:</td>
				<td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
				<td colspan="2" style="border-bottom: 1px solid;">続柄: </td>
				<td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
			<?php endif; ?>
	    </tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		<tr>
			<td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">日本での技能実習について</td>
		</tr>
		<tr>
			<td colspan="10" style="border-left: none;">日本に行く目的</td>
			<td colspan="21"><?php echo e($hosojp->mucdich); ?></td>
		</tr>
		<tr>
			<td colspan="10" style="border-left: none;">毎月の貯金</td>
			<td colspan="8"><?php echo e($hoso->sotientrenthang); ?> ドン</td>
			<td colspan="7">3年間の貯金</td>
			<td colspan="6"><?php echo e($hoso->sotientrennam); ?> ドン</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px solid; border-left: none;">帰国後の目摽</td>
			<td colspan="21" style="border-bottom: 1px solid">
				<?php echo e($hosojp->muctieu); ?>

			</td>
		</tr>
	  
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none;border-left: none;"></td>
		</tr>
		<tr>
			<td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;border-left: none;">その他</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">免許</td>
			<td colspan="6"><?php if($hoso->banglai == 1): ?> 有 <?php else: ?> 無 <?php endif; ?>  </td>
			<td colspan="2"> 種類 </td>
			<td colspan="19" style="text-align: left;">
				&nbsp; <?php if($hoso->xemay == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?>  バイク  
									&nbsp; <?php if($hoso->oto == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> 車
									&nbsp; <?php if($hoso->xekhac != ''): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> その他 (&ensp;&ensp;<?php echo e($hoso->xekhac); ?>&ensp;&ensp;)
			</td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: 1px solid; border-left: none;">趣味</td>
			<td colspan="12" style="border-bottom: 1px solid"><?php echo e($hosojp->sothich); ?></td>
			<td colspan="4" style="border-bottom: 1px solid">長所</td>
			<td colspan="11" style="border-bottom: 1px solid"><?php echo e($hosojp->diemmanh); ?></td>
		</tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		<?php
			$giadinh = json_decode($hosojp->giadinh);
		?>
		<?php if($giadinh->quanhe[0]): ?>
			<tr>
				<td colspan="2" rowspan="8" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
				<td colspan="3" style="border-top: 1px solid;">続柄</td>
				<td colspan="8" style="border-top: 1px solid;">氏名</td>		
				<td colspan="2" style="border-top: 1px solid">年生</td>
				<td colspan="7" style="border-top: 1px solid">職業</td>
				<td colspan="4" style="border-top: 1px solid">就職先</td>
				<td colspan="4" style="border-top: 1px solid">月収</td>
			</tr>
			<?php 
				$subtractgdjp =( 7 - count($giadinh->quanhe)); 
			?>
			<?php if($subtractgdjp <= 0): ?>
				<?php for($i = 0 ; $i < 7; $i++): ?>
				<tr>
					<td colspan="3"><?php echo e($giadinh->quanhe[$i]); ?></td>
					<td colspan="8"><?php echo e($giadinh->hoten[$i]); ?></td>
					<td colspan="2"><?php echo e($giadinh->namsinh[$i]); ?></td>
					<td colspan="7"><?php echo e($giadinh->congviec[$i]); ?></td>
					<td colspan="4"><?php echo e($giadinh->noilam[$i]); ?> <?php if(isset($giadinh->dctinh[$i])): ?> <?php echo e($giadinh->dctinh[$i]); ?>  <?php endif; ?></td>
					<td colspan="4"><?php echo e($giadinh->thunhap[$i]); ?> ドン</td>
				</tr>
				<?php endfor; ?>
			<?php else: ?>
				<?php for($i = 0 ; $i < count($giadinh->quanhe); $i++): ?>
				<tr>
					<td colspan="3"><?php echo e($giadinh->quanhe[$i]); ?></td>
					<td colspan="8"><?php echo e($giadinh->hoten[$i]); ?></td>
					<td colspan="2"><?php echo e($giadinh->namsinh[$i]); ?></td>
					<td colspan="7"><?php echo e($giadinh->congviec[$i]); ?></td>
					<td colspan="4"><?php echo e($giadinh->noilam[$i]); ?> <?php if(isset($giadinh->dctinh[$i])): ?> <?php echo e($giadinh->dctinh[$i]); ?>  <?php endif; ?></td>
					<td colspan="4"><?php echo e($giadinh->thunhap[$i]); ?> ドン</td>
				</tr>
				<?php endfor; ?>
				<?php for($gdijp = 0; $gdijp < $subtractgdjp; $gdijp++): ?>
				<tr>
					<td colspan="3"></td>
					<td colspan="8"></td>
					<td colspan="2"></td>
					<td colspan="7"></td>
					<td colspan="4"></td>
					<td colspan="4"></td>
				</tr>
				<?php endfor; ?>
			<?php endif; ?>
		<?php else: ?>
		<tr>
			<td colspan="2" rowspan="8" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
			<td colspan="3" style="border-top: 1px solid;">続柄</td>
			<td colspan="8" style="border-top: 1px solid;">氏名</td>
			
			<td colspan="2" style="border-top: 1px solid">年生</td>
			<td colspan="7" style="border-top: 1px solid">職業</td>
			<td colspan="4" style="border-top: 1px solid">就職先</td>
			<td colspan="4" style="border-top: 1px solid">月収</td>
		</tr>
		<?php for($gdijp = 0; $gdijp < 7; $gdijp++): ?>
		<tr>
			<td colspan="3"></td>
			<td colspan="8"></td>
			<td colspan="2"></td>
			<td colspan="7"></td>
			<td colspan="4"></td>
			<td colspan="4"></td>
		</tr>
		<?php endfor; ?>
		<?php endif; ?>
		
		</table>
		<style>
          .page-break {
            page-break-after: always;
          }
        </style>
        <div class="page-break"></div>
	</div>
	</div>
<?php endif; ?>


<div class="ui bottom attached tab segment  <?php if(Auth::user()->can('diemdanh-create')): ?> active <?php endif; ?>" data-tab="daotao">
	<style>
		#daotaostyle table,#daotaostyle th,#daotaostyle td {
			/* border: 1px solid black; */
			border-collapse: collapse;
			padding-left: 5px; font-weight: 700; font-size: 16px;
		}
		tr {
			height: 50px;
		}
	</style>
	<?php
	   function ndjp($string) {
			$number =  strpos($string, '(');
			return substr($string,0,$number);
		}
		function ndvn($string) {
			return strstr($string, '(');
		}
		function newformat($datatime){
			$time = strtotime($datatime);
			$newformat = date('d - m - Y',$time);
			return $newformat;
		}
		function tinhtrang($datatinhtrang){
			switch($datatinhtrang){
				case(0):
					return 'Đang phỏng vấn';
					break;
				case(1):  
					return 'Chưa đăng ký đơn hàng'; 
					break;
				case(2):
					return 'Đậu phỏng vấn';
					break;
				// case(3): return '<a class="ui teal label">Dự bị</a>'; break;
				case(4):
					return 'Rớt phỏng vấn';
					break;
				case(5):
					return 'Đã xuất cảnh';
					break;
				default:
					return 'Đã hũy';
			}
		}
	?>
	<table style="width: 100%" id="daotaostyle">
		<tr>
			<th colspan="4" style="text-align: center; font-size: 30px;"><?php echo e($hocvien->hoten); ?></th>
		</tr>
		<tr>
			<td style="width: 10%;">Ngày sinh</td>
			<td style="width: 50%;"><?php echo e(newformat($hocvien->ngaysinh)); ?> </td>
			<td style="width: 10%;" >SĐT</td>
			<td style="width: 30%;"><?php echo e($hocvien->dienthoai); ?></td>
		</tr>
		<tr>
			<td>Lớp</td>
			<td><?php echo e($hocvien->ten_lop_hoc); ?></td>
			<td>SĐT GĐ</td>
			<td><?php echo e($hocvien->dtnguoithan); ?></td>
		</tr>
		<tr>
			<td>Quê Quán</td>
			<td><?php echo e($hocvien->noisinh); ?></td>
			<td>Ngày nhập học</td>
			<td>
				
				<?php echo e($hocvien->ngay_khai_giang); ?>

			</td>
		</tr>
		<tr>
			<td>Tình trạng</td>
			<td><?php echo e(tinhtrang($hocvien->tinhtrang)); ?></td>
			<td>DKXC</td>
			<td> <?php if($hocvien->dukienxc): ?> <?php echo e($hocvien->dukienxc); ?> <?php endif; ?> </td>
		</tr>
		<tr>
			<td>Ngày đậu PV</td>
			<td><?php echo e($hocvien->ngaytuyenkt); ?></td>
			<td>Ghi chú</td>
			<td> </td>
		</tr>
		<tr>
			<td rowspan="2">Ngành nghề</td>
			<td colspan="3"><?php echo e($hocvien->nganhnghe_jp); ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo e($hocvien->nganhnghe_vn); ?></td>
		</tr>
		<tr>
			<td rowspan="2">Nghiệp đoàn</td>
			<td colspan="3"><?php echo e(ndjp($hocvien->tennghiepdoan)); ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo e(ndvn($hocvien->tennghiepdoan)); ?></td>
		</tr>
		<tr>
			<td rowspan="2">Công ty</td>
			<td colspan="3"><?php echo e($hocvien->tencongty); ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo e($hocvien->doitacvn); ?></td>
		</tr>
		<tr>
			<td>ĐỊA CHỈ</td>
			<td colspan="3"><?php echo e($hocvien->diachi); ?></td>
		</tr>
	</table>
</div>

</body>
<script type="text/javascript">
	$('.menu .item').tab();
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


<script type="text/javascript">
	var tableToExcel = (function () {
    var uri = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]>'+
		''+
		'<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name>'+
		'<x:WorksheetOptions><x:DisplayGridlines/><x:Print><x:ValidPrinterInfo/><x:Scale>59</x:Scale><x:HorizontalResolution>4</x:HorizontalResolution><x:VerticalResolution>4</x:VerticalResolution></x:Print></x:WorksheetOptions>'+
		'</x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->'+
		'</head><body><table>{table}</table></body></html>',
        base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        }, format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
    return function (table, name, filename) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
        }
   document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
    }
})()
</script>

<style>#testTable{display: none;}</style>
<a id="dlink"  style="display:none;"></a>
<input class="ui green icon button" type="button" onclick="tableToExcel('testTable', '<?php echo e($hoso->hoten); ?>', '<?php echo e($hoso->hoten); ?>.xls')" value="Export to Excel">
<?php if($hosojp): ?>
	<table id="testTable"  cellspacing=0>
		<tr>
			<td height="5" colspan="4" style="border-left: 1px solid black; text-align: left; border-top: 1px solid black;">&nbsp;</td>
			<td colspan="22" rowspan="3" width="800" style=" text-align: center; border-top: 1px solid black; border-right: 1px solid black; font-size: 32px; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-weight: bold "> MIRAI HUMAN</td>
			<td colspan="5" width="150" style="border-right: 1px solid black; border-left: 1px solid black; text-align: left; border-top: 1px solid black;" >&nbsp;</td>
		</tr>
		<tr height="55">
			<td colspan="4" width="100" style="padding: 5px 5px; border-left: 1px solid black; text-align: left; ">&nbsp;<img src="<?php echo e(url('')); ?>/hocviens/logo.png"></td>
			<td colspan="5" width="170" style=" text-align: left;  border-right: 1px solid black; font-size: 15px; font-family: 'Times New Roman', Times, serif; vertical-align:middle;">番号：</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: 1px solid black;">&nbsp;</td>
			<td colspan="5" rowspan="6" width="140" style="text-align: center; border: 1px solid black;">
				<?php if(($hoso->hinhanh != NULL) && (strlen($hoso->hinhanh) < 100)): ?>
					<img src="<?php echo e(url('')); ?>/hocviens/<?php echo e($year_image); ?>/<?php echo e($month_image); ?>/<?php echo e($hoso->hinhanh); ?>" >
				<?php else: ?>
					<img src="<?php echo e($hoso->hinhanh); ?>">
				<?php endif; ?>
			</td>
		</tr>
		<tr height="55">
			<td colspan="26" style="padding: 5px 0px; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black; font-size: 23px; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-weight: bold; background-color: #C0C0C0;">技能実習生履歴書</td>
		</tr>
		<tr >
			<td colspan="4" rowspan="2" style="padding: 5px 0px; text-align: center; border-left: 1px solid black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名</td>
			<td colspan="5" height="36" style="padding: 5px 0px; text-align: center; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">英字表記</td>
			<td colspan="17" style="padding: 10px 0px; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 21px;text-transform: uppercase;"><?php echo e(convert_hoten($hoso->hoten)); ?></td>
		</tr>
		<tr>
			<td colspan="5" height="36" style="padding: 5px 0px; text-align: center;border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">フリガナ</td>
			<td colspan="17" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 21px;"><?php echo e($hosojp->hoten); ?></td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">生年月日</td>
			<td colspan="10" height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e(date_format(date_create($hoso->ngaysinh),"Y年m月d日")); ?></td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e(getAge(date_format(date_create($hoso->ngaysinh),"Y/m/d"))); ?></td>
			<td colspan="2"  height="36" rowspan="2" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">利き手</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">仕事</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->congviec == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
			<td  height="36" colspan="2" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">箸</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->dua == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; border-left: 1px solid black; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">性別</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->gioitinh == 0): ?> 女 <?php else: ?> 男 <?php endif; ?></td>
			<td colspan="2"  height="36" rowspan="3" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">宗教</td>
			<td colspan="2"  height="36" rowspan="3" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->tongiao); ?></td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">鋏</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->keo == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black;  font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">ペン</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-bottom: 1px dotted black;  font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->viet == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">婚姻</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->honnhan); ?></td>
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">身長（センチ）</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoso->chieucao); ?></td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">体重（キロ）</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px solid black; border-right: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoso->cannang); ?></td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">病暦</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->benhan); ?></td>
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">血液</td>
			<td colspan="9"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoso->nhommau); ?></td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">出身地</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->noisinh); ?></td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">地方</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->mien); ?></td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">視カ</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">左</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->mattrai); ?></td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">右</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; border-top: 1px dotted black; border-right: 1px solid black; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->matphai); ?></td>
		</tr>
		<tr style="height:5px;">
			<td colspan="31" style=" border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="6" height="40" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">戸籍住所</td>
			<td colspan="20" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
				<?php if($hosojp->diachi): ?>
					<?php echo e($hosojp->diachi); ?>

				<?php else: ?>
				<?php if($hosojp->dchk): ?>
					<?php $dchk = json_decode($hosojp->dchk);  echo $dchk->dchk_tinh." ".$dchk->dchk_tinh_plus." ".$dchk->dchk_huyen." ".$dchk->dchk_huyen_plus." ".$dchk->dchk_xa." ".
					$dchk->dchk_xa_plus." ".$dchk->dchk_dc." ".$dchk->dchk_dc_plus; ?>
				<?php endif; ?>
				<?php endif; ?>
			</td>
			<td colspan="3" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">地方</td>
			<td colspan="2" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->diachimien); ?></td>
		</tr>
		<tr style="height:5px; ">
			<td colspan="31" style="border: 1px solid black;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
		</tr>
		<?php
			$hoctap_excel_jp = json_decode($hosojp->hoctap);
		?>
		<?php if($hoctap_excel_jp->thoigianbd[0]): ?>		
		<tr style="vertical-align:middle">
			<td colspan="4" rowspan="<?php echo e(count($hoctap_excel_jp->thoigianbd)+1); ?>" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; text-align: center; background-color:#C0C0C0;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学歴</td>
			<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
			<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学 校 名　</td>
			<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学校所在地</td>
		</tr>
		<?php for($i_excel_jp = 0 ; $i_excel_jp < count($hoctap_excel_jp->thoigianbd); $i_excel_jp++): ?>    
		<tr>
			<?php
				$thangbd_excel_jp = substr( $hoctap_excel_jp->thoigianbd[$i_excel_jp],  0, 2);
				$nambd_excel_jp = substr( $hoctap_excel_jp->thoigianbd[$i_excel_jp],  3, 7);
				$thangkt_excel_jp = substr( $hoctap_excel_jp->thoigiankt[$i_excel_jp],  0, 2);
				$namkt_excel_jp = substr( $hoctap_excel_jp->thoigiankt[$i_excel_jp],  3, 7);
			?>
			<?php if(strlen($hoctap_excel_jp->thoigianbd[$i_excel_jp]) == 4): ?>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoctap_excel_jp->thoigianbd[$i_excel_jp]); ?>年09月</td>
				<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoctap_excel_jp->thoigiankt[$i_excel_jp]); ?>年05月</td>
			<?php elseif( strlen($hoctap_excel_jp->thoigianbd[$i_excel_jp]) == 7): ?>
			<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nambd_excel_jp); ?>年<?php echo e($thangbd_excel_jp); ?>月</td>
				<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
				<?php if(strlen($hoctap_excel_jp->thoigiankt[$i_excel_jp]) == 7): ?>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($namkt_excel_jp); ?>年<?php echo e($thangkt_excel_jp); ?>月</td>
				<?php else: ?>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoctap_excel_jp->thoigiankt[$i_excel_jp]); ?></td>
				<?php endif; ?>
			<?php else: ?>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
			<?php endif; ?>
		    
			<?php if($i_excel_jp > 2): ?>
				<td colspan="11" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoctap_excel_jp->tentruong[$i_excel_jp]); ?></td>
			<?php else: ?>
				<td colspan="11" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoctap_excel_jp->tentruong[$i_excel_jp]); ?> <?php if(isset($arrhoctap[$i_excel_jp])): ?> <?php echo e($arrhoctap[$i_excel_jp]); ?> <?php endif; ?> </td>			
			<?php endif; ?>
			<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoctap_excel_jp->diachitruong[$i_excel_jp]); ?><?php if(isset($hoctap_excel_jp->dctinh)): ?> <?php echo e($hoctap_excel_jp->dctinh[$i_excel_jp]); ?> <?php endif; ?></td>
		</tr>
		<?php endfor; ?> 
		<?php else: ?>
		<tr style="vertical-align:middle">
			<td colspan="4" rowspan="6" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; text-align: center; background-color:#C0C0C0;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学歴</td>
			<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
			<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学 校 名　</td>
			<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学校所在地</td>
		</tr>
		<?php endif; ?> 			
		<tr style="height:5px; ">
			<td colspan="31" style="border: 1px solid black"></td>
		</tr>
		<?php
			$lamviec_excel_jp = json_decode($hosojp->lamviec); 
		?>
		<?php if($lamviec_excel_jp->thoigianbd[0]): ?>
			<tr style="vertical-align:middle">
				<td colspan="4" rowspan="3" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職歴</td>
				<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
				<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">勤　務　先</td>
				<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職　種</td>
			</tr>
			<?php 
				$subtractlv_excel_jp =( 2 - count($lamviec_excel_jp->thoigianbd)); 
			?>
			<?php if($subtractlv_excel_jp <= 0): ?>
				<?php for($i = 0 ; $i < 2; $i++): ?>
				<tr style="vertical-align:middle">
					<td colspan="5" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						<?php echo e(substr($lamviec_excel_jp->thoigianbd[$i],3)."年"); ?><?php echo e(substr($lamviec_excel_jp->thoigianbd[$i],0,2)."月"); ?>

					</td>
					<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						<?php echo e(substr($lamviec_excel_jp->thoigiankt[$i],3)."年"); ?><?php echo e(substr($lamviec_excel_jp->thoigiankt[$i],0,2)."月"); ?>

					</td>
					<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($lamviec_excel_jp->tencongty[$i]); ?></td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($lamviec_excel_jp->ndcongviec[$i]); ?></td>
				</tr>
				<?php endfor; ?>
			<?php else: ?>
				<?php for($i = 0 ; $i < count($lamviec_excel_jp->thoigianbd); $i++): ?>
				<tr>
					<td colspan="5" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						<?php echo e(substr($lamviec_excel_jp->thoigianbd[$i],3)."年"); ?><?php echo e(substr($lamviec_excel_jp->thoigianbd[$i],0,2)."月"); ?>

					</td>
					<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						<?php echo e(substr($lamviec_excel_jp->thoigiankt[$i],3)."年"); ?><?php echo e(substr($lamviec_excel_jp->thoigiankt[$i],0,2)."月"); ?>

					</td>
					<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($lamviec_excel_jp->tencongty[$i]); ?></td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($lamviec_excel_jp->ndcongviec[$i]); ?></td>
				</tr>
				<?php endfor; ?>
				<?php for($lvijp = 0; $lvijp < $subtractlv_excel_jp; $lvijp++): ?>
				<tr>
					<td colspan="5" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
					<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				</tr>
				<?php endfor; ?>
			<?php endif; ?>
		<?php else: ?>
			<tr style="vertical-align:middle">
				<td colspan="4" rowspan="3" width="100" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職歴</td>
				<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
				<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">勤　務　先</td>
				<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職　種</td>
			</tr>
		<?php endif; ?>
		<tr style="height:5px; ">
			<td colspan="31" style="border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="4" rowspan="4" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">外国語</td>
			<td colspan="3" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">英語</td>
			<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
				<?php if($hoso->anhngu == 0): ?>
	        	無
				<?php elseif($hoso->anhngu == 1): ?>
					A
				<?php elseif($hoso->anhngu == 2): ?>
					B
				<?php elseif($hoso->anhngu == 3): ?>	
					C				    
				<?php endif; ?>
			</td>
			<td colspan="7" style=" padding: 5px 0px; border-right: 1px dotted black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">訪日経験</td>
			<td colspan="6" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"> <?php if($hoso->datungtoinhat == '1'): ?> 有 <?php else: ?> 無 <?php endif; ?></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="3" rowspan="2" style=" padding: 50px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">日本語</td>
			<td colspan="11" rowspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->nhatngu); ?></td>
			<td colspan="7" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">在日本親戚．知人</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->conguoithantainhat == '1'): ?> 有 <?php else: ?> 無 <?php endif; ?> </td>
		</tr>
		<?php
		 	if ($hosojp->nguoithan) {
				$nguoithan = json_decode($hosojp->nguoithan);
				if ($nguoithan->hoten) {
					$subtractnt_excel_jp =( 2 - count($nguoithan->hoten));					
				}else{
					$subtractnt_excel_jp = 2;
				}
			}else {
				$nguoithan = json_decode('{"hoten":["",""],"tuoi":["",""],"quanhe":["",""]}');
				$subtractnt_excel_jp = 0;
			}
		?>
		<?php if( $subtractnt_excel_jp < 2 ): ?>
			<tr style="vertical-align:middle">
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nguoithan->hoten[0]); ?></td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nguoithan->tuoi[0]); ?> </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nguoithan->quanhe[0]); ?></td>
			</tr>
		<?php else: ?>
			<tr style="vertical-align:middle">
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
			</tr>
		<?php endif; ?>
	    <tr style="vertical-align:middle">
				<td colspan="3" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">その他</td>
				<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"> 無</td>
			<?php if( $subtractnt_excel_jp < 1 ): ?>
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nguoithan->hoten[1]); ?></td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nguoithan->tuoi[1]); ?> </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($nguoithan->quanhe[1]); ?></td>
			<?php else: ?>
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
			<?php endif; ?>
	    </tr>
		<tr style="height:5px;">
			<td colspan="31" style=" border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="31" height="36" style=" padding: 5px 0px; border-right: 1px solid black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">日本での技能実習について</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="10" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">日本に行く目的</td>
			<td colspan="21" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->mucdich); ?></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="10" height="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">毎月の貯金</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoso->sotientrenthang); ?> ドン</td>
			<td colspan="9" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">3年間の貯金</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hoso->sotientrennam); ?> ドン</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="10" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">帰国後の目摽</td>
			<td colspan="21" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->muctieu); ?></td>
		</tr>
		<tr style="height:5px;">
			<td colspan="31" style="border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="31" height="36" style=" padding: 5px 0px; border-right: 1px solid black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">その他</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="4" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">免許</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php if($hoso->banglai == 1): ?> 有 <?php else: ?> 無 <?php endif; ?> </td>
			<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">種類</td>
			<td colspan="19" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
				&nbsp; <?php if($hoso->xemay == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?>  バイク 
				&nbsp; <?php if($hoso->oto == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> 車  
				&nbsp; <?php if($hoso->xekhac != ''): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> その他(&ensp;&ensp;<?php echo e($hoso->xekhac); ?>&ensp;&ensp;)
			</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="4" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">趣味</td>
			<td colspan="12" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->sothich); ?></td>
			<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">長所</td>
			<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($hosojp->diemmanh); ?></td>
		</tr>
		<tr style="height:5px;">
			<td colspan="31" style=" border: 1px solid black"></td>
		</tr>
		<?php
			$giadinh_excel_jp = json_decode($hosojp->giadinh);
		?>
		<?php if($giadinh_excel_jp->quanhe[0]): ?>
			<tr style="vertical-align:middle">
				<td colspan="3" rowspan="8" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">家族構成</td>
				<td colspan="3" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄</td>
				<td colspan="8" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名</td>		
				<td colspan="2" width="50" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年生</td>
				<td colspan="7" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職業</td>
				<td colspan="4" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">就職先</td>
				<td colspan="4" style=" padding: 5px 0px;border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">月収</td>
			</tr>
			<?php 
				$subtractgd_excel_jp =( 7 - count($giadinh_excel_jp->quanhe)); 
			?>
			<?php if($subtractgd_excel_jp <= 0): ?>
				<?php for($i = 0 ; $i < 7; $i++): ?>
				<tr>
					<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->quanhe[$i]); ?></td>
					<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->hoten[$i]); ?></td>
					<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->namsinh[$i]); ?></td>
					<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->congviec[$i]); ?></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->noilam[$i]); ?> <?php if(isset($giadinh_excel_jp->dctinh[$i])): ?> <?php echo e($giadinh_excel_jp->dctinh[$i]); ?>  <?php endif; ?></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->thunhap[$i]); ?> ドン</td>
				</tr>
				<?php endfor; ?>
			<?php else: ?>
				<?php for($i = 0 ; $i < count($giadinh_excel_jp->quanhe); $i++): ?>
				<tr>
					<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->quanhe[$i]); ?></td>
					<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->hoten[$i]); ?></td>
					<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->namsinh[$i]); ?></td>
					<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->congviec[$i]); ?></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->noilam[$i]); ?> <?php if(isset($giadinh_excel_jp->dctinh[$i])): ?> <?php echo e($giadinh_excel_jp->dctinh[$i]); ?>  <?php endif; ?></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"><?php echo e($giadinh_excel_jp->thunhap[$i]); ?> ドン</td>
				</tr>
				<?php endfor; ?>
				<?php for($gdijp = 0; $gdijp < $subtractgd_excel_jp; $gdijp++): ?>
				<tr>
					<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				</tr>
				<?php endfor; ?>
			<?php endif; ?>
		<?php else: ?>
			<tr style="vertical-align:middle">
				<td colspan="3" rowspan="8" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">家族構成</td>
				<td colspan="3" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄</td>
				<td colspan="8" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名</td>		
				<td colspan="2" width="50" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年生</td>
				<td colspan="7" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職業</td>
				<td colspan="4" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">就職先</td>
				<td colspan="4" style=" padding: 5px 0px;border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">月収</td>
			</tr>
			<?php for($gdijp = 0; $gdijp < 7; $gdijp++): ?>
			<tr>
				<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
			</tr>
			<?php endfor; ?>
		<?php endif; ?>		  
		<tr style="height:5px;">
			<td colspan="31" style="border: 0px ; border-top: 1px solid black"></td>
		</tr>
	</table>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>