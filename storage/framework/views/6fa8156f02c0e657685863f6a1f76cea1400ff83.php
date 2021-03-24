<?php $__env->startSection('title', 'Danh sách học viên'); ?>
<?php $__env->startSection('PageContent'); ?>
    <div class="ui two column centered grid wrap-content-header">
        <h1 class="ui header centered page-title">Danh sách học viên </h1>
    </div>
    <div class="ui two column centered grid main-content">
        <div class="fifteen wide column">
            <form class="ui form id-ktx" action="" method="post" name="form_1" id="form">
                <?php echo e(csrf_field()); ?>

                <div class="field thongtin">
                    <div class="field">
                        <div class="sixteen wide column">
                            <div class="ui segments">
                                <div class="ui segment">
                                    <table id="myTable" class="ui selectable celled striped table">
                                        <thead>
                                            <tr>
                                                <th>Ảnh</th>
                                                <th>Họ và tên</th> 
                                                <th>Ngày sinh</th>
                                                <th>Số điện thoại</th>
                                                <th>CMND</th>
                                                <th>Nơi sinh</th>
                                                <th>Phòng hiện tại</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="ui tiny image-modal modal">
        <div class="content" style="text-align: center"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('JsLibraries'); ?>
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
            padding-right: 10px;
        }
        .dataTables_wrapper a{
            cursor: pointer;
        }
        .ui.form input:not([type]) {
            width: 90%;
        }

        .hagiaovien {
            height: 30px;
        }
        /* ktx */
        #add-hocvien-ktx{
            display: none;
            transition: opacity 1s ease-out;
            opacity: 0;
        }
        .d-contents{
            opacity: 1!important;
            display: contents!important;
        }
        .d-contents::before{
            padding-right: 5px;
        }
        .btn-ktx-add{
            color:cornsilk!important;
            background-color:#34A9DB;
            max-width: 100%;
            border:none;
            padding: 10px 5px;
        }
        .btn-ktx-del{
            color:cornsilk!important;
            background-color: #db343c;
            max-width: 100%;
            border:none;
            padding: 10px 5px;
        }
        .btn-red{
            background-color:#21ba45;
        }
    </style>
    <script>
        $( "#form" ).on( "click",".image",function (event) {
            $(".image-modal").modal('show');
            var header = '<img src=' +$(this).attr('src') +'>';
            $(".image-modal .content").html(header);
        });
    </script>
    <script>
        $.fn.dataTable.ext.errMode = 'throw';
        $(document).ready(function() {
            //status
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: '/datatables/kitucxa/danhsachhocvien',
                columns: [
                    {
                        data: 'hinhanh'
                    },
                    {
                        data: 'hoten'
                    },
                    {
                        data: 'ngaysinh'
                    },
                    {
                        data: 'dienthoai'
                    },
                    {
                        data: 'cmnd_socmnd'
                    },
                    {
                        data: 'noisinh'
                    },
                    {
                        data: 'phonghientai'
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
            });
        });
    </script>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>