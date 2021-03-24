@extends('admin.master')
@section('title', 'Home')
@section('PageContent')

<div class="ui four column grid">
    <div class="sixteen wide mobile eight wide tablet four wide computer column">
        <div class="ui horizontal segments">
            <div class="ui inverted teal segment center aligned">
                <div class="ui inverted  statistic">
                    <div class="value counter">
                        {{count($nhanvien)}}
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
                        {{count($hocvien)}}
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
                        {{count($giaovien)}}
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
                        {{count($dadinhat)}}
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
    <div class="sixteen wide tablet nine wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                Thống kê số lượng học viên trong năm {{date('Y')}}               
            </div>
            <div class="ui segment">
                <canvas id="hvChartMonth" data-order="{{ $tkmonth }}" width="800" height="490"></canvas>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>

        </div>
    </div>
	<div class="sixteen wide tablet seven wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                    Lịch sử truy cập
            </div>
            <div class="ui segment left aligned">
                <table id="data-table" class="ui very basic center aligned  celled table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Họ tên</th>
                            <th>Thời gian</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($history as $key => $ls)  
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$ls->id_user}}</td>
                            <td>{{date('H:i:s d/m/Y',$ls->tm)}}</td>
                            <td><a class="ui blue mini basic label">{{$ls->ip}}</a></td>
                        </tr>
                      @endforeach  
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
                Hôm nay: {{$days}} - Trong tuần: {{$weekend}} - Trong Tháng: {{$month}}
            </div>
            <div class="ui segment">
                <canvas id="myChart" data-order="{{ $tkday }}" width="1200" height="370"></canvas>
            </div>

        </div>
    </div>
    <div class="sixteen wide tablet five wide computer column">
        <div class="ui segments">
            <div class="ui segment">
                Thống kê số lượng học viên từng năm                
            </div>
            <div class="ui segment">
                <canvas id="hvChartYear" data-order="{{ $tkyear }}" width="400" height="370"></canvas>
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
                <canvas id="dhChart" data-order="{{json_encode($tinhtranghv)}}" width="400" height="300"></canvas>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>

        </div>
    </div>
    
    

    {{-- <div class="sixteen wide tablet eight wide computer column">
        <div class="ui segments">
            <div class="ui segment no-padding-bottom">
                <h5 class="ui left floated header">
                    Danh sách học viên phỏng vấn
                </h5>
                <h5 class="ui right floated header">
                    <i class="refresh link  mini icon"></i>
                </h5>
                <div class="clearfix"></div>
            </div>
            <div class="ui segment">
                <div class="ui middle aligned list">
                    <div class="item"></div>
                    @foreach($hocvien as $hv)
                    <div class="item">
                        <div class="right floated content">
                            <div class="ui button">
							 @switch($hv->tinhtrang)
								  @case(1)
									  Mới đăng ký
									  @break
								  @case(2)
									  Đậu phỏng vấn
									  @break
								  @case(3)
									  Dự bị
									  @break
								  @case(4)
									  Rớt phỏng vấn
									  @break
								  @case(5)
									  Đã xuất cảnh
									  @break            
								  @default
									  Đã hũy
							  @endswitch              
                            </div>
                        </div>
                        <img class="ui avatar image" src="{{$hv->hinhanh}}">
                        <div class="content">
                            {{$hv->hoten}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui two column grid">
    
    <div class="sixteen wide tablet eight wide computer column">
        <div class="ui segments">
            <div class="ui segment no-padding-bottom">
                <h5 class="ui left floated header">
                    Đơn hàng trong tháng
                </h5>
                <h5 class="ui right floated header">
                    <i class="refresh link  mini icon"></i>
                </h5>
                <div class="clearfix"></div>
            </div>
            <div class="ui segment">
                <table class="ui very basic center aligned  celled table">
                    <thead>
                      <tr><th>MÃ ĐƠN HÀNG</th>
                      <th>TÊN CÔNG TY</th>
                      <th>SỐ LƯỢNG TUYỂN</th>
                    </tr></thead>
                    <tbody>
                    @foreach($donhang as $dh)
                            
                      <tr>

                        <td>DH-0{{$dh->id}}</td>
                        <td>
                            @foreach($doitac as $dt)
                                    @if($dh->doitac_id == $dt->id)
                                        {{$dt->tencongty}}
                                    @endif
                                @endforeach
                        </td>
                        <td>{{$dh->soluongtuyen}}</td>
                      </tr>
                     @endforeach 
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="sixteen wide tablet eight wide computer column">
        <div class="ui segments">
            <div class="ui segment no-padding-bottom">
                <h5 class="ui left floated header">
                    Danh sách giáo viên
                </h5>
                <h5 class="ui right floated header">
                    <i class="refresh link  mini icon"></i>
                </h5>
                <div class="clearfix"></div>
            </div>
            <div class="ui segment">
                <div class="ui middle aligned list">
                    <div class="item"></div>
                    @foreach($giaovien as $gv)
                    <div class="item">
                        <div class="right floated content">
                            <div class="ui button">
							{{$gv->sodienthoai}}    
                            </div>
                        </div>
                        <img class="ui avatar image" src="{{$gv->hinhanh}}">
                        <div class="content">
                            {{$gv->hoten}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="ui inverted dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
            </div>

        </div>
    </div> --}}

</div>

<script type="text/javascript">
function getDaysOfMonth(year, month) { 
    return new Date(year, month, 0).getDate(); 
}; 

$(document).ready(function(){
    var now = new Date();
    var y = now.getFullYear();
    var m =  now.getMonth() + 1;
    var listDay = [];
    for(var i = 1 ; i <= getDaysOfMonth(y,m); i++){
        listDay.push(i);
    }
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
            labels: listDay,
            datasets: [{
                label: "Số lượng truy cập tháng "+m,
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
    var ctx = document.getElementById('hvChart').getContext('2d');
    var chart = new Chart(ctx,
    {
        type: 'bar',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7"],
            datasets: [{
                label: "Số học viên",
                backgroundColor: 'rgba(255, 206, 86, 1)',
                borderColor: 'rgba(255, 206, 86, 1)',
                data: [50, 10, 30, 80, 120, 30, 250] ,
            }]
        },
        options: {}
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

var table = $('#data-table').DataTable( {
        stateSave: true,
        processing: true,       
    });
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

@endsection