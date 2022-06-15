<?php
// set header type
header('Content-Type: text/json; charset=utf-8'); 
if(isset($_GET["svc"]) || isset($_GET["service"])){
	if($_GET["svc"] == "" && $_GET["service"]){
		$_GET["svc"] = $_GET["service"];
	}
	$outputResp = [];
	if(strtolower($_GET["svc"]) == 'login'){
		include 'login.php';
	}else if (strtolower($_GET["svc"]) == 'get'){
		include 'validateToken.php';
		include 'data.php';
	}else{
		$outputResp["Message"] = "Service :".$_GET["svc"]." is not available.";
	}
}else{
	$outputResp = [];
	$outputResp["Message"] = "Invalid services";
}
$output = json_encode($outputResp);
echo $output;

?>