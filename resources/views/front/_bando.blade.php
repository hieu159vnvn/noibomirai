<div style="width: {{$width}}; height: {{$height}}" id="app-google-map-{{$name}}"></div>
<script>
	function initMap() {
		var myLatLng = {lat: {{$latitude}}, lng: {{$longitude}} };

		/*Create a map object and specify the DOM element for display.*/
		var map = new google.maps.Map(document.getElementById('app-google-map-{{$name}}'), {
			center: myLatLng,
			zoom: 16
		});
		var contentString = '<div style="color: red; font-weight:bold">{{$tieudegooglemap}}</div><div>Địa chỉ: {{$diachigooglemap}}</div><div>Hotline: {{$hotlinegooglemap}}</div><div>Email: {{$emailgooglemap}}</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		/*Create a marker and set its position.*/
		var marker = new google.maps.Marker({
			map: map,
			position: myLatLng,
			title: '{{$tieudegooglemap}}',
		});
		
	@if($info_window_status == 1)
		infowindow.open(map, marker);
		marker.addListener('click', function() {
    		infowindow.open(map, marker);
  		});
  	@endif
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{config('myapp.goole_map_api_key')}}&callback=initMap" async defer></script>