@extends('admin.master')
@section('title', 'Sửa Lớp Học')
@section('PageContent')
    @php
    function ym($time) {
        $timestamp = strtotime($time);
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        return $year.'/'.$month;
    }
    @endphp

    <div class="ui two column centered grid wrap-content-header">
        <h1 class="ui header centered page-title">SỬA LỚP HỌC </h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="ajax-messenger"></div>
    <div class="ui two column centered grid main-content">
        <div class="fifteen wide column">
            <form class="ui form" action="" method="post" name="form_1" id="form" data_id={{ $dt->id }}>
                {{ csrf_field() }}
                <div class="field thongtin">
                    <div class="two fields">
                        <div class="field">
                            <label>Tên lớp học (*)</label>
                            <div class="ui input left icon">
                                <i class="user icon"></i>
                                <input type="text" name="ten_lop_hoc" value="{{ $dt->ten_lop_hoc }}" required>
                            </div>
                        </div>
                        <div class="field">
                            <label>Ngày khai giảng (*)</label>

                            <div class="ui calendar" id="date-only">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" name="ngay_khai_giang" value="{{ $dt->ngay_khai_giang }}" required>
                                </div>
                                <div class="ngay-sinh">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Giáo viên chủ nhiệm (*)</label>
                            <select name="gvcn">
                                <option value="0">Chọn giáo viên</option>
                                @foreach ($giaovien as $gv)
                                    @if ($gv->id == $dt->gvcn)
                                        <option selected value="{{ $gv->id }}">{{ $gv->hoten }}</option>
                                    @else
                                        <option value="{{ $gv->id }}">{{ $gv->hoten }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label>Cơ sở (*)</label>
                            <select name="coso">
                              
                                <option @if ($dt->coso == 3) selected @endif
                                    value="3">Phòng đào tạo</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label>Danh sách học viên</label>


                        <div class="sixteen wide column">
                            <div class="ui segments">
                                <div class="ui segment">
                                    <table id="myTable" class="ui selectable celled striped table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>HỌ & TÊN</th>
                                                <th>NGÀY SINH</th>
                                                <th>Ảnh</th>
                                                <th>GHÉP LỚP</th>
                                                <th>CHUYỂN LỚP</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>HỌ & TÊN</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="inline field">
                        <label>(*) Trường bắt buộc phải nhập</label>
                    </div>
                </div>

                <div class="ui two column centered grid">
                    <div class="eight wide column">
                        <a href="{{ url('daotao') }}" class="ui labeled icon button btn-align-left"><i
                                class="arrow left icon"></i>Danh Sách</a>
                        <button type="submit" class="ui labeled icon button blue btn-align-right"><i
                                class="save icon"></i>Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    {{-- modal chuyen --}}
    <div class="ui tiny chuyen-modal modal">
        <div class="content"></div>
        <select class="ui dropdown" id="id_lop_chuyen">
            <option value="NULL" selected>Chọn lớp chuyển</option>
            @foreach ($lophoc as $item)
                <option value="{{$item->id}}">{{$item->ten_lop_hoc}}</option>
            @endforeach
        </select>
        <div class="actions">
            <div class="ui negative button">
                No
            </div>
            <div class="ui positive right labeled icon button">
                Yes
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="ui tiny edit-modal modal">
        <div class="content"></div>
        <div class="actions">
            <div class="ui negative button">
                No
            </div>
            <div class="ui positive right labeled icon button">
                Yes
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
    {{-- modal image --}}
    <div class="ui tiny image-modal modal">
        <div class="content" style="text-align: center"></div>
    </div>

@endsection
@section('JsLibraries')
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
            padding-right: 10px;
        }

        .ui.form input:not([type]) {
            width: 90%;
        }

        .hagiaovien {
            height: 30px;
        }

    </style>
    <script>
        $( "#form" ).on( "click",".image",function (event) {
            $(".image-modal").modal('show');
            var header = '<img src=' +$(this).attr('src') +'>';
            $(".image-modal .content").html(header);
        });

        $('.ui.dropdown').dropdown('hide');
        var id = $("#form").attr("data_id");

        $('#form').on("click",".edit",function(event) {
            // var id_hv = $(this).val();
            $(".edit-modal").modal('show');
            var header = '<p>Bạn đang muốn phân lớp cho học viên: ' + $(this).attr('data-name') +'?</p>';
            $(".edit-modal .content").html(header);
            $(".edit-modal .positive").attr('data-id', $(this).val());

        });
        $('.edit-modal .positive').click(function(event) {
			var id_hv = $(this).attr('data-id');
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '/daotao/'+id+'/editajax',
				type: 'POST',
				data: { id_hv: id_hv},
				success: function success(data) {
                    console.log(data);
					if (data == 'ok') {
						location.reload();
					}
				}
			});
        });
		
		$( "#form" ).on( "click", ".btn-chuyen",function (event) {
            $(".chuyen-modal").modal('show');
            var header = '<p>Bạn đang muốn chuyển học viên: ' + $(this).attr('data-name') +'?</p>';
            $(".chuyen-modal .content").html(header);
            $(".chuyen-modal .positive").attr('data-id', $(this).attr('data-id'));
            $(".chuyen-modal .positive").attr('data-id-chuyen', $(this).attr('data-id-chuyen'));
        });
        $('.chuyen-modal .positive').click(function(event) {
            var id_lop = $('#id_lop_chuyen').val();
			var id_hv = $(this).attr('data-id');
            var id_chuyen = $(this).attr('data-id-chuyen');
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '/daotao/'+id+'/chuyen',
				type: 'POST',
				data: { id_hv: id_hv, id_lop: id_lop,id_chuyen: id_chuyen},
				success: function success(data) {
                    console.log(data);
					if (data == 'ok') {
						location.reload();
					}
				}
			});
        });
    </script>
    <script>
        $.fn.dataTable.ext.errMode = 'throw';
        $(document).ready(function() {
            var id = $("#form").attr("data_id");
            var table = $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: '/datatables/daotao/' + id,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'hoten'
                    },
                    {
                        data: 'ngaysinh'
                    },
                    {
                        data: 'hinhanh'
                    },
                    {
                        data: 'ghep',
                        width: "30%"
                    },
                    {
                        data: 'chuyen',
                        width: "20%"
                    },
                ],
                "columnDefs": [{
                    "searchable": true,
                    "orderable": false,
                    "targets": 1
                }],
                ordering: false,
                order: [0, "desc"],
                language: datatable_language,
                // "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                // 	var index = iDisplayIndexFull + 1;
                // 	$('td:eq(0)',nRow).html(index);
                // 	return nRow;
                // },
                search: {
                    "regex": true
                },
                initComplete: function() {
                    this.api().columns([1]).every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        input.setAttribute('placeholder', 'TÌM KIẾM');
                        $(input).appendTo($(column.footer()).empty())
                            .on('keyup change', function() {
                                column.search($(this).val(), false, false, false).draw();
                            });
                    });
                }

            });
        });

    </script>

    <script type="text/javascript">
       
        $('.ui.dropdown').dropdown('hide');
        $(document).ready(function() {
            var length = $('.selection option').length;
            var i;
            for (i = 0; i < length; i++) {
                var selected = $('.selection option:eq("' + i + '")').is(':selected');
                if (selected == true) {
                    $('.item1 :eq("' + i + '")').trigger('click');
                };
            }
        });
        var calendarOpts = {
            type: 'date',
            formatter: {
                date: function(date, settings) {
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
        };
        $('#date-only').calendar(calendarOpts);

    </script>
@endsection
