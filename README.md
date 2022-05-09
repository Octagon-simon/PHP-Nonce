### PHP NONCE

This is a simple Class that you can use to generate a nonce and check the validity of a generated nonce.

### HOW TO USE

- Include the class into your project
- Create a new instance of the class

```php
require_once('nonce.php');
$nonce = new Nonce();
```

#### TO GENERATE A NONCE

- salt_length (int): This is the length of characters to generate for your salt.
- form_id (string): This is the form Identifier.
- expiry_time (int): This is the time (in minutes) that the Nonce will last for.

```php
require_once('nonce.php');
$nonce = new Nonce();
$nonce->generateNonce($salt_length, $form_id, $expiry_time);

```

- Generate a Nonce that will last for 10 minutes and with a salt of 25 characters for a login form.

```html
<form method="post" id="form_login">
	<input type="hidden" name="_nonce" value="<?php echo $nonce->generateNonce(25, 'form_login', 10);?>">
	<button type="submit">submit</button>
</form

```

#### TO VALIDATE A NONCE

- nonce (string): This is the nonce to validate

```php
require_once('nonce.php');
$nonce = new Nonce();
$nonce->verifyNonce($nonce);

```
- Validate a Nonce coming from a Form

```php
require_once('nonce.php');
$nonce = new Nonce();

if(isset($_POST['_nonce'])){

	//check nonce
	if($nonce->verifyNonce($_POST['_nonce']) === true){
		//process form data here
	}else{
		//token is invalid
		echo "Token is invalid";
	}

}else{
	//token is required
	echo "A valid token is required";
}
```

### DEMO File

Open test.php contained in this folder in a local server and submit the form

### Learn More

Want to know how I built this simple Nonce? [Check out my blog at medium]()