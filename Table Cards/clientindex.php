<?php
    if(!empty($_GET['client'])){
        $client = $_GET['client'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation's Cards</title>
    <link rel="stylesheet" href="style/boostrap/css/bootstrap.min.css">
    <script src="style/boostrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require "navclient.php";

        echo'
        <script language="Javascript">
            const liste = document.getElementById("L");
            const rech = document.getElementById("R");
            const save = document.getElementById("S");

            liste.style.color = "#79f8f8";
            liste.classList.add("ad");
        </script>               
        ';
    ?>
    <section class="container" style="background-color:transparent;">
    
            <?php
                require "database.php";
                $db = Database::connect();
                $a = $db->prepare('SELECT DISTINCT card.date FROM card WHERE card.client = ? ORDER BY card.date DESC');
                $a->execute(array($client));
                while($d = $a->fetch()){
                    echo'<div style="background-color:rgba(186,186,186,0.8); padding:3px 10px; border-radius: 10px; margin-top: 3rem;">';
                    echo'<h2 class="container"style="font-size: 1.2rem; color: black; font-weight:bold;" >'.$d['date'].'</h2>';
                    echo'<table class="table table-striped  container" border-radius: 10px;>
                        <thead style="background: rgba(0, 0, 0, 0.7);">
                            <tr>
                                <th width = "fit-content">Code</th>
                                <th width = "fit-content">Numero de table</th>
                                <th width = "fit-content">Intervalle de duree</th>
                                <th width = "fit-content">Evenement de reservation</th>
                                <th width=300px>Actions</th>
                            </tr>
                        </thead>
                    <tbody style="background-color:#585858;">';
                    $statement =$db->prepare("SELECT card.id, card.code,card.table,card.heured,card.heuref,card.evenement FROM card WHERE card.date = ? AND card.client = ? ORDER BY card.table ASC");
                    $statement->execute(array($d['date'], $client));
                    while($card = $statement->fetch()){
                        echo '<tr>';
                        echo '<td>'. $card['code'] . '</td>';
                        echo '<td>'.$card['table'].'</td>'; 
                        echo '<td> '.$card['heured'].'-'.$card['heuref'].'</td>'; 
                        echo '<td>'.$card['evenement'].'</td>';
                        echo '<td "style= width:fit-content;">';
                        echo '  <a class="see"  onmousover="this.style.transition="0.4s"; this.style.opacity="0.7";"  href="view.php?id='.$card['id'].'" style="color: white;background-color: gray;font-style: 1rem;padding: 5px;margin: 0 5px;border: 2px solid black;border-radius: 5px;">Voir</a>';
                        echo '  <a class="update" href="updateclient.php?id='.$card['id'].'&client='.$client.'">Modifier</a>';
                        echo '</td>';
                        echo '</tr>';
                     }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
                Database::disconnect();
             ?>
    </section>   
    <footer> &copy; <b> Copyrigth R PRO associates 2022 All Rights Reserved </b></footer>
    <script src="js/nav.js"></script>
    <script language=Javascript>
        const liste = document.getElementById("L");
        const rech = document.getElementById("R");
        const view = document.getElementById("V");

        liste.style.color = "#45AFDB";
        rech.style.color = "white";
        view.style.color = "white";
    </script>
</body>
</html>