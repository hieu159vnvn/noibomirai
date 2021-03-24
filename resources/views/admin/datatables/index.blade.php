@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <table id="myTable">
        <thead>
            <tr>
                <th>stt</th>
                <th>Hinh Anh</th>
                <th>Name</th>
                <th>Ngay sinh</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">

    $(document).ready(function() {
     $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/datatables/data',
        columns: [
            { data: 'rownum', name: 'rownum'},
            { data: 'hinhanh', name: 'hinhanh' },
            { data: 'hoten', name: 'hoten' },
            { data: 'ngaysinh', name: 'ngaysinh' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' }
        ]
    });
    } );
    </script>





    
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
