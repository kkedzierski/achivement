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
    if ($password != $confirm_password || empty($confirm_password)){
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

    if ($validation_correct){

        require_once 'db.php';

        $db = get_db();

        $users_query = $db->query("SELECT * FROM users");
        $users = $users_query->fetchAll();
        $email_exist = false;
        foreach($users as $user){
            if($user['email']==$email){
                $email_exist = true;
            }
        }

        if($email_exist){
            $_SESSION["email_exist"] = $email;
            header('Location: ../register.php');
            exit();
        }else{
            try{
                $pass_hash = password_hash($password, PASSWORD_DEFAULT);

                $query = $db->prepare("INSERT INTO users VALUES (NULL, :email, :password)");
                $query->bindValue(':email', $email, PDO::PARAM_STR);
                $query->bindValue(':password', $pass_hash, PDO::PARAM_STR);
                $query->execute();
            }catch(PDOException $error){
                exit('Something went wrong - user cannot be added'); 
            }
            header('Location: ../index.php');
            exit();

        }

    }else{
        header('Location: ../register.php');
    }
    




