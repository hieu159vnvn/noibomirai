@extends('admin.master')
@section('title', 'Điểm danh')
@section('PageContent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">ĐIỂM DANH</h1>

	</div>
	
	@if (session('status'))  
		<div class="ui message">
			{{ session('status') }}				
		</div>
	@endif
	@if ($errors->any())
	<div class="ui message">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		<i class="close icon"></i>
	</div>
	@endif	
	<div class="ajax-messenger"></div>
	<div class="ui two column grid main-content">
		<div class="fifteen wide column">
			<h2> Chưa có lớp học này! </h2>
			<a href="{{ URL::previous() }}" class="ui labeled icon button"> <i class="arrow left icon"></i> Quay về</a>
		</div>

	</div>
@endsection
@section('JsLibraries')
  
@endsection