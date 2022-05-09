<?php

require_once('nonce.php');

$nonce = new Nonce();

if(isset($_POST) && isset($_POST['_nonce']) && !empty($_POST['_nonce'])){

	//check nonce
	if($nonce->verifyNonce($_POST['_nonce']) === true){
		//process form data here
		echo '<span style="color:green;font-weight:bold;">Nonce is valid</span>';
	}else{
		//token is invalid
		echo '<span style="color:red;font-weight:bold;">Nonce is invalid</span>';
	}

unset($_POST);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simple Nonce in PHP</title>
</head>
<body>
	<form method="post" id="form_login">
		<input type="hidden" name="_nonce" value="<?php echo $nonce->generateNonce(25, 'form_login', 10); ?>">
		<input type="text" readonly value="Admin" style="display: block;margin-bottom: 15px;">
		<input type="password" readonly value="Adminifier" style="display: block;margin-bottom: 15px;">
		<button type="submit">submit</button>
	</form>
</body>
</html>
	