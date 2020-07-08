<?php

    session_start();
    require_once 'db.php';

    if (isset($_POST['achivement'])){

        $achivement_text = filter_input(INPUT_POST, 'achivement');
        $achivement_date = filter_input(INPUT_POST, 'achivement_date');

        achivement_add_to_db($_SESSION['is_logged'], $achivement_text, $achivement_date);
    }

    function achivement_add_to_db($user_id, $achivement, $achivement_date){
        
        try{
    
            $db = get_db();

            $query = $db->prepare("INSERT INTO achivements VALUES (NULL, :user, :achivement, :date_do_pass, :is_done)");
            $query->bindValue(':user', $user_id, PDO::PARAM_INT);
            $query->bindValue(':achivement', $achivement, PDO::PARAM_STR);
            $query->bindValue(':date_do_pass', $achivement_date, PDO::PARAM_STR);
            $query->bindValue(':is_done', false, PDO::PARAM_BOOL);
            $query->execute();


            }catch(PDOException $error){
                exit('Something went wrong - achivment cannot be added'); 
            }
            back_to_page();
        }

    function back_to_page(){
        header('Location: ../achivements.php');
        exit();
    }


    