<?php 
	function array_change_key_case_recursive($arr)
	{
		// return the key to lowercase for easier access regardless user pass in upper or lower
	    return array_map(function($item){
	        if(is_array($item))
	            $item = array_change_key_case_recursive($item);
	        return $item;
	    },array_change_key_case($arr));
	}

	function encryptionAES($input){
		// Store the cipher method
		$ciphering = "AES-128-CTR";
		  
		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		  
		// Non-NULL Initialization Vector for encryption
		$encryption_iv = '1234567891011121';
		  
		// Store the encryption key
		$encryption_key = "privatekey";
		  
		// Use openssl_encrypt() function to encrypt the data
		$encryption = openssl_encrypt($input, $ciphering,
		            $encryption_key, $options, $encryption_iv);

		return $encryption;
	}

	function decryptionAES($input){
		// Store the cipher method
		$ciphering = "AES-128-CTR";
		  
		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		  
		// Non-NULL Initialization Vector for decryption
		$decryption_iv = '1234567891011121';
		  
		// Store the decryption key
		$decryption_key = "privatekey";
		  
		// Use openssl_decrypt() function to decrypt the data
		$decryption=openssl_decrypt ($input, $ciphering, 
		        $decryption_key, $options, $decryption_iv);

		return $decryption;
	}

	function getAuthorizationHeader(){
	    $headers = null;
	    if (isset($_SERVER['Authorization'])) {
	        $headers = trim($_SERVER["Authorization"]);
	    }
	    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
	        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	    } elseif (function_exists('apache_request_headers')) {
	        $requestHeaders = apache_request_headers();
	        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
	        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
	        //print_r($requestHeaders);
	        if (isset($requestHeaders['Authorization'])) {
	            $headers = trim($requestHeaders['Authorization']);
	        }
	    }
	    return $headers;
	}

	function getBearerToken() {
	    $headers = getAuthorizationHeader();
	    // HEADER: Get the access token from the header
	    if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            return $matches[1];
	        }
	    }
	    return null;
	}
?>