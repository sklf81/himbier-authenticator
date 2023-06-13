<?php
	//From redirecting the link:
	if(isset($_GET["save_session"])){
		$pass_file = fopen("/data/pass/".$_GET["request"].".json", "w");
		$temp = array("session_id" => $_COOKIE["session_id"]);
		fwrite($pass_file, json_encode($temp));
		fclose($pass_file);
		header("Location: /".$_GET["request_location"]);	
	}

	else if(isset($_POST["request"])){
		if(auth_checkPass($_POST["request"])){
			header("Location: /".$_POST["request_location"]);			
		}		
		else if(isset($_POST["pass"])){
			$password_encrypted = str_replace(file_get_contents(["\n", "\r"], "", "/data/pass/".$_POST["request"]));
			//Strip Tags before processing input (isset() is okay to use without stripping)
			$pass = strip_tags($_POST["pass"]);
			
			if(encrypt($pass) === $password_encrypted){
				//Set Cookie that expires after 5 min
				setcookie("session_id", md5(random_int(0, 1337)), time() + 300, "/");
				header("Location: /include/modules/pass.php?save_session=1&request=".$_POST["request"]."&request_location=".$_POST["request_location"]);
				//Cookies refresh only after a new page has been loaded	
			}
			else{
				fclose($pass_file);
				header("Location: /authentification.php?request=".$_POST["request"]."&request_location=".$_POST["request_location"]);	
			}
		}
		else{
			header("Location: /authentification.php?request=".$_POST["request"]."&request_location=".$_POST["request_location"]);	
		}
	}


	function encrypt($cyphered){
		//Doppelt hält besser
		return strval(hash("sha256", md5(str_replace(["\n", "\r"], "", $cyphered))));
	}

	function auth_checkPass($request){
		$pass_file_content = json_decode(file_get_contents("/data/pass/".$request.".json"));
		$session = $pass_file_content->session_id;
		
		if(isset($_COOKIE["session_id"])){
			if(!strcmp($session, $_COOKIE["session_id"])){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
		
	}

	function displayPassInput($request, $request_location){
		$html_input_form = "
			<div class='passphrase_input'>
				<form action='/include/modules/pass.php' method='POST'>
					<input type='Password' name='pass' placeholder='...'></input>
					<input style='display: none' name='request' value=".$request."></input>
					<input style='display: none' name='request_location' value=".$request_location."></input>
					<input type='submit' name='submit_button'></input>
					<input type='submit' hidden />
				</form>
			</div>
		";

		echo($html_input_form);
		return;
	}
?>


