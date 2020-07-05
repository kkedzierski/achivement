<?php

    session_start();

    $validation_correct = TRUE;

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'pass');
    $confirm_password = filter_input(INPUT_POST, 'conf_pass');

    // *** E-mail validation ***
    $email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($email_safe, FILTER_VALIDATE_EMAIL)==false) || ($email!=$email_safe)){
        $validation_correct = FALSE;
        $_SESSION['error_email'] = $email;
    }

    // *** Password validation ***
    if ( (strlen($password) < 8) || (strlen($password) > 20)){
        $validation_correct = FALSE;
        $_SESSION['error_password'] = $password;
    }

    // *** Confirm password validation ***
    if ($password != $confirm_password){
        $validation_correct = FALSE;
        $_SESSION['error_confirm_password'] = $confirm_password;
    }

    // *** reCaptcha validation ***
    $secret_key = "6LcD5a0ZAAAAAEl-8Dc4bqo0pDrkF_Hx2MbFIG3P";
    $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
    
    $json_respone = json_decode($verify);

    if(!($json_respone->success)){
        $validation_correct = FALSE;
        $_SESSION['error_recaptcha'] = "Confirm that you are not a bot";
    }

    header('Location: ../register.php');
    




