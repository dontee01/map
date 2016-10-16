<?php

$sess_name = session_name('map');
// session_set_cookie_params(0, '/', '.mangruf.com');
session_start();
//error_reporting(0);
include_once '../res/include/template.mangruf.class.php';
include_once '../res/include/htmltemp.class.php';
include_once '../res/include/mangrufcon.php';
include_once '../res/include/attempt-func.php';
$mangruf = new template(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$html = new htmltemp();
$mangruf->connect();
$main = $mangruf->time();
$conv = $mangruf->timeOnly();
$title_page = "Sign up";
$out = '';
$ref = '';

// $conn = mysql_connect('localhost','admin','admin1','bbn');
// $db = mysql_select_db('bbn');

define('ATTEMPT', 3);

if (isset($_POST['reg'])){
$username = $mangruf->clean($_POST['username']);
	$email = $mangruf->clean($_POST['email']);
    $pass = $mangruf->clean($_POST['password']);
    $confirm = $mangruf->clean($_POST['confirm']);
    $hashh = $mangruf->hashh($main);
    // $fn = $mangruf-ucaseWord($fn);
    if ($username == "" || $email == "" || $pass == "" || $confirm == ""){
            $out = "Fill in all fields";
        }
        // validate email field
        else if (! filter_var($email, FILTER_VALIDATE_EMAIL))
        {
        	$out = "Enter a correct email address";
        }
        else if ($pass != $confirm)
        {
        	$out = "Password mismatch";
        }
        else{
	//Create query
        	$qr = "SELECT * FROM users WHERE email = '$email' ";
                $run = $mangruf->query($qr);
                $row = $mangruf->rows($run);
                if ($row > 0){
                    $chk = 0;
                }else{
                    $chk = 1;
                }
        	// $chk = $mangruf->chkExist('users', 'phone', '$fone');

        	if ($chk == 0)
        	{
        		$out = "Email exists!!";
        	}
        	else if ($chk == 1)
        	{
            $enc_pass = password_hash($pass, PASSWORD_DEFAULT);
            $token = $mangruf->tokenGenerator(6);
			$qry="INSERT INTO users(hashh, username, email, password, token, created ) VALUES('$hashh', '$username', '$email', '$enc_pass', '$token', '$main' ) ";
                        // $mangruf->redirect($_SERVER['PHP_SELF']);
                        // usleep(2000);
            // print_r($username);exit;
                $rs = $mangruf->query($qry);
                // var_dump($rs);exit;
                 // or die;
                if ($rs){
                    $verification_link = 'localhost/adbl/verify.php?token='.$hashh.'';
                    // $mail = sendEmailToken($email, $token, $verification_link, 'MAP Account Verification');
                    $out = "success";
                }
                else{
                    $out = 'error';
                }
            }
        }
	}


if (isset($_POST['signin'])){
    $username = $mangruf->clean($_POST['username']);
    $pass = $mangruf->clean($_POST['password']);
    $hashh = $mangruf->hashh($main);
    if ($username == "" || $pass == "" ){
            $out = "Fill in all fields";
        }
        else{
            $qr = "SELECT * FROM users WHERE username = '$username' ";
                $run = $mangruf->query($qr);
                $row = $mangruf->rows($run);
                if ($row > 0){
                    $fetch = $mangruf->fetch($run);
                    if ($fetch['verified'] == 0){
                        $out = 'Account not yet verified, check your registered email for verification link';
                    }
                    else{
                        $match = password_verify($pass, $fetch['password']);
                        if (! $match)
                        {
                            $out = 'Login Failed';
                        }
                        else
                        {
                            $_SESSION['user_id'] = $fetch['id'];
                            $out = "success";
                        }
                    }
                    // print_r($fetch);exit;

                }
                else{
                    $out = 'Login Failed';
                }

        }
    }
echo $out;
	// echo '<div align="center" class="alert alert-warning alert-dismissable mw800 center-block">
 //            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" color="blue">x</button>'.$out.
 //            '</div>';



    function sendEmailToken($email, $token, $verification_link = "", $email_subject = "Account Verification")
    {
        $from = "johntobby02@gmail.com";
        $to = $email;
//         $email_subject = "Account Verification";
        

//         $signup_message = <<<EOF
        $signup_message = '<div>'.$token.'</div><div><a href="'.$verification_link.'">Verify</a></div>';
        
// EOF;
        
        // global $email_from,$email_subject;
        $headers = 'From: MAP <'.$from . ">\r\n" .
            'Reply-To: '.$to . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
         $headers .= "MIME-Version: 1.0\r\n";
         $headers .= "Content-type: text/html\r\n";
        
        mail($to, $email_subject, $signup_message, $headers);
        
    }