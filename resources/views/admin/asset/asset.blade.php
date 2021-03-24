@extends('admin.master')

@section('PageContent')

	<div id="wrapper-content">
		<iframe width="100%" height="550" src="{{url('filemanager/dialog.php?type=2&fldr=/')}}" frameborder="0" ></iframe>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('iframe').height($(window).height() - 30);
		});
	</script>
@endsection