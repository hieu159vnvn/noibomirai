<style type="text/css">
  body {
    background: #555;
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

<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
  <tr class="logo-form">
    <td colspan="26" style="  border: none;border-bottom: 1px solid" >
        <span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
        <h2>MIRAI HUMAN</h2>
    </td>
    <td colspan="5" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
        <p style="text-align: left; font-weight: bold;"> 番号：{{$hoso->stt}}</p>
        <img src="{{$hoso->hinhanh}}" width="100%">
    </td>
  </tr>
  
  <tr>
    <td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">技能実習生履歴書</td>
  </tr>
  
  <tr>
    <td colspan="4" rowspan="2" style="border-left: none; width: 100px; ">氏名</td>
  <td colspan="3">英字表記</td>
    <td colspan="19" style="font-size:20px;font-weight:bold;">{{$hoso->hoten}}</td>
   
  </tr>
  <tr>
    <td colspan="3">フリガナ</td>
    <td colspan="19" style="font-size:20px;">{{$hoso->hoten_jp}}</td>
  </tr>
  <tr>
    <td colspan="4" style="border-left: none;">生年月日</td>
    <td colspan="10">{{$hoso->ngaysinh}}</td>
    <td colspan="2">年齢</td>
    <td colspan="2">{{getAge(date_format(date_create($hoso->ngaysinh),"Y/m/d"))}}</td>
    <td colspan="2" rowspan="2" style="width: 70px">利き手 </td>
    <td colspan="2">仕事</td>
    <td style="min-width: 50px">P</td>
    <td colspan="2" style="min-width: 50px">箸</td>
    <td style="min-width: 50px">P</td>
  </tr>
  <tr>
    <td colspan="4" style="border-left: none;">性別</td>
    <td colspan="10">男</td>
    <td colspan="2" rowspan="3">宗教</td>
    <td colspan="2" rowspan="3">
    KHÔNG/<br /></td>
    <td colspan="2" style="min-width: 50px">鋏</td>
    <td style="min-width: 50px">P</td>
    <td colspan="2">ペン</td>
    <td style="min-width: 50px">P</td>
  </tr>
  <tr>
    <td colspan="4" style="border-left: none;">婚姻</td>
    <td colspan="10">独身</td>
    <td colspan="4">身長（センチ)</td>
    <td colspan="3">170</td>
    <td colspan="3">体重（キロ)</td>
    <td colspan="3">60</td>
  </tr>
  <tr>
    <td colspan="4" style="border-left: none;">病暦</td>
    <td colspan="10">無</td>
    <td colspan="4">血液</td>
    <td colspan="9">A</td>
  </tr>
  <tr >
    <td colspan="4" style="border-bottom: 1px solid; border-left: none;">出身地</td>
    <td colspan="10" style="border-bottom: 1px solid">BẾN TRE</td>
    <td colspan="2" style="border-bottom: 1px solid">地方</td>
    <td colspan="2" style="border-bottom: 1px solid">南部</td>
    <td colspan="2" style="border-bottom: 1px solid">視カ</td>
    <td colspan="3" style="border-bottom: 1px solid">左</td>
    <td colspan="3" style="border-bottom: 1px solid">10/10</td>
    <td colspan="3" style="border-bottom: 1px solid">右</td>
    <td colspan="2" style="border-bottom: 1px solid">10/10</td>
  </tr>
<tr style="height:5px;">
    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
</tr>
  <tr>
    <td colspan="6" style="border-bottom: 1px solid; border-top: 1px solid; border-left: none;">戸籍住所</td>
    <td colspan="20" style="border-bottom: 1px solid; border-top: 1px solid">120 -  MỎ CÀY BẾN TRE</td>
    <td colspan="3" style="border-bottom: 1px solid; border-top: 1px solid">地方</td>
    <td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid">南部</td>
  </tr>
<tr style="height:5px;">
    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
