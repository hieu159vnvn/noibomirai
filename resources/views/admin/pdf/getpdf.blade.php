@extends('admin.master')
@section('title', 'Thêm Học Viên Mới')
@section('PageContent')
<head>
  <title>SƠ YẾU LÝ LỊCH</title>

</head>

<body>

  <div class="ui two column centered grid wrap-content-header">
    <h1 class="ui header centered page-title">SƠ YẾU LÝ LỊCH</h1>
  </div>
  <div class="ui top attached tabular menu">
        <a class="item active" data-tab="tiengviet">Tiếng Việt</a>
        <a class="item" data-tab="tiengnhat">Tiếng Nhật</a>
  </div>
{{-- TIENG VIET --}}
    <div class="ui bottom attached tab segment active" data-tab="tiengviet">
        <article id="Content_ID">
        <style type="text/css"> 
          table {
            -webkit-print-color-adjust: exact;
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
          p {margin: 2px;}
        </style>
        @foreach($hoso as $hs)
        
        <table width="794" cellspacing="0" border="1" style="border: 2px solid black">
          <tr class="logo-form">
            <td colspan="26" style="  border: none;border-bottom: 1px solid" >
                <span class="span-logo"><img src="logo.png" width="50" ></span>
                <h2>MIRAI HUMAN</h2>
            </td>
            <td colspan="5" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
                <img src="avatar.png" width="90%">
            </td>
          </tr>
          
          <tr>
            <td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">SƠ YẾU LÝ LỊCH</td>
          </tr>
          
          <tr>
            <td colspan="4" rowspan="2" style="border-left: none;">HỌ TÊN</td>
            <td colspan="14" rowspan="2" style="font-size:24px;font-weight:bold;">{{$hs->id}}</td>
            <td colspan="3">ĐIỆN THOẠI</td>
            <td colspan="5">0901234456</td>
          </tr>
          <tr>
            <td colspan="3">ĐT NGƯỜI THÂN</td>
            <td colspan="5">0901234456</td>
          </tr>
          <tr>
            <td colspan="4" style="border-left: none;">NGÀY SINH</td>
            <td colspan="10">01/01/1990</td>
            <td colspan="2">TUỔI</td>
            <td colspan="2">27</td>
            <td colspan="2" rowspan="2">TAY THUẬN </td>
            <td colspan="2">CÔNG VIỆC</td>
            <td style="min-width: 50px">P</td>
            <td colspan="2" style="min-width: 50px">ĐŨA</td>
            <td style="min-width: 50px">P</td>
          </tr>
          <tr>
            <td colspan="4" style="border-left: none;">GIỚI TÍNH</td>
            <td colspan="10">NAM</td>
            <td colspan="2" rowspan="3">TÔN GIÁO</td>
            <td colspan="2" rowspan="3">
                KHÔNG/<br />
                PHẬT/<br />
                THIÊN CHÚA
            </td>
            <td colspan="2" style="min-width: 50px">KÉO</td>
            <td style="min-width: 50px">P</td>
            <td colspan="2">VIẾT</td>
            <td style="min-width: 50px">P</td>
          </tr>
          <tr>
            <td colspan="4" style="border-left: none;">HÔN NHÂN</td>
            <td colspan="10">KHÔNG</td>
            <td colspan="4">CHIỀU CAO</td>
            <td colspan="3">170</td>
            <td colspan="3">CÂN NẶNG</td>
            <td colspan="3">60</td>
          </tr>
          <tr>
            <td colspan="4" style="border-left: none;">BỆNH ÁN</td>
            <td colspan="10">KHÔNG</td>
            <td colspan="4">NHÓM MÁU</td>
            <td colspan="9">A</td>
          </tr>
          <tr >
            <td colspan="4" style="border-bottom: 1px solid; border-left: none;">NƠI SINH</td>
            <td colspan="10" style="border-bottom: 1px solid">BẾN TRE</td>
            <td colspan="2" style="border-bottom: 1px solid">MIỀN</td>
            <td colspan="2" style="border-bottom: 1px solid">NAM</td>
            <td colspan="2" style="border-bottom: 1px solid">THỊ LỰC</td>
            <td colspan="3" style="border-bottom: 1px solid">TRÁI</td>
            <td colspan="3" style="border-bottom: 1px solid">10/10</td>
            <td colspan="3" style="border-bottom: 1px solid">PHẢI</td>
            <td colspan="2" style="border-bottom: 1px solid">10/10</td>
          </tr>
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
          </tr>
            <tr>
              <td colspan="6" style="border-bottom: 1px solid; border-top: 1px solid; border-left: none;">ĐỊA CHỈ HỘ KHẨU</td>
              <td colspan="20" style="border-bottom: 1px solid; border-top: 1px solid">120 -  MỎ CÀY BẾN TRE</td>
              <td colspan="3" style="border-bottom: 1px solid; border-top: 1px solid">MIỀN</td>
              <td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid">NAM</td>
            </tr>
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
          </tr>
            <tr>
                <td colspan="4" rowspan="6" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid; border-top: 1px solid; border-left: none;">QUÁ TRÌNH HỌC TẬP</td>
                <td colspan="11" style="border-top: 1px solid;">THỜI GIAN HỌC</td>
                <td colspan="11" style="border-top: 1px solid;">TÊN TRƯỜNG</td>
                <td colspan="5" style="border-top: 1px solid;">ĐỊA CHỈ TRƯỜNG</td>
            </tr>
          <tr>
            <td colspan="5">1996</td>
            <td style="border-left: none;">~</td>
            <td colspan="5" style="border-left: none;">2001</td>
            <td colspan="11">TRƯỜNG TIỂU HỌC NGUYỄN VĂN A</td>
            <td colspan="5">BẾN TRE</td>
          </tr>
          <tr>
            <td colspan="5">1996</td>
            <td style="border-left: none;">~</td>
            <td colspan="5" style="border-left: none;">2001</td>
            <td colspan="11">TRƯỜNG TIỂU HỌC NGUYỄN VĂN A</td>
            <td colspan="5">BẾN TRE</td>
          </tr>
          <tr>
            <td colspan="5">1996</td>
            <td style="border-left: none;">~</td>
            <td colspan="5" style="border-left: none;">2001</td>
            <td colspan="11">TRƯỜNG TIỂU HỌC NGUYỄN VĂN A</td>
            <td colspan="5">BẾN TRE</td>
          </tr>
          <tr>
            <td colspan="5">1996</td>
            <td style="border-left: none;">~</td>
            <td colspan="5" style="border-left: none;">2001</td>
            <td colspan="11">TRƯỜNG TIỂU HỌC NGUYỄN VĂN A</td>
            <td colspan="5">HỒ CHÍ MINH</td>
          </tr>
          <tr>
            <td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
            <td style="border-bottom: 1px solid;border-left: none;">&nbsp;</td>
            <td colspan="5" style="border-bottom: 1px solid;border-left: none;">&nbsp;</td>
            <td colspan="11" style="border-bottom: 1px solid;">&nbsp;</td>
            <td colspan="5"style="border-bottom: 1px solid;">&nbsp;</td>
          </tr>
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
          </tr>
            <tr>
              <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid; border-top: 1px solid; border-left: none;">QUÁ TRÌNH LÀM VIỆC</td>
            <td colspan="11" style="border-top: 1px solid;">THỜI GIAN LÀM VIỆC</td>
            <td colspan="11" style="border-top: 1px solid;">TÊN CÔNG TY</td>
            <td colspan="5" style="border-top: 1px solid;">NỘI DUNG CÔNG VIỆC</td>
          </tr>
          <tr>
            <td colspan="5">2012</td>
            <td style="border-left: none;">~</td>
            <td colspan="5" style="border-left: none;">2017</td>
            <td colspan="11">CÔNG TY TNHH ABC</td>
            <td colspan="5">NHÂN VIÊN BÁN HÀNG</td>
          </tr>
          <tr>
            <td colspan="5">&nbsp;</td>
            <td style="border-left: none;">&nbsp;</td>
            <td colspan="5" style="border-left: none;">&nbsp;</td>
            <td colspan="11">&nbsp;</td>
            <td colspan="5">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
            <td style="border-bottom: 1px solid;border-left: none;">&nbsp;</td>
            <td colspan="5" style="border-bottom: 1px solid;border-left: none;">&nbsp;</td>
            <td colspan="11" style="border-bottom: 1px solid;">&nbsp;</td>
            <td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
          </tr>
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
          </tr>
            <tr>
              <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">NGOẠI NGỮ</td>
            <td colspan="3" style="border-top: 1px solid;">ANH NGỮ</td>
            <td colspan="11" style="border-top: 1px solid;">KHÔNG/ CÓ BẰNG A</td>
            <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">ĐÃ TỪNG TỚI NHẬT</td>
            <td colspan="6" style="border-top: 1px solid;"><span style="border: 1px solid black; border-radius: 50px; padding:6px 9px;">CÓ</span> &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; <span>KHÔNG</span></td>
          </tr>
          <tr>
            <td colspan="3" rowspan="2">ANH NGỮ</td>
            <td colspan="11" rowspan="2">KHÔNG/ CÓ BẰNG A</td>
            <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">CÓ NGƯỜI THÂN TẠI NHẬT</td>
            <td colspan="6"><span >CÓ</span> &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; <span style="border: 1px solid black; border-radius: 50px; padding:6px 9px;">KHÔNG</span></td>
          </tr>
          <tr>
            <td>TÊN:</td>
            <td colspan="5">&nbsp;</td>
            <td>TUỔI:</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">QUAN HỆ: </td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" style="border-bottom: 1px solid;">KHÁC</td>
            <td colspan="11" style="border-bottom: 1px solid;">KHÔNG/ CÓ BẰNG A</td>
            <td style="border-bottom: 1px solid;">TÊN:</td>
            <td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
            <td style="border-bottom: 1px solid;">TUỔI:</td>
            <td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
            <td colspan="2" style="border-bottom: 1px solid;">QUAN HỆ: </td>
            <td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
          </tr>
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
          </tr>
          <tr>
            <td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">THỰC TẬP KỸ NĂNG Ở NHẬT</td>
          </tr>
          <tr>
            <td colspan="10" style="border-left: none;">MỤC ĐÍCH ĐI NHẬT</td>
            <td colspan="21">KIẾM TIỀN, PHỤ GIA ĐÌNH,/ HỌC TIẾNG NHẬT/ HỌC KINH NGHIỆM LÀM VIỆC/ HỌC CÁCH LÀM VIỆC CỦA NGƯỜI NHẬT/ HỌC TÁC PHONG/VĂN HÓA CỦA NGƯỜI NHẬT…</td>
          </tr>
          <tr>
            <td colspan="10" style="border-left: none;">SỐ TIỀN DỰ ĐỊNH TIẾT KIỆM MỖI THÁNG TẠI NHẬT</td>
            <td colspan="6">12tr/13tr/14tr/15tr</td>
            <td colspan="9">SỔ TIỀN DỰ ĐỊNH TIẾT KIỆM SAU 3 NĂM TẠI NHẬT</td>
            <td colspan="6">400tr/450tr/500tr</td>
          </tr>
          <tr>
            <td colspan="10" style="border-bottom: 1px solid; border-left: none;">MỤC TIÊU SAU KHI VỀ NƯỚC</td>
            <td colspan="21" style="text-align: left;border-bottom: 1px solid">
                <p>&#10003; TẬN DỤNG KINH NGHIỆM LÀM VIỆC Ở NHẬT VỀ LÀM QUẢN LÝ CHO CTY NHẬT Ở VIỆT NAM.</p>
                <p>&#10003; LẤY BẰNG TIẾNG NHẬT N2, LÀM VIỆC CHO CTY NHẬT VỚI VỊ TRÍ THÔNG DỊC</p>
                <p>&#10003; LẤY BẰNG TIẾNG NHẬT N3 (N2), TRỞ THÀNH GIÁO VIÊN TIẾNG NHẬT.</p>
                <p>&#10003; LẤY BẰNG TIẾNG NHẬT N3 (N2), TRỞ THÀNH GIÁO VIÊN TIẾNG NHẬT.</p>
                <p>&#10003; SỬ DỤNG SỐ TIỀN TIẾT KIỆM ĐỂ TỰ MỞ XƯỞNG CƠ KHÍ (MỞ QUÁN ĂN, MỞ TIỆM BÁN VẬT LIỆU XÂY DỰNG, MỞ TIỆM BÁN PHỤ TÙNG CỦA NHẬT…)</p>
            </td>
          </tr>
          
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none;border-left: none;"></td>
          </tr>
            <tr>
            <td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;border-left: none;">KHÁC</td>
          </tr>
          <tr>
            <td colspan="4" style="border-left: none;">BẰNG LÁI</td>
            <td colspan="6"><span style="border: 1px solid black; border-radius: 50px; padding:6px 9px;">CÓ</span> &ensp;&ensp;&ensp;-&ensp;&ensp;&ensp; <span>KHÔNG</span></td>
            <td colspan="2"> LOẠI XE </td>
            <td colspan="19" style="text-align: left;">
                <!-- Symbols &#9745; &#9744; -->
                &nbsp; &#9745; XE MÁY 
                &nbsp; &#9744; Ô TÔ
                &nbsp; &#9744; &ensp; KHÁC (&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;)
            </td>
          </tr>
          <tr>
            <td colspan="4" style="border-bottom: 1px solid; border-left: none;">SỞ THÍCH</td>
            <td colspan="12" style="border-bottom: 1px solid">ĐỌC SÁCH, NGHE NHẠC, XEM PHIM, ĐÁ BANH, CẦU LÔNG, BƠI LỘI…</td>
            <td colspan="4" style="border-bottom: 1px solid">ĐIỂM MẠNH</td>
            <td colspan="11" style="border-bottom: 1px solid">SIÊNG NĂNG, HÒA ĐỒNG, CÓ TRÁCH NHIỆM, NHIỆT TÌNH, KIÊN TRÌ, KIÊN NHẪN, TÍCH CỰC…</td>
            </tr>
          <tr style="height:5px;">
              <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
          </tr>
          <tr>
            <td colspan="2" rowspan="5" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">GIA ĐÌNH</td>
            <td colspan="9" style="border-top: 1px solid; width: 300px">QUAN HỆ (Cha, Mẹ, Tất cả anh chị em ruột)</td>
            <td colspan="2" style="border-top: 1px solid">NĂM SINH</td>
            <td colspan="6" style="border-top: 1px solid">CÔNG VIỆC</td>
            <td colspan="6" style="border-top: 1px solid">NƠI LÀM VIỆC</td>
            <td colspan="6" style="border-top: 1px solid">THU NHẬP HÀNG THÁNG</td>
          </tr>
          <tr>
            <td colspan="3">BỐ</td>
            <td colspan="6">NGUYỄN VĂN HAI</td>
            <td colspan="2">1960</td>
            <td colspan="6">LÀM NÔNG</td>
            <td colspan="6">BẾN TRE</td>
            <td colspan="6">2.000.000</td>
          </tr>
          <tr>
            <td colspan="3">MẸ</td>
            <td colspan="6">NGUYỄN THỊ BA</td>
            <td colspan="2">1960</td>
            <td colspan="6"></td>
            <td colspan="6"></td>
            <td colspan="6">2.000.000</td>
          </tr>
          <tr>
            <td colspan="3">EM TRAI</td>
            <td colspan="6">NGUYỄN THỊ BA</td>
            <td colspan="2">1960</td>
            <td colspan="6"></td>
            <td colspan="6"></td>
            <td colspan="6">2.000.000</td>
          </tr>
          <tr>
            <td colspan="3">EM GÁI</td>
            <td colspan="6">NGUYỄN THỊ BA</td>
            <td colspan="2">1960</td>
            <td colspan="6">LÀM NÔNG</td>
            <td colspan="6">BẾN TRE</td>
            <td colspan="6">&nbsp;</td>
          </tr>
        </table>
        <table width="794" cellspacing="0" border="0" >
            <tr style="height:44px;">
                <td colspan="15" style="text-align: left; padding-left: 15px; border: none;">
                    Đăng ký ngày:..............................................
                </td>
                <td colspan="16" style="text-align: left; padding-left: 15px; border: none;">
                    Người phụ trách:...........................................
                    Người giới thiệu:..........................................
                </td>
          </tr>
        </table>
        <style>
          .page-break {
            page-break-after: always;
          }
        </style>
        <div class="page-break"></div>
        @endforeach
      </article>
    </div>
      <div class="actions">
          <div class="ui negative button">
            <i class="x icon"></i> Cancel
          </div>
          <a href="javascript:void(0)" onclick="In_Content('Content_ID')">
            <div class="ui blue icon button">
             <i class="print icon"></i> IN
            </div>
          </a>
        </div>

</body>
<script type="text/javascript">
  $('.menu .item').tab()
  ;
</script>
<script type="text/javascript">
function In_Content(strid){   
    var prtContent = document.getElementById(strid);
    var WinPrint = window.open('','','letf=0,top=0,width=794,height=auto');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
}
</script>
@endsection


