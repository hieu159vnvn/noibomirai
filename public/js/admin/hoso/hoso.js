$( document ).ready(function() {
    var t = $('#myTable').DataTable( {
        "processing": true,
        "serverSide": true,
        ajax: '/datatables/data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'hinhanh', name: 'hinhanh' },
            { data: 'nguoigioithieu', name: 'nguoigioithieu' },            
            { data: 'hoten', name: 'hoten' },
            { data: 'tinhtrang', name: 'tinhtrang' },
            { data: 'tinhthanh', name: 'tinhthanh' },
            { data: 'action', name: 'action'}],
        "language": datatable_language,
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [0,1,4,6]
        }]

    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});

$('.message .close')
  .on('click', function() {
    $(this)
      .closest('.message')
      .transition('fade')
    ;
  })
;