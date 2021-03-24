<?php $__env->startSection('title', 'Danh sách học viên đậu phỏng vấn'); ?>
<?php $__env->startSection('PageContent'); ?>
    <div class="ui two column centered grid wrap-content-header">
        <h1 class="ui header centered page-title">Danh sách học viên đậu phỏng vấn công ty <?php echo e($congty->tencongty); ?>

            <div class="sub header">
            </div>
        </h1>
    </div>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
   
    <div class="ajax-messenger">
        
    </div>
    <div class="ui two column centered grid main-content">
        <div class="fifteen wide column">
            <form class="ui form id-cty" action="" method="post" name="form_1" id="form" id-cty="<?php echo e($congty->id); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="field thongtin">
                    <div class="field">
                        <label>Danh sách học viên</label>
                        <div class="sixteen wide column">
                            <div class="ui segments">
                                <div class="ui segment">
                                    <table id="myTable" class="ui selectable celled striped table">
                                        <thead>
                                            <tr>
                                                <th>Họ và tên</th>
                                                <th>Ngày sinh</th>
                                                <th>Số điện thoại</th>
                                                <th>CMND</th>
                                                <th>Ảnh</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui two column grid">
                    <div class="eight wide column">
                        <a href="<?php echo e(url('/doitac')); ?>" class="ui labeled icon button btn-align-left"><i
                                class="arrow left icon"></i>Danh Sách</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="ui tiny image-modal modal">
        <div class="content" style="text-align: center"></div>
    </div>
    
    <div class="ui tiny modal-delete-hv modal">
        <div class="content">
            Vui lòng nhập lí do:
        <input id="lido" name="lido" type="text" style="width:78%;height: 30px;border-radius: 4px;">
        </div>
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
            var idcongty = $(".id-cty").attr('id-cty');
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: '/dhdatatables/ctyhocvien/'+ idcongty,
                columns: [
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
                        data: 'hinhanh'
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

            });
            //add
            $("#myTable").on('click','.btn-add-ktx',function() {
                //add
                var idhv = $(this).attr('id-hocvien');
                var hv =("add-hocvien-ktx-"+idhv);
                var element = document.getElementById(hv);
                element.classList.add("d-contents");
                var btn =("btn-add-ktx-"+idhv);
                $("."+btn).addClass("btn-red");

                var idktx = $(".id-ktx").attr('id-ktx');
                //ajax
                var idhv = $(this).attr('id-hocvien');
                $.post("/kitucxa/addhocvien/"+idktx+"/"+idhv);
                
                
            })
             //del
            $("#myTable").on('click','.btn-del-ktx',function() {
                $(".modal-delete-hv").modal('show');
                $(".modal-delete-hv .positive").attr('id-hv', $(this).attr('id-hocvien'));
                $(".modal-delete-hv .positive").attr('id-ktx',$(".id-ktx").attr('id-ktx'));
            });
            $('.modal-delete-hv .positive').click(function(event) {
                var idhv = $(this).attr('id-hv');
                var idktx = $(this).attr('id-ktx');
                var lido = $('#lido').val();
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/kitucxa/delhocvien/'+idktx+"/"+idhv+"/"+lido,
                    type: 'POST',
                    data: { idktx: idktx},
                    success: function success(data) {
                        location.reload();
                    }
                });
            });
        });
        ///
        // function myFunction() {
           
        //     var idhv = $(this).attr('id-hocvien');
        //     alert('dcdc');
        //     $(".btn-add-ktx").css("background-color", "#db5334");
        // }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>