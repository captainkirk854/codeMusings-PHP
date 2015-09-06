


<?php
	# PHP sections contain functions and application logic ...
	
	#------------------------------------------------------------------------------
	# Functions
	#------------------------------------------------------------------------------

	#------------------------------------------------------------------------------
	function APIGoogleMaps_Access($location)
	{
		/*
		GoogleMaps API endpoint format:
			https://maps.googleapis.com
				   /maps
				   /api
				   /geocode
				   /json
				   ?address=disneyland,ca
		*/
		
		# URLEncode and secure (a bit) ..
		$api_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($location);
		$api_url = strip_tags($api_url);
		
		# Capture api response output as a (json) string and return ..
		return file_get_contents($api_url);
	}
	#------------------------------------------------------------------------------

	#------------------------------------------------------------------------------
	function APIGoogleMaps_GetLatLong($location)
	{
		/*
			GoogleMaps JSON has following element structure:
			
			<results>
				<address_components>
					<long_name>
					<short_name>
					<types>
				<formatted_address>
				<geometry>
					<location>
						<lat>
						<lng>
					<location_type>
					<viewport>
						<northeast>
							<lat>
							<lng>
						<southwest>
							<lat>
							<lng>
					<place_id>
					<types>
			<status>
		*/
		
		#Initialise output array ..
		$coords = [];
		
		#Initially, convert nested JSON output into a single-element, multi=dimensional array .. 
		$googlemapsJsonAsArray = utJsonToArray(APIGoogleMaps_Access ($location));
		
		#Use lat/long values from first results.geometry.location.lat/lng ..
		if ( $googlemapsJsonAsArray['status'] = 'OK' )
		{
			$coords ['lat'] = $googlemapsJsonAsArray['results'][0]['geometry']['location']['lat'];
	  		$coords ['lng'] = $googlemapsJsonAsArray['results'][0]['geometry']['location']['lng'];				
		}
		else
		{
			$coords ['lat'] = '0.000';
			$coords ['lng'] = '0.000';
		}
		
		return $coords;
	}
	#------------------------------------------------------------------------------
	
	#------------------------------------------------------------------------------
	function APIInstagram_Access(
								 $lat,
								 $lng,
								 $clientAccessToken
								)
	{
		/*
		Instagram API endpoint format:
			https://api.instagram.com
				   /v1
				   /media
				   /search
				   ?lat=
				   &lng=
				   [&client_id=|&access_token=]
		*/
		
		# URLEncode and secure (a bit) ..
		$api_url = 'https://api.instagram.com/v1/media/search?lat=' . urlencode($lat) . '&lng=' . urlencode($lng) . '&access_token=' . urlencode($clientAccessToken)  ;
		$api_url = strip_tags($api_url);
		
		# Capture api response output as a (json) string and return ..
		return file_get_contents($api_url);
	}
	#------------------------------------------------------------------------------
	
	#------------------------------------------------------------------------------
	function outputHTMLInfoGoogleMaps(
								      $location,
								      $arrayGoogleMapsLatLong
								     )
	{
		if(!empty($arrayGoogleMapsLatLong))
		{
			echo "<b>" . $location . " </b> is located at ";
			echo "<i> a latitude of " . $arrayGoogleMapsLatLong['lat'] . " and a longitude of " .  $arrayGoogleMapsLatLong['lng'] . "</i> <br><br>";			
		}
		else
		{
			echo "<b> Google doesn't know about " . $location . " </b>";
		}
	}
	#------------------------------------------------------------------------------
	
    #------------------------------------------------------------------------------
	function outputHTMLInfoInstagram(
								     $arrayInstagramOutput,
									 $numberOfImagesPerRow
								    )
	{
		#Loop through instagram output scanning for image references ...
		if(!empty($arrayInstagramOutput))
		{
		  $imagesCounter = 0;
	      foreach($arrayInstagramOutput['data'] as $key => $image)
		  {
		  	$imagesCounter +=1;
			
			# Construct image URL ..
			$imageHTML = '<img src="' . $image['images']['low_resolution']['url'] . '" alt=""/>';
	        
			# Only append CR after every N images/columns ..
			if (($imagesCounter%$numberOfImagesPerRow) == 0 ) {$imageHTML .= '<br>';}
			
			# Output image html ..
			echo $imageHTML;
	      }
		  
		  # if no images found ..
		  if($imagesCounter == 0)
		  {
		  	echo "<b> No Instagram information available </b>";
		  }
		  
	    }
		else
		{
			echo "<b> No Instagram information available </b>";
		}
	}
	#------------------------------------------------------------------------------
	
	#------------------------------------------------------------------------------
	function utJsonToArray($jsonString)
	{
		# Convert json to array (true) rather than objects (false) ..
		return json_decode($jsonString, true);
	}
	#------------------------------------------------------------------------------

	#------------------------------------------------------------------------------
	function MakeGetFieldSticky($fieldName)
	{
		if (isset($_GET[$fieldName]))
		{ 
			echo trim($_GET[$fieldName]);
		};
	}
	#------------------------------------------------------------------------------

	#------------------------------------------------------------------------------
    # MAIN
	#------------------------------------------------------------------------------
	
	/*;
		Note: 
			This is just a prototype/learning exercise for me so .. 
				o Error and Exception handling need to be vastly improved
				o Code likely to require refactoring/optimisation by PHP gurus
				
		Acknowledgment:
			This is an offshoot based on Ben Bjurstrom's Basic Rest Application (geogram) example.
			Found at: https://github.com/jelled/geogram
	*/
	
	# Configurable ..	
	$instagram_images_per_row = 3;
	
	# Initialise ..
	$formField_ClientAccessToken = 'InstagramClientAccessToken';
	$formField_Location = 'Location';
