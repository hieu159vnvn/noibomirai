@extends('admin.master')
@section('title', 'Ghép Đơn Hàng')
@section('PageContent')
  <h2 class="ui header center aligned">
        THÔNG TIN ĐƠN HÀNG   
        <div class="sub header">
        </div>
  </h2>
  
 <div class="ui segments">
    <div class="ui segment">
        <div class="ui secondary menu">

            <div class="right menu">
              <a class="item">
                  <a class="ui labeled icon button bam-an-hien"><i class="save icon"></i>Ẩn Thông tin</a>
              </a>
              <a class="item">
                 <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('indonhang')"><i class="save icon"></i>IN ĐƠN HÀNG</a>
              </a>
            </div>
          </div>
    </div>
  <script type="text/javascript">
    $('.bam-an-hien').click(function(){
      $('.an-hien').toggle();
    });
  </script>
  <div class="ui segment">
    <div id="indonhang">
      <style type="text/css">
        body {
          @background: #555;
          -webkit-print-color-adjust:exact;
        }
        table{
            margin: auto;
          background-color: white;
        }
        tr td {
          font-family: "Times New Roman", Times, serif;
          font-size:12px;
          border-left:1px solid;
          border-top: 1px solid;
          border-bottom: none;
          border-right: none;
          border-color:#000000;
          padding: 2px;
          font-weight: 500;
        }
        .border-none td {
          border-left:none;
          border-top:none;
          padding: 0px;
        }
        p {
            padding: 0px;
            margin: 2px;
        }
          </style>
      <body>

      <table class="in" width="794" cellspacing="0"  >
        <tr class="border-none">
          <td style="width: 260px; text-align: center;"><img width="160" src="{{url('images/admin/logo.png')}}"></td>
          <td colspan="2" style="text-align: center;"><p><strong>CÔNG TY TNHH NHÂN LỰC MIRAI</strong></p>
          <p><strong>(MIRAI HUMAN RESOURCES CO.,LTD)</strong></p>
          <p>Trụ sở  chính: 26/4-26/5 Lê Thánh Tôn, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh</p>
          <p>Trung tâm đào tạo :  155 Trần Trọng Cung, P. Tân Thuận Đông , Quận 7,TPHCM</p>
          <p>(Trung tâm cách Khu chế xuất Tân Thuận 1Km-Khu Thương mại Nam Long)</p>
          <p>Điện thoại: 028. 66863208  ; Hotline: 0902.538.164 </p></td>
        </tr>
        
        <tr class="border-none">
          <td colspan="3" style="text-align: center; font-size: 34px;"><strong>THÔNG BÁO ĐƠN HÀNG - {{ $donhang->tendonhang }}</strong></td>
        </tr>
        <tr class="border-none">
          <td colspan="3" style="font-size: 26px;"><strong>1.Chi tiết tuyển dụng:</strong> </td>
        </tr>
        <tr style="height: 50px;">
          <td><strong> Tên công ty tiếp nhận</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;">
            <strong class="an-hien">@if($doitac){{$doitac->tencongty}} @endif</strong>
          </td>
        </tr>
        <tr>
          <td><strong> Địa chỉ</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;">
            {{$donhang->diachi}}
          </td>
        </tr>
        <tr>
          <td><strong> Công việc</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;">
            @if ($donhang->tieudethem)
              @if ($nganhnghe)
              {{$nganhnghe->nganhnghe_vn}} - {{$donhang->tieudethem}}
              @endif
            @else
              @if ($nganhnghe)
              {{$nganhnghe->nganhnghe_vn}} 
              @endif 
            @endif
          </td>
        </tr>
        <tr>
          <td><strong> Thời gian làm việc</strong></td>
          <td colspan="2" style="border-right: 1px solid;text-transform: uppercase;">{{ $donhang->thoigian }}</td>
        </tr>
        <tr>
          <td><strong> Lương cơ bản</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;">{{ $donhang->luongcoban }}</td>
        </tr>
        {{-- <tr>
          <td><strong> Các khoản khấu trừ</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;">Thuế: {{ $donhang->thue }} + Bảo hiểm: {{ $donhang->baohiem }} + Tiền nhà :{{ $donhang->tiennha }} </td>
        </tr> --}}
        <tr>
          <td><strong> Các khoản khấu trừ</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;"> {{ $donhang->khautru }} </td>
        </tr>
        <tr>
          <td><strong> Lương thực nhận sau khi trừ chi phí</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;">{{ $donhang->luongthuclanh }}</td>
        </tr>
    {{--    <tr>
          <td><strong> Kinh nghiệm</strong></td>
          <td colspan="2" style="border-right: 1px solid">{{ $donhang->trinhdo }}</td>
        </tr>
        <tr>
          <td><strong> Nhật Ngữ</strong></td>
          <td colspan="2" style="border-right: 1px solid">&nbsp;</td>
        </tr> --}}
        <tr>
          <td><strong> Ngày tuyển</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;"> Từ ngày: {{ $donhang->ngaytuyenbd }} - đến ngày: {{ $donhang->ngaytuyenkt }} </td>
        </tr>
        <tr>
          <td><strong> Số người cần tuyển</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;"> {{ $donhang->soluongtuyen }}</td>
        </tr>
        <tr>
          <td><strong> Dự kiến XC</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;"> {{ $donhang->dukienxc}}</td>
        </tr>
        <tr>
          <td><strong> Trình độ</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;"> {{ $donhang->trinhdo }}</td>
        </tr>
        <tr>
          <td><strong> Yêu cầu khác</strong></td>
          <td colspan="2" style="border-right: 1px solid; text-transform: uppercase;"> {{ $donhang->yeucau }}</td>
        </tr>
        <tr class="border-none">
          <td colspan="3" style="font-size: 26px;border-top: 1px solid; "><strong>2. Yêu cầu phối hợp: </strong> </td>
        </tr>
        <tr>
          <td style="text-align: center;"><strong> Chi tiết công việc</strong></td>
          <td style="text-align: center;"><strong> Thời hạn yêu cầu thực thi</strong></td>
          <td style="text-align: center; border-right: 1px solid"><strong> Bộ phận chịu trách nhiệm</strong></td>
        </tr>
        <tr>
          <td><strong> Tuyển dụng cung cấp Form + DS</strong></td>
          <td>&nbsp;</td>
          <td style="border-right: 1px solid">Ban tư vấn + tuyển dụng</td>
        </tr>
        <tr>
          <td><strong> Check nguồn (TTS & KS)</strong></td>
          <td>&nbsp;</td>
          <td style="border-right: 1px solid">Ban Giáo Dục và Ban đối ngoại</td>
        </tr>
        <tr>
          <td><strong> Hoàn thiện hồ sơ</strong></td>
          <td>&nbsp;</td>
          <td style="border-right: 1px solid">Ban tư vấn + tuyển dụng và Ban đối ngoại + Kế toán</td>
        </tr>
        <tr>
          <td><strong> Gửi Form cho đối tác Nhật</strong></td>
          <td>&nbsp;</td>
          <td style="border-right: 1px solid">Ban đối Ngoại</td>
        </tr>
        <tr>
          <td><strong> Ngày dự kiến thi tuyển</strong></td>
          <td colspan="2" style="border-right: 1px solid">&nbsp;</td>
        </tr>
        <tr>
          <td><strong> Nơi dự kiến thi tuyển</strong></td>
          <td colspan="2" style="border-right: 1px solid">&nbsp;</td>
        </tr>
        <tr>
          <td><strong> Hình thức dự tuyển</strong></td>
          <td colspan="2" style="border-right: 1px solid">&nbsp;</td>
        </tr>
        <tr>
          <td><strong> Vé bay</strong></td>
          <td>MIRAI phụ trách</td>
          <td style="border-right: 1px solid">Kế toán</td>
        </tr>
        <tr style="height: 50px">
          <td ><strong> Lưu ý</strong></td>
          <td colspan="2" style="border-right: 1px solid">&nbsp;</td>
        </tr>
        <tr >
          <td style="border-left: none;">&nbsp;</td>
          <td style="border-left: none;">&nbsp;</td>
          <td style="border-left: none;">&nbsp;</td>
        </tr>
        <tr class="border-none" style="vertical-align: top">
          <td style="text-align: center;"><strong> Phụ trách tuyển dụng</strong></td>
          <td style="text-align: center;"><strong> Trưởng phòng Nghiệp vụ</strong></td>
          <td style="text-align: center;">
            <strong>TL.Chủ tịch Công ty </strong>
            <br> 
            <strong> Giám đốc</strong>
          </td>
        </tr>
        <tr class="border-none">
          <td >&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="border-none">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="border-none">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="border-none">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="border-none">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="border-none">
          <td>&nbsp;</td>
          <td style="text-align: center;"><strong> </strong></td>
          <td style="text-align: center;"><strong> Mai Anh Tuấn</strong></td>
        </tr>
      </table>
      </body>
    </div>
  </div>
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
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/donhang/create_donhang.js')}}"></script>
@endsection