</tr>
    <tr>
        <td colspan="4" rowspan="6" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid; border-top: 1px solid; border-left: none;">学 歴</td>
        <td colspan="11" style="border-top: 1px solid;">期 間</td>
        <td colspan="11" style="border-top: 1px solid;">学 校 名</td>
        <td colspan="5" style="border-top: 1px solid;">学 校 所 在 地</td>
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
    <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid; border-top: 1px solid; border-left: none;">職 歴</td>
    <td colspan="11" style="border-top: 1px solid;">期 間</td>
    <td colspan="11" style="border-top: 1px solid;">勤 務 先</td>
    <td colspan="5" style="border-top: 1px solid;">職 種</td>
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
    <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">外 国 語</td>
    <td colspan="3" style="border-top: 1px solid;">ANH NGỮ</td>
    <td colspan="11" style="border-top: 1px solid;">KHÔNG/ CÓ BẰNG A</td>
    <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">訪 日 経 験</td>
    <td colspan="6" style="border-top: 1px solid;"> 無 </td>
  </tr>
  <tr>
    <td colspan="3" rowspan="2">ANH NGỮ</td>
    <td colspan="11" rowspan="2">KHÔNG/ CÓ BẰNG A</td>
    <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">在日本親戚．知人</td>
    <td colspan="6"> 無 </td>
  </tr>
  <tr>
    <td style="border-top: 1px solid">氏名:</td>
    <td colspan="5">&nbsp;</td>
    <td>年齢:</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">続柄: </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom: 1px solid;">KHÁC</td>
    <td colspan="11" style="border-bottom: 1px solid;">KHÔNG/ CÓ BẰNG A</td>
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
    <td colspan="21">家族の経済環境を改善したり日本人の働き方や経験を見習ったりすること</td>
  </tr>
  <tr>
    <td colspan="10" style="border-left: none;">毎月の貯金</td>
    <td colspan="6">12tr/13tr/14tr/15tr</td>
    <td colspan="9">3年間の貯金</td>
    <td colspan="6">400tr/450tr/500tr</td>
  </tr>
  <tr>
    <td colspan="10" style="border-bottom: 1px solid; border-left: none;">帰国後の目摽</td>
    <td colspan="21" style="text-align: left;border-bottom: 1px solid">
        <p>&#10003; 日本での職業経験を生かして日系企業に管理者として勤めること</p>
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
    <td colspan="6"> 無 </td>
    <td colspan="2"> 種類 </td>
    <td colspan="19" style="text-align: left;">
        <!-- Symbols &#9745; &#9744; -->
        &nbsp; &#9745; バイク 
        &nbsp; &#9744; 車
        &nbsp; &#9744; &ensp; その他 (&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;)
    </td>
  </tr>
  <tr>
    <td colspan="4" style="border-bottom: 1px solid; border-left: none;">趣味</td>
    <td colspan="12" style="border-bottom: 1px solid">ĐỌC SÁCH, NGHE NHẠC, XEM PHIM, ĐÁ BANH, CẦU LÔNG, BƠI LỘI…</td>
    <td colspan="4" style="border-bottom: 1px solid">長所</td>
    <td colspan="11" style="border-bottom: 1px solid">SIÊNG NĂNG, HÒA ĐỒNG, CÓ TRÁCH NHIỆM, NHIỆT TÌNH, KIÊN TRÌ, KIÊN NHẪN, TÍCH CỰC…</td>
  </tr>
<tr style="height:5px;">
    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
</tr>
  <tr>
    <td colspan="2" rowspan="6" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
    <td colspan="3" style="border-top: 1px solid;">続柄</td>
    <td colspan="6" style="border-top: 1px solid;">氏名</td>
    
    <td colspan="2" style="border-top: 1px solid">年生</td>
    <td colspan="6" style="border-top: 1px solid">職業</td>
    <td colspan="6" style="border-top: 1px solid">就職先</td>
    <td colspan="6" style="border-top: 1px solid">月収</td>
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
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>