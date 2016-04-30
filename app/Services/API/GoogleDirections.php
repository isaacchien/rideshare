<?php

namespace App\Services\API;

use Cache;

class GoogleDirections {

  public function __construct(array $config = [])
  {
    $this->key = $config['key'];
  }

	public function route($trip_id)
	{

		$trip = \App\Trip::find($trip_id);

		$key = $this->key;
		$origin = $trip->origin;
		$destination = $trip->destination;
		$url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origin&destination=$destination&mode=driving&key=$key";

		$url = str_replace(" ","+", $url);
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);

		// Will dump a beauty json :3
		$response = json_decode($result, true);

		if ($response["status"] === "NOT_FOUND"){
			$response = null;
		}

		return $response;

	}


}
