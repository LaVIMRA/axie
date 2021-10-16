

<?php

//setup required variables
$userid = "173128"; //<< fill this in with your userid
$country = "US";
$device = "android";

//url to request
$url = "https://mobverify.com/api/v1/?affiliateid=".urlencode($userid)."&country=".urlencode($country)."&device=".urlencode($device)&ctype=1;

//initialize curl
$ch = curl_init();

//setup curl options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//make request
$response = curl_exec($ch);

if($response === false) {
	//curl error occurred, handle it how you like
	echo curl_error($ch);
}

//close the curl object
curl_close($ch);

if($response !== false) {
	//curl request was successful

	//decode the json response into a php array
	$json = json_decode($response, true);

	if($json === false) {
		//failed to decode json response
		echo json_last_error_msg();

	} elseif($json['success']) {
		//api call was successful

		//loop through the offers
		foreach($json['offers'] as $offer) {

			//as an example we output the offer names
			echo "<p>".$offer['name']."</p>";
		}

	} else {
		//api error occurred, handle it how you like
		echo $json['error'];
	}

}

?>

