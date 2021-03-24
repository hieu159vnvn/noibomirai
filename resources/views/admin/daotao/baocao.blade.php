@extends('admin.master')
@section('title', 'Đào Tạo - Báo cáo ')
@section('PageContent')

@php
    function newformat($datatime){
        $time = strtotime($datatime);
        $newformat = date('d-m-Y',$time);
        return $newformat;
    }
@endphp
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
    /*table {
        position: relative;
    }
    th {
        position: sticky;
        top: 0;
    } */
    #daotaostyle .ui.mini.input {
        width: 100%;
    }
</style>
@if (session('status'))
    <div class="ui message blue">
        <i class="close icon"></i>
        <div class="header"> Thông Báo !</div>
        <p>{{ session('status') }}</p>
    </div>
@endif
@if (!$dataedit || ($dataedit == null))
<form class="ui form" action="" method="post">
    {{ csrf_field() }}
    <div style="overflow-x:auto;">
        <table id="daotaostyle" style="width: 100%;">
            <thead>
                <tr class="red">
                    <th colspan="14">府中硝子トーヨー住器株式会社</th>
                </tr>
                <tr class="red">
                    <th rowspan="2" style="min-width:50px;">順番 </td>
                    <th rowspan="2" style="min-width: 170px;">氏名 <br></th>
                    <th rowspan="2" style="min-width: 100px;">性別 <br></th>
                    <th rowspan="2" style="min-width: 100px;">生年月日 <br></th>
                    <th colspan="3">出欠席 <br> </th>
                    <th rowspan="2" style="min-width: 150px;" >レベル <br></th>
                    <th style="min-width: 70px;">文法 語彙 <br></th>
                    <th style="min-width: 70px;">聴解 <br></th>
                    <th style="min-width: 70px;">会話 <br></th>
                    <th rowspan="2">平均 点 <br> </th>
                    <th rowspan="2">成績評価 <br> </th>
                    <th rowspan="2" style="min-width: 200px;">コメント <br> </th>
                </tr>
                <tr class="red">
                    <th style="min-width: 50px;">出席 <br> </th>
                    <th style="min-width: 50px;">欠席 <br> </th>
                    <th style="min-width: 50px;">(Trể)</th>
                    <th>100点 <br> 満点</th>
                    <th>100点 <br> 満点</th>
                    <th>100点 <br> 満点</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                <input type="hidden" name="id_hocvien[]" value="{{$item->id_hocvien}}">
                <input type="hidden" name="co_mat[]" value="{{$item->comat}}">
                <input type="hidden" name="vang[]" value="{{$item->vangmat - $item->tre}}">
                <input type="hidden" name="tre[]" value="{{$item->tre}}">
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->hoten}}</td>
                    <td> @if ($item->gioitinh == 1) nam @else nữ @endif </td>
                    <td>{{newformat($item->ngaysinh)}}</td>
                    <td>{{$item->comat}}</td>
                    <td>{{$item->vangmat - $item->tre}}</td>
                    <td>{{$item->tre}}</td>
                    <td>
                        <div class="ui mini input">
                            <input type="text" name="bai_hoc[]" value="" placeholder="Bài học">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="ngu_phap[]" value="" placeholder="Ngữ pháp & ...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="nghe[]" placeholder="Nghe...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="noi[]" placeholder="nói...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="diem_trung_binh[]" placeholder="Điểm trung bình...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="diem_danh_gia[]" placeholder="Điểm đánh giá...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <textarea name="danh_gia[]" rows="1" placeholder="Đánh giá..."></textarea>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($data->count() > 0)
        <div class="ui grid" style="margin-top: 10px">
            <div class="four column row">
                <div class="right floated column" style="margin-top: 10px;">
                    <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
                </div> 
            </div>
        </div>
    @else     
        <div class="ui grid" style="margin-top: 10px">
            <div class="four column row">
                <div class="right floated column" style="margin-top: 10px;">
                    <a href="/daotao/manage-baocao/all" class="ui button blue btn-align-right">(Về trang quản lý báo cáo)</a>
                </div> 
            </div>
        </div>
    @endif
    
</form>
@else
<form class="ui form" action="" method="post">
    {{ csrf_field() }}
    <div style="overflow-x:auto;">
        <table id="daotaostyle" style="width: 100%;">
            <thead>
                <tr class="red">
                    <th colspan="14">府中硝子トーヨー住器株式会社</th>
                </tr>
                <tr class="red">
                    <th rowspan="2" style="min-width:50px;">順番 <br></td>
                    <th rowspan="2" style="min-width: 170px;">氏名 <br></th>
                    <th rowspan="2" style="min-width: 100px;">性別 <br></th>
                    <th rowspan="2" style="min-width: 100px;">生年月日 <br></th>
                    <th colspan="3">出欠席 <br> </th>
                    <th rowspan="2" style="min-width: 150px;" >レベル <br> </th>
                    <th style="min-width: 70px;">文法 語彙 <br> </th>
                    <th style="min-width: 70px;">聴解 <br> </th>
                    <th style="min-width: 70px;">会話 <br> </th>
                    <th rowspan="2">平均 点 <br> </th>
                    <th rowspan="2">成績評価 <br> </th>
                    <th rowspan="2" style="min-width: 200px;">コメント <br> </th>
                </tr>
                <tr class="red">
                    <th style="min-width: 50px;">出席 <br> </th>
                    <th style="min-width: 50px;">欠席 <br> </th>
                    <th style="min-width: 50px;">(Trể)</th>
                    <th>100点 <br> 満点</th>
                    <th>100点 <br> 満点</th>
                    <th>100点 <br> 満点</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataedit as $key => $item)
                <input type="hidden" name="id_hocvien[]" value="{{$item->id_hocvien}}">
                <input type="hidden" name="co_mat[]" value="{{$item->co_mat}}">
                <input type="hidden" name="vang[]" value="{{$item->vang}}">
                <input type="hidden" name="tre[]" value="{{$item->tre}}">
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$item->hoten}}</td>
                    <td> @if ($item->gioitinh == 1) nam @else nữ @endif </td>
                    <td>{{newformat($item->ngaysinh)}}</td>
                    <td>{{$item->co_mat}}</td>
                    <td>{{$item->vang}}</td>
                    <td>{{$item->tre}}</td>
                    <td>
                        <div class="ui mini input">
                            <input type="text" name="bai_hoc[]" value="{{$item->bai_hoc}}" placeholder="Bài học">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="ngu_phap[]" value="{{$item->ngu_phap}}" placeholder="Ngữ pháp & ...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="nghe[]" value="{{$item->nghe}}" placeholder="Nghe...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="noi[]" value="{{$item->noi}}" placeholder="nói...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="diem_trung_binh[]" value="{{$item->diem_trung_binh}}" placeholder="Điểm trung bình...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <input style="width: 60px;" type="text" name="diem_danh_gia[]" value="{{$item->diem_danh_gia}}" placeholder="Điểm đánh giá...">
                        </div>
                    </td>
                    <td>
                        <div class="ui mini input">
                            <textarea name="danh_gia[]" rows="1" placeholder="Đánh giá...">{{$item->danh_gia}}</textarea>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($dataedit->count() > 0)
    <div class="ui grid">
        <div class="four column row">
            <div class="right floated column" style="margin-top: 10px;">
                <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Cập Nhật</button>
            </div> 
        </div>
    </div>
    @endif
</form>
@endif

@endsection