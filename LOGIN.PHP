<?PHP
	include 'Func.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  	// collect value of input field
		$inputJSON = file_get_contents('php://input');
		$input = json_decode($inputJSON, TRUE); //convert JSON into array
		$input = array_change_key_case_recursive($input);
		if($input == null){
			echo "Json Format is invalid";
		}else{
		  	// continue if json format correct validate input field
		  	if(!array_key_exists("data",$input)){
		  		$outputResp["errorMsg"] = "Data field is missing in the Json object";
		  	}else if (!array_key_exists("username",$input["data"])){
		  		$outputResp["errorMsg"] = "Data field is missing in the Json object";
		  	}else if (!array_key_exists("password",$input["data"])){
		  		$outputResp["errorMsg"] = "Data field is missing in the Json object";
		  	}
		  	// no error msg continue
		  	if(!(isset($outputResp["errorMsg"]))){
		  		// generalize username all lowercase
			  	$inputUsername = trim(strtolower($input["data"]["username"]));
			  	$hashPass = hash("sha256", trim($input["data"]["password"]).strtoupper($input["data"]["username"])."SecureMatric");
			  	//test to check the hashing method
			  	// echo $hashPass;
			  	// echo "\n";

			  	include "dbConnection.php";
			  	if ($dbConnection->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				  $outputResp["errorMsg"] = "Connection failed: " . $conn->connect_error;
				}else{
					$stmt = $dbConnection->prepare("SELECT usID,usName,hashPass FROM userdetail where usName = ? and status = 1");

					$stmt->bind_param('s',$inputUsername); //  bind_param parameter 1.'s' validation for the input  2. input field
					
					if( !($stmt->execute())){
						die( "Error preparing: (" .$conn->errno . ") " . $conn->error);
					    $outputResp["errorMsg"] = "Error preparing: (" .$conn->errno . ") " . $conn->error;
					}else{
						// store result if the database query have no errors
						$stmt->store_result();
					}
					if($stmt->num_rows() == 0){
						$outputResp["errorMsg"] = "Invalid username and Password";
					}else{
						// found a correct user name check password
						$stmt->execute();
						$result = $stmt->get_result();
						$row = $result->fetch_array(MYSQLI_NUM);
						// echo $row[0];
						// 0 : usID 1 : usName 2:hashPass;
						if($row[2] == $hashPass){
							$userID = $row[0];
							date_default_timezone_set("Asia/Kuala_Lumpur");
							// token generation
							// Store a string into the variable which we can use this to access userdetails without compremising the security consent
							$sessionObj = [];
							$sessionObj["token"] = uniqid();
							// add 1 hour
		    				$sessionObj["tokentime"] = date('d/m/y h:i:s',time()+60*60);
		    				$sessionObj["userID"] = $userID;
							  
		    				$json = json_encode($sessionObj);
		    				// check the json string
		    				// echo $json;
		    				// encrypt the data as a string easy to get back details later
		    				$token = encryptionAES($json);
		    				$outputResp["token"] = $token;
		    				$outputResp["Created"] = date('d/m/y h:ia',time());
		    				$outputResp["Valid"] = date('d/m/y h:ia',time()+60*60);
		    				
		    				$stmt1 = $dbConnection->prepare("update userdetail set currSession = ? where usid = ? and status = 1");
		    				$stmt1->bind_param('si',$token,$userID); //  bind_param parameter 1.'s' validation for the input  2. input field
		    				if( !($stmt1->execute())){
					    		die( "Error updating (" .$conn->errno . ") " . $conn->error);
					    		$outputResp["errorMsg"] = "Error preparing: (" .$conn->errno . ") " . $conn->error;
							}
							$stmt1->close();
						}
					}
					$stmt->close();
				}
			}
		}
	}else{
		$outputResp["errorMsg"] = "Invalid Method Get is not Allow";
	}
?>