?>

<!DOCTYPE html>
<!-- 
	HTML Boiler Plate code:
	Simple form: Double entry field (access token and location) with Submit button which runs this php.
-->
<html lang="en">

  <head>
    <meta charset="utf-8"/>
    <title>RESTFUL GEOGRAPHY</title>
  </head>

  <body>
	<form action="GoogleMapsInstagramMashup.php" method="GET">
		<p>
			Instagram Access Token <br> 
			<i>(Generate one for your Instagram account at http://instagram.pixelunion.net) </i>: <br/>
			<input type="text" size=60 name="InstagramClientAccessToken" value = " <? MakeGetFieldSticky($formField_ClientAccessToken); ?> " />
		</p>
		<p>
			Location of Interest: <br>
			<input type="text" size=50 name="Location" value= " <? MakeGetFieldSticky($formField_Location); ?> " />
		</p>
		<button type="submit">Submit</button> <!-- xxx.php?location=blah -->
	</form>
	<br/>
	
	<?php
		# Get to those API endpoints after user submits GET action ... 
		if ($_SERVER ['REQUEST_METHOD'] == 'GET')
		{
			# Send our location to Google maps api to get geo-coordinates for location ...
			if (!empty(trim($_GET[$formField_ClientAccessToken])) && !empty(trim($_GET[$formField_Location])))
			{
				# Get user input values for use elsewhere ..
				$InstagramClientAccessToken = $_GET[$formField_ClientAccessToken];
				$locationOfInterest = $_GET[$formField_Location];
				
				# Use GoogleMaps API to get coordinates for location ..	
				$googleMapsLatLongArray = APIGoogleMaps_GetLatLong ($locationOfInterest);

				# Now make Instagram API request, using data output by call to GoogleMaps API ...
				$instagramJsonAsArray = utJsonToArray(APIInstagram_Access ($googleMapsLatLongArray['lat'], $googleMapsLatLongArray['lng'], $InstagramClientAccessToken));
				
				# If we have populated arrays as a result of using both api endpoints,  show user the magic ..	
				
				# Display: GoogleMaps info ..
				outputHTMLInfoGoogleMaps ($locationOfInterest, $googleMapsLatLongArray);
				
				# Display: Instagram info ..
			    outputHTMLInfoInstagram ($instagramJsonAsArray, $instagram_images_per_row);
			}
			else
			{
				echo "<b> FILL IN ALL THE FIELDS IF YOU WANT TO SEE A RESULT! </b>" ;
			}
		}
	?>
	
  </body>
</html>
