<?php 
	include 'Func.php';
	$token = getBearerToken();
	$jsonObj = json_decode(decryptionAES($token),true);
	if(!(isset($jsonObj))){
		$outputResp["error"] = "Invalid Token";
	}else{
		// Compare now with the token time if over then timeout already
		if(date('d/m/y h:i:s',time()) > $jsonObj["tokentime"]){
			$outputResp["error"] = "Token Expired";
		}
	}
?>