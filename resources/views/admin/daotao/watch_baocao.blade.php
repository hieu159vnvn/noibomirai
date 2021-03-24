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
</style>
@if (session('status'))
    <div class="ui message blue">
        <i class="close icon"></i>
        <div class="header"> Thông Báo !</div>
        <p>{{ session('status') }}</p>
    </div>
@endif
@if (!$dataedit || ($dataedit == null))
<div class="ui">Chưa có dữ liệu</div>
@else
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
</form>
@endif

@endsection