<?php

  session_start();
  require_once "config/db.php";

  if (!isset($_SESSION['is_logged'])){
    header('Location: index.php');
    exit();
  }else{
    $db = get_db();
    $achivements_query = $db->prepare('SELECT * FROM achivements WHERE user= :user_id');
    $achivements_query->bindValue(':user_id', $_SESSION['is_logged'], PDO::PARAM_INT);
    $achivements_query->execute();
    $achivements = $achivements_query->fetchAll();
  }


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
    <meta charset="UTF-8">
    <title>Achivement</title>
</head>

<body>
    
    <!-- 17 do 01.pażdziernika | Rozdział mający 15 stron a4
    Ang do 31.grudnia | Znajomość 500 słówek
    5000 31.grudnia | Po inwestycjach na handlu mieć na koncie 5000zł zysków bilansu inwestycji
    350km 31.grudnia | Prześć tyle kilometrów na spacerach z psem monitorowanych przez aplikację
    Achivement 01.lipiec | Strona ze spisanymi rzeczami do zrobienia i możliwością ich zakończenia
    Focus 01.października | umiejętność ciągłej koncentracji na jednej rzeczy przez 5 minut.
    MadMax Mord w OrEx 01.lipca | Obejrzeć
    Shadow of Mordor 01.lipca | Przejść
    Czas pogardy 01.lipca | Przeczytać

    Filmy
    Nietykalni - 31.06
    12 Gniewnych ludzi 31.07
    Parasite 31.07
    Bohemian Raphsody 31.07
    Trzy bilboardy za Embing 31.08
    Full Metal Jacket 31.08
    Lśnienie 31.09
    Wołyń 31.09
    Iluzionista 10
    Samsara 10
    -->
    
    <div class="container">
    <button class="btn btn-lg btn-primary mt-2 float-right"><a class="text-white" href="config/logout.php">Logout</a></button>
        <div class="row mb-3"><h1>Achivements</h1></div>
<!--         
        <div class="row align-items-center">
            <div class="col-2 px-0">
            <button class="btn btn-block btn-primary btn-lg" onclick="del();">
                ->
            </button></div>
            <div class="col-7 px-1">Obejrzeć film Parasite</div>
            <div class="col-3 px-0 myright">02.07.20</div>
        </div>
        <hr>
        <div class="row align-items-center">
            <div class="col-2 px-0">
            <button class="btn btn-block btn-success btn-lg" onclick="del();">
                :)
            </button></div>
            <div class="col-7 px-1"> <s>Obejrzeć film Parasite Obejrzeć film Parasite Obejrzeć film Parasite</s></div>
            <div class="col-3 px-0 myright"><s>02.07.20</s></div>
        </div>
        <hr> -->

        <div id="New">
        <?php
          foreach($achivements as $achivement){
            echo $achivement['achivement']."\n";
          }
        ?>
        </div>
    </div>
    
    <div class="container py-1">
        <div class="row">
            <button class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#AddAchiv">+</button>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="AddAchiv" tabindex="-1" role="dialog" aria-labelledby="AddAchiv" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Dodawanie Osiągnięcia zuęcua czueca zuecua</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="config/achivement_operations.php">
            <div class='row mycenter mt-3 mb-3'><div class="col"><input type='text' name="achivement" class='inputback' id='achiv' placeholder="Co do osiągnięcia?"></div></div>
            <div class='row mycenter mb-3'><div class="col"><input type='date' name="achivement_date" class='inputback' id='date'></div></div></div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="add();">Save changes</button>
        </div>
        </form>

      </div>
    </div>
  </div>

</body>
</html>
