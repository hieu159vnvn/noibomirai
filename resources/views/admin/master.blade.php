<!DOCTYPE html>
<html>
<head>
	@section('CssLibraries')@show
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{url('libraries/semanticui/semantic.min.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{url('libraries/mmenu/jquery.mmenu.all.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('libraries/mmenu/style_mmenu.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('libraries/calendar/calendar.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/admin/style.css')}}">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
	{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
	<script src="{{url('libraries/sweetalert.js')}}"></script>
	
    <script src="{{url('libraries/jquery-3.3.1.min.js')}}"></script>
	<script src="{{url('libraries/mmenu/jquery.mmenu.min.all.js')}}"></script>
	<script src="{{url('libraries/calendar/calendar.js')}}"></script>
	<script src="{{url('libraries/semanticui/semantic.min.js')}}"></script>
	<script src="{{url('libraries/jquery.inputmask.bundle.min.js')}}"></script>
	
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
	<script src="{{url('libraries/ckeditor/ckeditor.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

	<title>@yield('title')</title>
</head>
<body>	
	<div id="main-content">
		<div id="sidebar-content">
			@include('admin.sidebar')
		</div>
		<div id="wrap-content">	
			@include('admin.header')
			<div class="main-content">		
			@section('PageContent')@show
			</div>
			@include('admin.footer')			
		</div>
	</div>	
		
    <script src="{{url('js/admin/init.js')}}"></script>
	@section('JsLibraries')@show
</body>
</html>
