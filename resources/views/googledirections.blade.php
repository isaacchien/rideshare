@extends('layouts.app')

@section('content')
	<style>
	  html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	  }
	  #map {
		height: 500px;
	  }
	  #floating-panel {
		position: absolute;
		top: 7%;
		left: 40%;
		z-index: 5;
		background-color: #fff;
		padding: 5px;
		border: 1px solid #999;
		text-align: center;
		font-family: 'Roboto','sans-serif';
		line-height: 30px;
		padding-left: 10px;
	  }
	</style>


<div class="container">

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Map</div>

				<div class="panel-body">

						<div id="map"></div>
						<div id="floating-panel"></div>

						<ul class="list-group">
							
							@foreach ($steps as $step)
							  <li class="list-group-item">{!! $step["html_instructions"] !!}</li>
							@endforeach 
						</ul>

				</div>

			</div>
		</div>
	</div>
</div>
	<script>
	function initMap() {
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 4,
			center: {lat: 41.85, lng: -87.65}
		});
		calculateAndDisplayRoute(directionsService, directionsDisplay);

		directionsDisplay.setMap(map);

	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		
			directionsService.route({
			origin: "<?php echo $origin ?>",
			destination: "<?php echo $destination ?>",
			travelMode: google.maps.TravelMode.DRIVING
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
			var outputDiv = document.getElementById('floating-panel');
			outputDiv.innerHTML = '';
			outputDiv.innerHTML += response.routes[0].legs[0].distance.text + ' in ' +
			response.routes[0].legs[0].duration.text + '<br>';

			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});
	}
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8Hv_-vtJajMaLtfEKBINQL9gul_ZQu1U&callback=initMap">
	</script>
@endsection
