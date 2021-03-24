@extends('admin.master')
@section('title', 'Đào Tạo - Báo cáo ')
@section('PageContent')
    @php
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
    @endphp

    @if (session('status'))
        <div class="ui message blue">
            <i class="close icon"></i>
            <div class="header"> Thông Báo !</div>
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <h2 class="ui header center aligned">
        QUẢN LÝ BÁO CÁO
        <div class="sub header">
            Tháng báo cáo. ({{newformat($date)}})
        </div>
    </h2>
    <form class="ui form" action="" method="post" autocomplete="off">
        {{ csrf_field() }}	
        <div class="ui segments">
            <div class="ui segment">
                <div style="font-size: 20px !important; padding: 10px 0px;">Tháng báo cáo</div>
                <input type="hidden" id="month-hidden" value="{{$month}}">
                <select class="ui dropdown" name="month" id="month">
                    <option value="">Tháng</option>
                    @for ($i = 1; $i <= 12 ; $i++)
                        <option @if ($i == $month) selected @endif value="{{$i}}">Tháng {{$i}}</option>
                    @endfor
                </select>
                <input type="hidden" id="year-hidden" value="{{$year}}">
                <select class="ui dropdown" name="year" id="year">
                    <option value="">Year</option>
                    @for ($i = -2; $i < 1; $i++)
                        <option @if (($year+$i) == $year) selected @endif value="{{$year+$i}}">{{$year+$i}}</option>
                    @endfor
                </select>
                <div style="font-size: 20px !important; padding: 10px 0px;">Thời hạn báo cáo</div>
                <span class="ui calendar" id="date-only-from">
                    <label>TỪ NGÀY:</label>
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="tgbd" value="{{$checkdate ? $checkdate->tgbd : date("Y-m-d")}}">
                    </div>
                </span>
                <span class="ui calendar" id="date-only-to">
                    <label>ĐẾN NGÀY:</label>
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="tgkt" value="{{$checkdate ? $checkdate->tgkt : date("Y-m-d")}}">
                    </div>
                </span>

                <div class="ui toggle checkbox">
                    <input type="checkbox" name="duyet" @if ((isset($checkdate->duyet) && $checkdate->duyet == 1)) checked @endif >
                    <label>Thời gian có hiệu lực</label>
                </div>
            </div>
            @if (Auth::user()->hasRole('Đào Tạo'))
                <button type="submit" class="ui labeled icon button green"><i class="save icon"></i> Tạo hoặc cập nhật báo cáo</button>
            @endif
        </div>
        
            
    </form>
        {{-- dang lam --}}
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
                    @foreach($daotao as $key => $dt)
                        <tr style="text-align: left;">
                            <td>
                                {{$dt->hoten}}
                            </td>									
                            <td> Lớp {{$dt->ten_lop_hoc}} </td>
                            <td>
                                <div class="item">
                                    @if (Auth::user()->hasRole('Đào Tạo'))
                                        @if ($dt->checkbaocao == 0 )
                                            <div class="mini ui icon red button baocao" attrid="{{$dt->id}}"><i class="check icon"></i> Chưa Báo cáo</div>
                                        @else
                                            <div class="mini ui icon blue button baocao" attrid="{{$dt->id}}"><i class="check icon"></i> Đã Báo cáo </div>
                                        @endif													
                                    @else
                                        @if ($dt->checkbaocao == 0 )
                                            <div class="mini ui icon red button baocao" attrid="{{$dt->id}}"><i class="check icon"></i> Chưa Báo cáo</div>
                                        @else
                                            <div class="mini ui icon blue button baocao" attrid="{{$dt->id}}"><i class="check icon"></i> Đã Báo cáo </div>
                                        @endif	
                                    @endif
                                </div>	
                            </td>
                            <td> 
                                <div class="item">
                                    @if (Auth::user()->hasRole('Đào Tạo'))
                                        <div class="mini ui icon blue button xem" attrid="{{$dt->id}}"><i class="check icon"></i> Xem</div>
                                    @else
                                        <div class="mini ui icon button @if($dt->id == $iddaotao) blue  xem @else red @endif " attrid="{{$dt->id}}"><i class="check icon"></i> Xem</div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="column">
            <br/>
            <hr/>	
        </div>

    

@endsection
@section('JsLibraries')
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
@endsection