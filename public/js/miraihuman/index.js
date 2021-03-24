function status_delete(segment){
//delete
$('.btn-delete').click(function (event) {
	$(".del-modal").modal('show');
	var header = '<p>Có phải bạn có muốn xóa ' + $(this).attr('data-name') + '?</p><i>Lưu ý: Cần cân nhắc trước khi xóa. Sẽ không phục hồi lại được!</i>';
	$(".del-modal .content").html(header);
	$(".del-modal .positive").attr('data-id', $(this).attr('data-id'));
});

$('.btn-view').click(function(event){
	$('.view-modal').modal('show');
	$(".view-modal .positive").attr('data-id', $(this).attr('data-id'));
});

$('.actions .positive').click(function (event) {
	window.location.href = segment+'/' + $(this).attr('data-id') + '/delete';
});
//status
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".wrapstatus").on('click','.cont',function(e){
    var id = $(this).attr('idstatus');
    var sss = $(this).attr('rootstatus');
    if (sss == 1) {
      status = 0;
    } else {
      status = 1;
    }
    $.post(segment+"/status/"+id,
    {
      status: status
    },
    function(result){
      	if (result == 1) {
        	$(".cont"+id).html('<input name="stt" type="checkbox" class="cont" idstatus="'+id+'" rootstatus="1"  checked><label>Đã phát hành</label>');
      	}else {
        	$(".cont"+id).html('<input name="stt" type="checkbox" class="cont" idstatus="'+id+'" rootstatus="0" ><label>Đã phát hành</label>');
      	}
    });
});
}

