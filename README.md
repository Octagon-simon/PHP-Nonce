### PHP NONCE

This is a simple Class that you can use to generate a nonce, store a nonce and check the validity of a nonce using a server side secret.

### HOW TO USE

- Include the class into your project
- Create a new instance of the class

```php
require_once('nonce.php');
$nonce = new Nonce();
```

#### TO GENERATE A NONCE

- salt_length (int): This is the length of characters to generate for your salt. If no number is provided, it defaults to 10 random characters.
- form_id (string): This is the form Identifier that will be used to store the Nonce in the $_SESSION. 
- expiry_time (int): This is the time (in minutes) that the Nonce will last for.

```php
require_once('nonce.php');
$nonce = new Nonce();
$nonce->generateNonce($salt_length, $form_id, $expiry_time);

```

For Example, to generate a Nonce that will last for 10 minutes and with a salt of 25 characters for a login form, I will do something like this.

```html
<form method="post" id="form_login">
	<input type="hidden" name="_nonce" value="<?php echo $nonce->generateNonce(25, 'form_login', 10);?>">
	<button type="submit">submit</button>
</form

```

#### TO VALIDATE A NONCE

- nonce (string): This is the Nonce to validate

```php
require_once('nonce.php');
$nonce = new Nonce();
$nonce->verifyNonce($nonce);

```
- Validate a Nonce coming from a Form Submission

```php
require_once('nonce.php');
$nonce = new Nonce();

if(isset($_POST['_nonce'])){

	//check nonce
	if($nonce->verifyNonce($_POST['_nonce']) === true){
		//process form data here
	}else{
		echo "Token is invalid";
	}

}else{
	echo "A valid token is required";
}
```

### DEMO File

Open test.php contained in this folder in a local server and submit the form. Feel free to change the value of Nonce using inspect tool of your browser and submit the form.

### Learn More

Want to know how I built this simple Nonce? [Check out the article at medium](https://simon-ugorji.medium.com/how-to-create-a-simple-nonce-in-php-a5afe046beee)