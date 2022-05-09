<?php

class Nonce {
	/**
	 * Generate a Nonce. 
	 * 
	 * The generated string contains four tokens, seperated by a colon.
	 * The first part is the salt. 
	 * The second part is the form id.
	 * The third part is the time until the nonce is invalid.
	 * The fourth part is a hash of the three tokens above.
	 * 
	 * @param $length: Required (Integer). The length of characters to generate
	 * for the salt.
	 * 
	 * @param $form_id: Required (String). form identifier.
	 * 
	 * @param $expiry_time: Required (Integer). The time in minutes until the nonce 
	 * becomes invalid. 
	 * 
	 * @return string the generated Nonce.
	 *
	 */

	/**
	 * Verify a Nonce. 
	 * 
	 * This method validates a nonce
	 *
	 * @param $nonce: Required (String). This is passed into the verifyNonce
	 * method to validate the nonce.
	 *  
	 * @return boolean: Check whether or not a nonce is valid.
	 * 
	 */

    //generate salt
    private function generateSalt($length = 10){
        //set up random characters
        $chars='1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        //get the length of the random characters
        $char_len = strlen($chars)-1;
        //store output
        $output = '';
        //iterate over $chars
        while (strlen($output) < $length) {
            /* get random characters and append to output till the length of the output 
             is greater than the length provided */
            $output .= $chars[ rand(0, $char_len) ];
        }
        //return the result
        return $output;
    }
    //hash tokens and return nonce
    public function generateNonce($length, $form_id, $expiry_time){
        //generate our salt
        $salt = self::generateSalt($length);
        //hash the form id
        $form = $form_id;
        //set the time in seconds
        $time = time() + (60 * intval($expiry_time));
        //generate a token to hash
        $toHash = $salt.$form.$time;
        //send this to the user
        $nonce = $salt .':'.$form.':'.$time.':'.hash('sha256', $toHash);

        return $nonce;
    }
    //verify nonce
    public function verifyNonce($nonce){
        //split the nonce using our delimeter : and check if the count equals 4
        $split = explode(':', $nonce);
        if(count($split) !== 4){
            return false;
        }
        //reassign variables
        $salt = $split[0];
        $form = $split[1];
        $time = intval($split[2]);
        $oldHash = $split[3];
        //check if the time has expired
        if(time() > $time){
            return false;
        }
        //check if the nonce is valid by rehashing and matching it with the $oldHash
        $toHash = $salt.$form.$time;
        $reHashed = hash('sha256', $toHash);
        //match with the token
        if($reHashed !== $oldHash){
            return false;
        }
        return true;
    }
}

?>