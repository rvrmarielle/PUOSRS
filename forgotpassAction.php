<?php

include 'db.php';

if(isset($_POST['forgotPass'])){
    $email = $_POST['email'];

    $emailCheckQuery = "SELECT * FROM members WHERE email = '$email'";
    $emailCheckResult = mysqli_query($db_link, $emailCheckQuery);

    if($emailCheckResult){
        if(mysqli_num_rows($emailCheckResult) > 0){
            $code = rand(999999,111111);
            $updateQuery = "UPDATE members SET reset_token = $code WHERE email = '$email'";
            $updateResult = mysqli_query($db_link,$updateQuery);

            if($updateResult){
                $subject = "Reset your Password";
                $message = "Hello! You can reset your password by entering this code, $code";
                $sender = "From: no.reply@puosrs.com";

                if (mail($email, $subject, $message, $sender)) {
                    $message = "The verification code has been sent to you by email $email";

                    $_SESSION['message'] = $message;
                    header('header: otp.php');
                }else{
                    $errors['otp_errors'] = 'Sending Failed!';
                }
            }else{
                $errors['db_errors'] = "Failed in inserting the data in the database!";
            }
        }else{
            $errors['invalidEmail'] = "We couldn't find an account with that Email address!";
        }
    }
}

if(isset($_POST['verify'])){
    $_SESSION['message'] = "";
    $reset_token = mysqli_real_escape_string($db_link, $_POST['reset_token']);
    $verifyQuery = "SELECT * FROM members WHERE reset_token = $reset_token";
    $runVerifyQuery = mysqli_query($db_link, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            $newQuery = "UPDATE members SET code = 0";
            header("location: newpass.php");
        }else{
            $errors['verification_error'] = "Failed";
        }
    }
}


?>