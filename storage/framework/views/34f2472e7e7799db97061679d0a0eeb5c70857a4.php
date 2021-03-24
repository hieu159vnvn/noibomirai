<?php $__env->startSection('title', 'Đào Tạo - Báo cáo '); ?>
<?php $__env->startSection('PageContent'); ?>
    <?php
        function newformat($datatime){
            $time = strtotime($datatime);
            $newformat = date('m-Y',$time);
            return $newformat;
        }

        if ($date && ($date!='all')) {
            $time = strtotime($date);
            $month = date("m",$time);
            $year = date("Y",$time);  
        }
        else{
            $month = date("m");
            $year = date("Y");  
        }
    ?>

    <?php if(session('status')): ?>
        <div class="ui message blue">
            <i class="close icon"></i>
            <div class="header"> Thông Báo !</div>
            <p><?php echo e(session('status')); ?></p>
        </div>
    <?php endif; ?>
    <h2 class="ui header center aligned">
        QUẢN LÝ BÁO CÁO
        <div class="sub header">
            Tháng báo cáo. (<?php echo e(newformat($date)); ?>)
        </div>
    </h2>
    <form class="ui form" action="" method="post" autocomplete="off">
        <?php echo e(csrf_field()); ?>	
        <div class="ui segments">
            <div class="ui segment">
                <div style="font-size: 20px !important; padding: 10px 0px;">Tháng báo cáo</div>
                <input type="hidden" id="month-hidden" value="<?php echo e($month); ?>">
                <select class="ui dropdown" name="month" id="month">
                    <option value="">Tháng</option>
                    <?php for($i = 1; $i <= 12 ; $i++): ?>
                        <option <?php if($i == $month): ?> selected <?php endif; ?> value="<?php echo e($i); ?>">Tháng <?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
                <input type="hidden" id="year-hidden" value="<?php echo e($year); ?>">
                <select class="ui dropdown" name="year" id="year">
                    <option value="">Year</option>
                    <?php for($i = -2; $i < 1; $i++): ?>
                        <option <?php if(($year+$i) == $year): ?> selected <?php endif; ?> value="<?php echo e($year+$i); ?>"><?php echo e($year+$i); ?></option>
                    <?php endfor; ?>
                </select>
                <div style="font-size: 20px !important; padding: 10px 0px;">Thời hạn báo cáo</div>
                <span class="ui calendar" id="date-only-from">
                    <label>TỪ NGÀY:</label>
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="tgbd" value="<?php echo e($checkdate ? $checkdate->tgbd : date("Y-m-d")); ?>">
                    </div>
                </span>
                <span class="ui calendar" id="date-only-to">
                    <label>ĐẾN NGÀY:</label>
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="tgkt" value="<?php echo e($checkdate ? $checkdate->tgkt : date("Y-m-d")); ?>">
                    </div>
                </span>

                <div class="ui toggle checkbox">
                    <input type="checkbox" name="duyet" <?php if((isset($checkdate->duyet) && $checkdate->duyet == 1)): ?> checked <?php endif; ?> >
                    <label>Thời gian có hiệu lực</label>
                </div>
            </div>
            <?php if(Auth::user()->hasRole('Đào Tạo')): ?>
                <button type="submit" class="ui labeled icon button green"><i class="save icon"></i> Tạo hoặc cập nhật báo cáo</button>
            <?php endif; ?>
        </div>
        
            
    </form>
        
        <div class="ui segment">
            <h2 class="ui header centered ">Danh sách Lớp Học </h2>  
            <table id="data-table" class="ui celled striped table left">	
                <thead class="full-width">
                <tr style="text-align: left;">
                    <th>GIÁO VIÊN</th>
                    <th>LỚP HỌC</th>
                    <th>BÁO CÁO</th>
                    <th>XEM</th>		          
                </tr>
                </thead>
                <tbody>		
                    <tr>
                        <td colspan="4" style="text-align: left;"><h3 class="ui left">Phòng đào tạo</h3></td>
                    </tr>
                    <?php $__currentLoopData = $daotao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="text-align: left;">
                            <td>
                                <?php echo e($dt->hoten); ?>

                            </td>									
                            <td> Lớp <?php echo e($dt->ten_lop_hoc); ?> </td>
                            <td>
                                <div class="item">
                                    <?php if(Auth::user()->hasRole('Đào Tạo')): ?>
                                        <?php if($dt->checkbaocao == 0 ): ?>
                                            <div class="mini ui icon red button baocao" attrid="<?php echo e($dt->id); ?>"><i class="check icon"></i> Chưa Báo cáo</div>
                                        <?php else: ?>
                                            <div class="mini ui icon blue button baocao" attrid="<?php echo e($dt->id); ?>"><i class="check icon"></i> Đã Báo cáo </div>
                                        <?php endif; ?>													
                                    <?php else: ?>
                                        <?php if($dt->checkbaocao == 0 ): ?>
                                            <div class="mini ui icon red button baocao" attrid="<?php echo e($dt->id); ?>"><i class="check icon"></i> Chưa Báo cáo</div>
                                        <?php else: ?>
                                            <div class="mini ui icon blue button baocao" attrid="<?php echo e($dt->id); ?>"><i class="check icon"></i> Đã Báo cáo </div>
                                        <?php endif; ?>	
                                    <?php endif; ?>
                                </div>	
                            </td>
                            <td> 
                                <div class="item">
                                    <?php if(Auth::user()->hasRole('Đào Tạo')): ?>
                                        <div class="mini ui icon blue button xem" attrid="<?php echo e($dt->id); ?>"><i class="check icon"></i> Xem</div>
                                    <?php else: ?>
                                        <div class="mini ui icon button <?php if($dt->id == $iddaotao): ?> blue  xem <?php else: ?> red <?php endif; ?> " attrid="<?php echo e($dt->id); ?>"><i class="check icon"></i> Xem</div>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="column">
            <br/>
            <hr/>	
        </div>

    

<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
<script>
    $('.ui.dropdown').dropdown('hide');

    $("#month").change(function(){
        $("#month-hidden").val($(this).val());

        var thang_baocao = $('#year').val() +"-"+$(this).val();
        $.get("/daotao/ajaxthang/"+thang_baocao, function(data, status){
            location.assign("/daotao/manage-baocao/"+thang_baocao);
        });
    });  
    $("#year").change(function(){
        $("#year-hidden").val($(this).val());
        
        var thang_baocao = $(this).val() +"-"+$("#month").val();
        $.get("/daotao/ajaxthang/"+thang_baocao, function(data, status){
            location.assign("/daotao/manage-baocao/"+thang_baocao);
        });
    });    
    $(".baocao").click(function(){
        var id = $(this).attr('attrid');
        var date = $("#year-hidden").val() + '-' + $("#month-hidden").val();
        $.get("/daotao/ajaxbaocao/"+date+"/"+id, function(data, status){
            location.assign("/daotao/baocao/"+date+"/"+id);
        });
    });

    $(".xem").click(function(){
        var id = $(this).attr('attrid');
        var date = $("#year-hidden").val() + '-' + $("#month-hidden").val();
        console.log(date + '/'+id);
        $.get("/daotao/ajaxwatchbaocao/"+date+"/"+id, function(data, status){
            location.assign("/daotao/watchbaocao/"+date+"/"+id);
        });
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
                return day + '-' + month + '-' + year;
        }
        }
    }
    $('#date-only-from').calendar(calendarOpts);
    $('#date-only-to').calendar(calendarOpts);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>