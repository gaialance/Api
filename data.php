<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	// api key for the website to get more cat data
	$api_key = "e85363aa-d05b-4306-8745-25e666fe529f";
	$url = "https://api.thecatapi.com/v1/breeds?limit=100";
	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => array(
	            "Content-type: application/x-www-form-urlencoded",
	            "x-api-key"=>$api_key
	        ),
	        'method'  => 'GET'
    	)
	);
	// make the request stream
	$context  = stream_context_create($options);
	// call the url and get back respone from the url
	$result = file_get_contents($url, false, $context);
	// set it to output data;
	$outputResp["data"] = json_decode($result);
}
?>