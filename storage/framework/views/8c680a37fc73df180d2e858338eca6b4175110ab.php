<?php $__env->startSection('title', 'Đào Tạo - Báo cáo '); ?>
<?php $__env->startSection('PageContent'); ?>

<?php
    function newformat($datatime){
        $time = strtotime($datatime);
        $newformat = date('d-m-Y',$time);
        return $newformat;
    }
?>
<style>
    table,
    th,td{
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        font-weight: 700;
        font-size: 14px;
    }
    td {
        border: 1px dotted black;
        font-weight: 200;
        font-size: 12px;
    }
    tr {
        height: 40px;
    }
</style>
<?php if(session('status')): ?>
    <div class="ui message blue">
        <i class="close icon"></i>
        <div class="header"> Thông Báo !</div>
        <p><?php echo e(session('status')); ?></p>
    </div>
<?php endif; ?>
<?php if(!$dataedit || ($dataedit == null)): ?>
<div class="ui">Chưa có dữ liệu</div>
<?php else: ?>
<form class="ui form">
    <div style="overflow-x:auto;">
        <table id="daotaostyle" style="width: 100%;">
            <thead>
                <tr class="red">
                    <th colspan="14">府中硝子トーヨー住器株式会社</th>
                </tr>
                <tr class="red">
                    <th rowspan="2" style="min-width:10px;">順番 <br> (STT)</td>
                    <th rowspan="2" style="min-width: 250px;">氏名 <br> (Họ và tên)</th>
                    <th rowspan="2" style="min-width: 100px;">性別 <br> (Giới tính)</th>
                    <th rowspan="2" style="min-width: 100px;">生年月日 <br> (Năm sinh)</th>
                    <th colspan="3">出欠席 <br> (Điểm danh)</th>
                    <th rowspan="2" style="min-width: 150px;" >レベル <br> (Bài học)</th>
                    <th style="min-width: 70px;">文法 語彙 <br> (Ngữ pháp & từ vựng)</th>
                    <th style="min-width: 70px;">聴解 <br> (Nghe)</th>
                    <th style="min-width: 70px;">会話 <br> (Nói)</th>
                    <th rowspan="2">平均 点 <br> (Điểm tb)</th>
                    <th rowspan="2">成績評価 <br> (Điểm đg)</th>
                    <th rowspan="2" style="min-width: 200px;">コメント <br> (Đánh giá)</th>
                </tr>
                <tr class="red">
                    <th style="min-width: 50px;">出席 <br> (Có mặt)</th>
                    <th style="min-width: 50px;">欠席 <br> (Vắng)</th>
                    <th style="min-width: 50px;">(Trể)</th>
                    <th>100点 満点</th>
                    <th>100点 満点</th>
                    <th>100点 満点</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $dataedit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="id_hocvien[]" value="<?php echo e($item->id_hocvien); ?>">
                <input type="hidden" name="co_mat[]" value="<?php echo e($item->co_mat); ?>">
                <input type="hidden" name="vang[]" value="<?php echo e($item->vang); ?>">
                <input type="hidden" name="tre[]" value="<?php echo e($item->tre); ?>">
                <tr>
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo e($item->hoten); ?></td>
                    <td> <?php if($item->gioitinh == 1): ?> nam <?php else: ?> nữ <?php endif; ?> </td>
                    <td><?php echo e(newformat($item->ngaysinh)); ?></td>
                    <td><?php echo e($item->co_mat); ?></td>
                    <td><?php echo e($item->vang); ?></td>
                    <td><?php echo e($item->tre); ?></td>
                    <td>
                        <div class="ui mini input">
                            <input type="text" name="bai_hoc[]" value="<?php echo e($item->bai_hoc); ?>" placeholder="Bài học">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="ngu_phap[]" value="<?php echo e($item->ngu_phap); ?>" placeholder="Ngữ pháp & ...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="nghe[]" value="<?php echo e($item->nghe); ?>" placeholder="Nghe...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="noi[]" value="<?php echo e($item->noi); ?>" placeholder="nói...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="diem_trung_binh[]" value="<?php echo e($item->diem_trung_binh); ?>" placeholder="Điểm trung bình...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="diem_danh_gia[]" value="<?php echo e($item->diem_danh_gia); ?>" placeholder="Điểm đánh giá...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <textarea name="danh_gia[]" rows="1" placeholder="Đánh giá..."><?php echo e($item->danh_gia); ?></textarea>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</form>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>