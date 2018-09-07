<?php
// process.php

header("Access-Control-Allow-Origin: *"); // You can remove this if cross origin is not needed

header("Content-Type:application/json");


require_once('meekrodb.2.3.class.php');

// Change this to your DB credentials as needed
DB::$user = 'root';
DB::$password = 'root';
DB::$dbName = 'testdb';


date_default_timezone_set("America/New_York");
$current_date = date('Ymd');
$current_time = time();


$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data


$first_name         = $_POST['first_name'];
$last_name          = $_POST['last_name'];
$email              = $_POST['email'];
$zip                = $_POST['zip'];
$phone              = $_POST['phone'];
$age                = $_POST['age'];
$recaptcha          = $_POST['recaptcha'];
$captcha_secret_key = '6LcEHG8UAAAAAFbE3g84l8Eq1913UHP0032f-B3-'; // Change this as needed (the current one works on localhost)


// Form validation ==============================================================

if (empty($first_name)) {
    $errors['first_name'] = 'Please enter your first name';
}
if (empty($first_name)) {
    $errors['last_name'] = 'Please enter your last name';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required.';
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Please enter a valid email';
}

if(isset($age) == false){
    $errors['age'] = 'Please confirm your age.';
}

if (empty($recaptcha)) {
    $errors['recaptcha'] = 'Please check captcha';
}

// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean or false
if ( ! empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;

} else {

    // if no items in errors array    

    // CURL TO VALIDATE RECAPTCHA
    function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    $verifyResponse = file_get_contents_curl('https://www.google.com/recaptcha/api/siteverify?secret=' . $captcha_secret_key . '&response=' . $recaptcha);
    $responseData   = json_decode($verifyResponse);
    
    // IF reCAPTCHA RETURNS POSITIVE RESPONSE
    if ($responseData->success) {
        
        $data['success'] = true;
        $data['message'] = 'Success';

        // Insert into DB
        DB::insert('registered_users', array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'zip' => $zip,
            'phone' => $phone,
            'reg_date' => $current_date
        ));


    } else {
    // IF reCAPTCHA VALIDATION FAILS
        $data['message'] = 'robot_verification_failed';
    }

    $data['captcha_message'] = $responseData;

}
echo json_encode($data);

// return all our data to an AJAX call