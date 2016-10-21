<?php header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Oil to IT</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body style="background-color:#E4E4E4">
	<?php
	
	define("ENCRYPTION_KEY", "!@#$%^&*");

	//Reuturns IP of client
	function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

	/**
	 * Returns an encrypted & utf8-encoded
	 */
	function encrypt($pure_string, $encryption_key) {
	    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
	    return $encrypted_string;
	}
	
	/**
	 * Returns decrypted original string
	 */
	function decrypt($encrypted_string, $encryption_key) {
	    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
	    return $decrypted_string;
	}
	
	$encrypted = $_SESSION['challenge'];
	$decrypted = decrypt($encrypted, ENCRYPTION_KEY);

	if((int)$decrypted >= 10){
		echo '<h4 style="margin-left: 20px;" class="text-danger">Last Challenge : '. $_SESSION['previous'] .'</h4>';
			echo '<div class="container">
			<h3 style="Padding-left:20%; padding-top:20px; width:70%" class="text-success text-center">He is the Chief Executive Officer and Member of the Board of this company. He was also a Managing Director of GE X Ray. Founded in 1945
In which year did the founder of the company die??</h3>
			<form style="padding-left:20%;" action="delta.php" method="post">
				<div style="bottom:-350px; margin-top:100px;">
					<input type="text" class="form-control" name="gamma" style="border:1px solid; width:60%"><br>
					<input type="submit" class="btn btn-primary btn-lg" value="SUBMIT" style="margin-left:25%">
				</div>
			</form>
			</div>';
	}	
	elseif(isset($_POST["beta"]))
	{
		//$x = str_replace(' ', '', $_POST["answer1"]);		
		$x = strtolower($_POST["beta"]);
		if(strpos($x,'cheryl') !== false && strpos($x,'cole') !== false){			
			session_destroy();
			session_start();
			$string = 10;
			$_SESSION['challenge'] = encrypt($string, ENCRYPTION_KEY);
			date_default_timezone_set('Asia/Kolkata');
			$_SESSION['previous'] = date("h:i:sa");

			$myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
			
			$txt = "\r\n" . get_client_ip() . " " . date("h:i:sa") . "  " . "3"; 
			fwrite($myfile, $txt);


			//Place Samething above && make Change in ACTION, NAME, SESSION VALUE
			echo '<h4 style="margin-left: 20px;" class="text-danger">Last Challenge : '. $_SESSION['previous'] .'</h4>';
			echo '<div class="container">
			<h3 style="Padding-left:20%; padding-top:20px; width:70%" class="text-success text-center">He is the Chief Executive Officer and Member of the Board of this company. He was also a Managing Director of GE X Ray. Founded in 1945
In which year did the founder of the company die??</h3>
			<form style="padding-left:20%;" action="delta.php" method="post">
				<div style="bottom:-350px; margin-top:100px;">
					<input type="text" class="form-control" name="gamma" style="border:1px solid; width:60%"><br>
					<input type="submit" class="btn btn-primary btn-lg" value="SUBMIT" style="margin-left:25%">
				</div>
			</form>
			</div>';
		} else{
			header ('Location: random.php');
			die();
		}
	
	}else {
		header ('Location: forbidden.php');
		die();
	}
	?>
</body>
</html>
