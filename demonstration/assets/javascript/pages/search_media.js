		// Load the map scripts
		google.load('maps', '3', {other_params:'sensor=true'});
		// Create a map variable
		var map;
		// Create a variable for the users lat long
		var user_lat_long;
		// Create a variable for the zoom level
		var zoom_level;
		// Create an array to hold all of the markers
		var markersArray = [];
		
		function clearOverlays() {

		if (markersArray) {

			for (i in markersArray) {

				markersArray[i].setMap(null);

			}

		}

	}
	
	function mapInit() {

		if(navigator.geolocation) {

			navigator.geolocation.getCurrentPosition(currentPositionSuccessfulCallback);
			
		} else {

			alert('Denied geolocation');

		}

		// Create a basic map with the following options
		var myOptions = {
				zoom: 0,
				center: new google.maps.LatLng(0, 0),
				mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
		// Create the new
		map = new google.maps.Map(document.getElementById("map"), myOptions);

		// Add an event listener for a click event
		google.maps.event.addListener(map, 'click', function(event) {

			// Clear all the markers
			clearOverlays();

			var lat_long		= String(event.latLng);
			var lat_long_array	= lat_long.replace('(', '').replace(')', '').replace(' ', '').split(",");

			$('#latitude').val(lat_long_array['0']);
			$('#longitude').val(lat_long_array['1']);

			// Add a new marker
			marker = new google.maps.Marker({
				position: event.latLng,
				map: map
			});

			markersArray.push(marker);
			
		});
		
	}

	function currentPositionSuccessfulCallback(position)
	{

		user_lat_long = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

		map.setCenter(user_lat_long);
		map.setZoom(15);

		marker = new google.maps.Marker({
			position: user_lat_long,
			map: map
		});

		markersArray.push(marker);

		$('#latitude').val(position.coords.latitude);
		$('#longitude').val(position.coords.longitude);

	}
	
	$(document).ready(function(){
		
		// Create a map
		mapInit();
		
	    // Calculate the current year
	    var currentDate = new Date();
	    var currentYear = currentDate.getFullYear();

	    var yearRangeBegin	= '1900';
	    var yearRangeEnd	= currentYear + 10;
	    	
	    $('.date').datepicker({
	    	dateFormat: 'yy-mm-dd',
	        changeMonth: true,
	        changeYear: true,
	        //showOn: 'button',
	        //buttonImage: base_url + 'assets/images/calendar.png',
	        //buttonImageOnly: true,
	        //showButtonPanel: true,
	        yearRange: yearRangeBegin + ':' + yearRangeEnd
	    });
		
	});
