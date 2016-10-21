<?php header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Decrypt 2.0</title>
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

	if((int)$decrypted >= 20){
		echo '<h4 style="margin-left: 20px;" class="text-danger">Last Challenge : '. $_SESSION['previous'] .'</h4>';
			echo '<div class="container text-center">
			<h4 style="/* Padding-left:20%; */ padding-top:20px;"><strong>PRECISION AND SPEED WILL LEAD YOU TO THE NEXT QUESTION</strong><br><br>
A cryptography method was used by King Subamius Phaditius, the Great of the Codington Kingdom. His glory was spread across the seven seas, around the world as the great cryptographer that ever lived. 
Recently, a group of archeologists researching on this Great King’s life, came across a Encrypted message while digging up an archeology site, which surprisingly was the King’s study, where he used to spend his leisure time implementing new methods for making his messages more secure for transmission across his officials as well as officials of other kingdoms.
The message was:<br><br>
E	D	F	O	T	<u>C</u>	O	Z	<u>O</u>	N	J	R	J	B	F	Q	Q
<br>
<br>
<p class="text-left">Further, on the back of the same paper was the coding method, as follows:</p>
<ul class="text-left">
<li>The messages must contain only alphabets and no numbers or punctuations (dots, colon, commas etc.).</li>
<li>Remove any spaces in between the alphabets while doing that underline the alphabet after which the space must be present.</li>
<li>Now, write the entire message in reverse order, i.e. the last alphabet first, second-last alphabet second and so on, up to the first alphabet is shifted to the last position.</li> 
<li>Number the alphabet 1, 2, 3……. as long as the length of the message. </li>
<li>Shift the Odd numbered alphabets by one place ahead in the alphabetical order.</li> 
E.g. Y will be Z, J will be K etc.
<li>Shift the Even numbered alphabets by one place behind in the alphabetical order.</li>
E.g. Y will be X, H will be G etc.
<li>Your code is ready!!</li>
<li>Decode the message by reversing the process.</li>
</ul>
 <br><br> 
Decrypt it fast and accurately. The message revealed will lead you to the next phase. 
</h4>
			<form style="padding-left:20%;/* width: 60%; */" action="nu.php" method="post">
				<div style="bottom:-350px;margin-top: 35px;margin-left: 100px;">
					<input type="text" class="form-control" name="mu" style="border:1px solid;width: 60%;"><br>
					<input type="submit" class="btn btn-primary btn-lg" value="SUBMIT" style="margin-left: -40%;">
				</div>
			</form>
			</div>';
	}	
	elseif(isset($_POST["lambda"]))
	{
		//$x = str_replace(' ', '', $_POST["answer1"]);		
		$x = strtolower($_POST["lambda"]);
		if(strpos($x,'you') !== false && strpos($x,'got') !== false && strpos($x,'!!!!!!!') !== false && strpos($x,'it') !== false){			
			session_destroy();
			session_start();
			$string = 20;
			$_SESSION['challenge'] = encrypt($string, ENCRYPTION_KEY);
			date_default_timezone_set('Asia/Kolkata');
			$_SESSION['previous'] = date("h:i:sa");

			$myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
			
			$txt = "\r\n" . get_client_ip() . " " . date("h:i:sa") . "  " . "13"; 
			fwrite($myfile, $txt);


			//Place Samething above && make Change in ACTION, NAME, SESSION VALUE
			echo '<h4 style="margin-left: 20px;" class="text-danger">Last Challenge : '. $_SESSION['previous'] .'</h4>';
			echo '<div class="container text-center">
			<h4 style="/* Padding-left:20%; */ padding-top:20px;"><strong>PRECISION AND SPEED WILL LEAD YOU TO THE NEXT QUESTION</strong><br><br>
A cryptography method was used by King Subamius Phaditius, the Great of the Codington Kingdom. His glory was spread across the seven seas, around the world as the great cryptographer that ever lived. 
Recently, a group of archeologists researching on this Great King’s life, came across a Encrypted message while digging up an archeology site, which surprisingly was the King’s study, where he used to spend his leisure time implementing new methods for making his messages more secure for transmission across his officials as well as officials of other kingdoms.
The message was:<br><br>
E	D	F	O	T	<u>C</u>	O	Z	<u>O</u>	N	J	R	J	B	F	Q	Q
<br>
<br>
<p class="text-left">Further, on the back of the same paper was the coding method, as follows:</p>
<ul class="text-left">
<li>The messages must contain only alphabets and no numbers or punctuations (dots, colon, commas etc.).</li>
<li>Remove any spaces in between the alphabets while doing that underline the alphabet after which the space must be present.</li>
<li>Now, write the entire message in reverse order, i.e. the last alphabet first, second-last alphabet second and so on, up to the first alphabet is shifted to the last position.</li> 
<li>Number the alphabet 1, 2, 3……. as long as the length of the message. </li>
<li>Shift the Odd numbered alphabets by one place ahead in the alphabetical order.</li> 
E.g. Y will be Z, J will be K etc.
<li>Shift the Even numbered alphabets by one place behind in the alphabetical order.</li>
E.g. Y will be X, H will be G etc.
<li>Your code is ready!!</li>
<li>Decode the message by reversing the process.</li>
</ul>
 <br><br> 
Decrypt it fast and accurately. The message revealed will lead you to the next phase. 
</h4>
			<form style="padding-left:20%;/* width: 60%; */" action="nu.php" method="post">
				<div style="bottom:-350px;margin-top: 35px;margin-left: 100px;">
					<input type="text" class="form-control" name="mu" style="border:1px solid;width: 60%;"><br>
					<input type="submit" class="btn btn-primary btn-lg" value="SUBMIT" style="margin-left: -40%;">
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
