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
		session_start();
		
		define("ENCRYPTION_KEY", "!@#$%^&*");
	
		/**
		 * Returns an encrypted & utf8-encoded
		 */
		function encrypt($pure_string, $encryption_key) {
		    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
		    return $encrypted_string;
		}
		
		if(isset($_SESSION['challenge']) == NULL){	
			$string = 7;
			$_SESSION['challenge'] = encrypt($string, ENCRYPTION_KEY);
		}
			
		echo '<div class="container">
		<h3 style="Padding-left:20%; padding-top:20px;" class="text-success">Guess the movie!!!!</h3></br>
		<img src="images/quiz/index.jpg" alt="sorry" width="300px" height="300px" style="margin-left:30%" class="img-rounded">
		<form style="padding-left:20%;" action="alpha.php" method="post">
			<div style="bottom:-350px; margin-top:25px;">
				<input type="text" class="form-control" name="answer" style="border:1px solid; width: 60%"><br>
				<input type="submit" class="btn btn-primary btn-lg" value="SUBMIT" style="margin-left:25%">
			</div>
		</form>
		</div>';
	?>
</body>
</html>
