<?php $__env->startSection('title', 'In Hồ Sơ'); ?>
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
?>
<center style="margin-bottom: 20px;"><a href="javascript:void(0)" onclick="In_Content('intiengnhat')" >
    <div class="ui red icon button">
     <i class="print icon"></i> IN LIST TIẾNG NHẬT
    </div>
  </a>
</center>

<div id="intiengnhat">
	<style type="text/css">
		body {
			background: #EBECED;
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
<?php $__currentLoopData = $hosojps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hosojp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
	<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
	  <tr class="logo-form">
	    <td colspan="26" style="  border: none;border-bottom: 1px solid" >
	        <span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
	        <h2>MIRAI HUMAN </h2>
	    </td>
	    <td colspan="5" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
	        <p style="text-align: left; font-weight: bold;"> 番号：<?php echo e($hosojp->stt); ?></p>
            
            <?php
				$timestamp_image = strtotime($hosojp->created_at);
				$year_image = date("Y", $timestamp_image);
				$month_image = date("m", $timestamp_image);
			?>
			<?php if(($hosojp->hinhanh != NULL) && (strlen($hosojp->hinhanh) < 100)): ?>
				<img src="<?php echo e(url('')); ?>/hocviens/<?php echo e($year_image); ?>/<?php echo e($month_image); ?>/<?php echo e($hosojp->hinhanh); ?>" width="100%">
			<?php else: ?>
				<img src="<?php echo e($hosojp->hinhanh); ?>" width="100%">
			<?php endif; ?>
	    </td>
	  </tr>
	  
	  <tr>
	    <td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">技能実習生履歴書</td>
	  </tr>
	  
	  <tr>
	    <td colspan="4" rowspan="2" style="border-left: none; width: 100px; ">氏名</td>
		<td colspan="3">英字表記</td>
	    <td colspan="19" style="font-size:20px;font-weight:bold; text-transform: uppercase;"><?php echo e(convert_hoten($hosojp->hotenvn)); ?></td>
	   
	  </tr>
	  <tr>
	    <td colspan="3">フリガナ</td>
	    <td colspan="19" style="font-size:20px;"><?php echo e($hosojp->hoten); ?></td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">生年月日</td>
	    <td colspan="10"><?php echo e(date_format(date_create($hosojp->ngaysinh),"Y年m月d日")); ?></td>
	    <td colspan="2">年齢</td>
	    <td colspan="2"><?php echo e(getAge(date_format(date_create($hosojp->ngaysinh),"Y/m/d"))); ?></td>
	    <td colspan="2" rowspan="2" style="width: 70px">利き手 </td>
	    <td colspan="2">仕事</td>
	    <td style="min-width: 50px"><?php if($hosojp->congviec == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
	    <td colspan="2" style="min-width: 50px">箸</td>
	    <td style="min-width: 50px"><?php if($hosojp->dua == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">性別</td>
	    <td colspan="10"><?php if($hosojp->gioitinh == 0): ?> 女 <?php else: ?> 男 <?php endif; ?></td>
	    <td colspan="2" rowspan="3">宗教</td>
	    <td colspan="2" rowspan="3"><?php echo e($hosojp->tongiao); ?></td>
	    <td colspan="2" style="min-width: 50px">鋏</td>
	    <td style="min-width: 50px"><?php if($hosojp->keo == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
	    <td colspan="2">ペン</td>
	    <td style="min-width: 50px"><?php if($hosojp->viet == 0): ?> 右 <?php else: ?> 左 <?php endif; ?></td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">婚姻</td>
	    <td colspan="10"><?php echo e($hosojp->honnhan); ?></td>
	    <td colspan="4">身長（センチ)</td>
	    <td colspan="3"><?php echo e($hosojp->chieucao); ?></td>
	    <td colspan="3">体重（キロ)</td>
	    <td colspan="3"><?php echo e($hosojp->cannang); ?></td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">病暦</td>
	    <td colspan="10"><?php echo e($hosojp->benhan); ?></td>
	    <td colspan="4">血液</td>
	    <td colspan="9"><?php echo e($hosojp->nhommau); ?></td>
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
			$hoctap = DB::table('hoso_hocviens')->join('hoctaps','hoso_hocviens.id','=','hoctaps.hocvien_id')
        ->select('hoctaps.*')->where('hoctaps.hocvien_id', $hosojp->id_hocvien)->get();
			
		?>
		
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
// $arrhoctap = array("小学校", "中学校", "高等学校");
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
	    	<?php if($hosojp->anhngu == 0): ?>
	        	無
			<?php elseif($hosojp->anhngu == 1): ?>
	        	A
	        <?php elseif($hosojp->anhngu == 2): ?>
	        	B
	        <?php elseif($hosojp->anhngu == 3): ?>	
	        	C				    
	        <?php endif; ?>
		</td>
	    <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">訪 日 経 験</td>
	    <td colspan="6" style="border-top: 1px solid;"> 無 </td>
		</tr>
		<tr>
	    <td colspan="3" rowspan="2">日本語</td>
	    <td colspan="11" rowspan="2">
			<?php echo e($hosojp->nhatngu); ?>

	    </td>
	    <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">在日本親戚．知人</td>
	    <td colspan="6"> 無 </td>
	 	</tr>
	    <tr>
	    <td style="">氏名:</td>
	    <td colspan="5">&nbsp;</td>
	    <td>年齢:</td>
	    <td colspan="2">&nbsp;</td>
	    <td colspan="2">続柄: </td>
	    <td colspan="2">&nbsp;</td>
	    </tr>
	    <tr>
	    <td colspan="3" style="border-bottom: 1px solid;">その他</td>
	    <td colspan="11" style="border-bottom: 1px solid;">無</td>
	    <td style="border-bottom: 1px solid;">氏名:</td>
	    <td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
	    <td style="border-bottom: 1px solid;">年齢:</td>
	    <td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
	    <td colspan="2" style="border-bottom: 1px solid;">続柄: </td>
	    <td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
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
	    <td colspan="8"><?php echo e($hosojp->sotientrenthang); ?> ドン</td>
	    <td colspan="7">3年間の貯金</td>
	    <td colspan="6"><?php echo e($hosojp->sotientrennam); ?> ドン</td>
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
	    <td colspan="6"><?php if($hosojp->banglai == 1): ?> はい <?php else: ?> 無 <?php endif; ?> </td>
	    <td colspan="2"> 種類 </td>
        <td colspan="19" style="text-align: left;">&nbsp; 
            <?php if($hosojp->xemay == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?>  バイク  
				&nbsp; <?php if($hosojp->oto == 1): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> 車
			&nbsp; <?php if($hosojp->xekhac != ''): ?> &#9745; <?php else: ?> &#9744; <?php endif; ?> その他 (&ensp;&ensp;<?php echo e($hosojp->xekhac); ?>&ensp;&ensp;)
						    
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
			<td colspan="2" rowspan="" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
			<td colspan="3" style="border-top: 1px solid;">続柄</td>
			<td colspan="8" style="border-top: 1px solid;">氏名</td>
			
			<td colspan="2" style="border-top: 1px solid">年生</td>
			<td colspan="7" style="border-top: 1px solid">職業</td>
			<td colspan="4" style="border-top: 1px solid">就職先</td>
			<td colspan="4" style="border-top: 1px solid">月収</td>
		</tr>
		<?php endif; ?>
		
		</table>
		<style>
          .page-break {
            margin-top: 50px;
            page-break-after: always;
          }
        </style>
        <div class="page-break"></div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
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
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>