<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="ui four column grid">
    <div class="sixteen wide mobile eight wide tablet four wide computer column">
        <div class="ui horizontal segments">
            <div class="ui inverted teal segment center aligned">
                <div class="ui inverted  statistic">
                    <div class="value counter">
                        <?php echo e(count($nhanvien)); ?>

                    </div>
                    <div class="label">
                        Nhân viên
                    </div>
                </div>
            </div>
            <div class="ui inverted teal tertiary segment center aligned">
                <div id="sparkline1"><i style="font-size: 70px;" class="fa fa-male" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>

    <div class="sixteen wide mobile eight wide tablet four wide computer column">
        <div class="ui horizontal segments">
            <div class="ui inverted red segment center aligned">

                <div  class="ui inverted statistic">
                    <div class="value counter">
                        <?php echo e(count($hocvien)); ?>

                    </div>
                    <div class="label">
                         Học viên
                    </div>
                </div>
            </div>
            <div class="ui inverted red tertiary segment center aligned">
                <div id="sparkline2"><i style="font-size: 70px;" class="fa fa-users" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
    <div class="sixteen wide mobile eight wide tablet four wide computer column">
        <div class="ui horizontal segments">
            <div class="ui inverted blue segment center aligned">

                <div class="ui inverted statistic">
                    <div class="value counter">
                        <?php echo e(count($giaovien)); ?>

                    </div>
                    <div class="label">
                        Giáo viên
                    </div>
                </div>
            </div>
            <div class="ui inverted blue tertiary segment center aligned">
                <div id="sparkline3"><i style="font-size: 70px;" class="fa fa-graduation-cap" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
    <div class="sixteen wide mobile eight wide tablet four wide computer column">
        <div class="ui horizontal segments">
            <div class="ui inverted green segment center aligned">

                <div class="ui inverted statistic">
                    <div class="value counter">
                        <?php echo e(count($dadinhat)); ?>

                    </div>
                    <div class="label">
                        Đã xuất cảnh
                    </div>
                </div>
            </div>
            <div class="ui inverted green tertiary segment center aligned">
                <div id="sparkline4"><i style="font-size: 70px;" class="fa fa-plane" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="ui two column grid">
    <div class="sixteen wide tablet ten wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                Thống kê số lượng học viên trong năm <?php echo e(date('Y')); ?>       
            </div>
            <div class="ui segment">
                <canvas id="hvChartMonth" data-order="<?php echo e($tkmonth); ?>" width="800" height="490"></canvas>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>

        </div>
    </div>
	<div class="sixteen wide tablet six wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                    Lịch sử truy cập
            </div>
            <div class="ui segment left aligned">
                <table class="ui very basic center aligned  celled table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Họ tên</th>
                            <th>Thời gian</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ls): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td><?php echo e($ls->id_user); ?></td>
                            <td><?php echo e(date('H:i:s d/m/Y',$ls->tm)); ?></td>
                            <td><a class="ui blue mini basic label"><?php echo e($ls->ip); ?></a></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </tbody>
                </table>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>
        </div>
    </div>
    <div class="sixteen wide tablet sixteen wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                Hôm nay: <?php echo e($days); ?> - Trong tuần: <?php echo e($weekend); ?> - Trong Tháng: <?php echo e($month); ?>

            </div>
            <div class="ui segment">
                <canvas id="myChart" data-order="<?php echo e($tkday); ?>" width="1200" height="370"></canvas>
            </div>

        </div>
    </div>
    <div class="sixteen wide tablet five wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                Thống kê số lượng học viên từng năm                
            </div>
            <div class="ui segment">
                <canvas id="hvChartYear" data-order="<?php echo e($tkyear); ?>" width="400" height="370"></canvas>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>

        </div>
    </div>
    <div class="sixteen wide tablet six wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                Thống kê tình trạng học viên
            </div>
            <div class="ui segment">
                <canvas id="dhChart" data-order="<?php echo e(json_encode($tinhtranghv)); ?>" width="400" height="300"></canvas>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>

        </div>
    </div>
    
    

    

</div>

<script type="text/javascript">

$(document).ready(function(){

    $.ajax({
        url: "/thongke/dayly",
        type: 'GET',
        data: { begin: '2019/6/3',end: '2019/6/4' },
        success: function(data){
            //console.log(data);
        }
    });

    var order = $('#myChart').data('order');
    var listOfValue = [];
    var listOfDay = [];
    order.forEach(function(element){
        listOfDay.push(element.getDay);
        listOfValue.push(element.value);
    });    
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx,
    {
       type: 'bar',
        data: {
            labels: listOfDay,
            datasets: [{
                label: "Số lượng truy cập tháng ",
				backgroundColor: 'rgba(255, 206, 86, 1)',
                borderColor: 'rgb(255, 89, 120)',
                data: listOfValue,
            }]
        },
        options: {}
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    var order = $('#hvChartYear').data('order');
    var listOfValue = [];
    var listOfYear = [];
    order.forEach(function(element){
        listOfYear.push(element.getYear);
        listOfValue.push(element.value);
    });    
    var ctx = document.getElementById('hvChartYear').getContext('2d');
    var chart = new Chart(ctx,
    {
        type: 'bar',
        data: {
            labels: listOfYear,
            datasets: [{
                label: "Số học viên",
                backgroundColor: 'rgba(255, 206, 86, 1)',
                borderColor: 'rgba(255, 206, 86, 1)',
                data: listOfValue ,
            }]
        },
        options: {}
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var order = $('#hvChartMonth').data('order');
    var listOfValue = [];
    var listOfMonth = [];
    order.forEach(function(element){
        listOfMonth.push('Tháng '+element.getMonth);
        listOfValue.push(element.value);
    });    
    var ctx = document.getElementById('hvChartMonth').getContext('2d');
    var chart = new Chart(ctx,
    {
        type: 'bar',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7","Tháng 8","Tháng 9", "Tháng 10","Tháng 11","Tháng 12"],
            datasets: [{
                label: "Số học viên",
                backgroundColor: 'rgba(255, 106, 86, 1)',
                borderColor: 'rgba(255, 206, 86, 1)',
                data: listOfValue ,
            }]
        },
        options: {}
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var orderdh = $('#dhChart').data('order');
    console.log(orderdh);
    var ctx = document.getElementById('dhChart').getContext('2d');
    var chart = new Chart(ctx,
    {
        type: 'doughnut',
        data: {
            labels: [
                    'Mới đăng ký',
                    'Đậu phỏng vấn',
                    'Đã xuất cảnh',
                    'Dự bị'

                ],
            datasets: [{
                data: orderdh,
                backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(223, 28, 86, 1)'
                ],
            }]
        },
        options: {}
    });
});
</script>

<script type="text/javascript">
    $('i.refresh').click(function() {
        $(this).addClass('loading');
        location.reload();
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>