<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="src/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/css/AStyle.css">
    <script src="src/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="UTF-8">
    <title>Achivement-registration</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mt-5">
                <h1>Register</h1>
            </div>
            <div class="col-lg-12">
                <form method="POST" action="config/register_user.php">
                    <div class="form-group">
                        <label for="name">E-mail: </label>
                        <input type="email" class="form-control" id="name" name="email">
                        <?php
                            if (isset($_SESSION['error_email'])){
                                echo '<span style="color: red">Give correct e-mail adress </span>';
                                unset($_SESSION['error_email']);
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" class="form-control" id="password" name="pass">
                        <?php
                            if (isset($_SESSION['error_password'])){
                                echo '<span style="color: red"> Password must more or equal to 8 character and less or equal than 20 </span>';
                                unset($_SESSION['error_password']);
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm password: </label>
                        <input type="password" class="form-control" id="confirm_password" name="conf_pass">
                        <?php
                            if (isset($_SESSION['error_confirm_password'])){
                                echo '<span style="color: red">Password must be identical!</span>';
                                unset($_SESSION['error_confirm_password']);
                            }
                        ?>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LcD5a0ZAAAAAKfWaKACi876G8k1vr9LPNWQDr_A"></div> 
                    <?php
                            if (isset($_SESSION['error_recaptcha'])){
                                echo '<span style="color: red">'.$_SESSION['error_recaptcha'].'</span>';
                                unset($_SESSION['error_recaptcha']);
                            }
                        ?>
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-success btn-block btn-lg" value="Zarejestruj się">
                    </div>
                </form>
                <a class="btn btn-success" href="index.php">I have account - login</a>
            </div>
        </div>
    </div>
</body>
</html>