<?php
    session_start();

    require_once 'db.php';

    if (isset($_POST['login'])){

        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');

        $user_query = $db->prepare('SELECT id, password FROM users WHERE email= :email');
        $user_query->bindValue(':email', $login, PDO::PARAM_STR);
        $user_query->execute();

        $user = $user_query->fetch();

        if ($user && password_verify($password, $user['password'])){
            $_SESSION['is_logged'] = $user['id'];
            unset($_SESSION['error_login']);
            header('Location: ../index.php');
            exit();

        }else{
            $_SESSION['error_login'] = $login;
            header('Location: ../index.php');
            exit();

        }
        }else{
            header('Location: ../index.php');
            exit();
    }