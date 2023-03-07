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
</head>
<body>
    <?php require "nav.php"; 
        echo'
        <script language="Javascript">
            const liste = document.getElementById("L");
            const rech = document.getElementById("R");
            const save = document.getElementById("S");

            rech.style.color = "#79f8f8";
            rech.classList.add("ad");
        </script>               
        ';
    ?>
    
    
    <div class="container sup">
            <div class="row">
                <h1><strong style="color:#45AFDB;">Chercher une reservation</strong></h1>
                <br>
                <form class="form" action="search.php" role="form" method="post">
                    <p class="alt">Entrez le code de la reservation</p>
                    <div class="form-actions">
                      <input type="text" placeHolder="Code" name="code" class="code" autocomplete="off">
                    </div>
                    <a class="btn btn-default deln return" href="index.php" style="border-radius: 10px; padding: 9.5px; background-color: red; font-size: 1rem; color: white;">Retour</a>
                    <button class="search" type="submit" style="border-radius: 10px; padding: 10px; background-color: green; font-size: 1rem; color: white; margin-bottom:1px;"><i class="fa fa-user"></i>Rechercher</button>
                </form>
            </div>
    </div> 

    <?php
        require "database.php";

        if(!empty($_POST)) 
        {
            $code = checkInput($_POST['code']);
            $db = Database::connect();
            $statement = $db->prepare("SELECT card.id,card.code, client.name,card.table,card.heured,card.heuref,card.date,card.evenement FROM card INNER JOIN client ON card.client = client.id WHERE card.code = ?");
            $statement->execute(array($code));
            if($card = $statement->fetch()){
                echo '<table class="table table-striped container" style="margin-top:20px;">
                    <thead style="background: rgba(0, 0, 0, 0.7);">
                        <tr>
                            <th width = "fit-content">Code</th>
                            <th width = "fit-content">Client</th>
                            <th width = "fit-content">Numero de table</th>
                            <th width = "fit-content">Date</th>
                            <th width = "fit-content">Intervalle de duree</th>
                            <th width = "fit-content">Evenement de reservation</th>
                            <th width=300px>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:#585858">';
                     echo '<tr>';
                     echo  '<th>'.$card['code'].'</th>';
                     echo  '<th>'.$card['name'].'</th>';
                     echo  '<th>'.$card['table'].'</th>';
                     echo  '<th>'.$card['date'].'</th>';
                     echo '<td> '.$card['heured'].'-'.$card['heuref'].'</td>';
                     echo  '<th>'.$card['evenement'].'</th>';
                     echo '<td "style= width:fit-content;">';
                     echo '  <a class="see"  onmousover="this.style.transition="0.4s"; this.style.opacity="0.7";"  href="view.php?id='.$card['id'].'" style="color: white;background-color: gray;font-style: 1rem;padding: 5px;margin: 0 5px;border: 2px solid black;border-radius: 5px;">Voir</a>';
                     echo '  <a class="update" href="update.php?id='.$card['id'].'">Modifier</a>';
                     echo '  <a class="delete" href="delete.php?id='.$card['id'].'">Supprimer</a>';   
                     echo '</td>'; 
                     echo '</tr>
                    </tbody>
                </table>';
            }
            else{
                echo '<div class="container" style="color:red; margin-top:10px; font-size:1.2rem; font-weight:bold;">Pas de Reservation associee a ce code</div>';
            }
            Database::disconnect();
        }

        function checkInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <footer> &copy; <b> Copyrigth R PRO associates 2022 All Rights Reserved </b></footer>
    <script src="js/nav.js"></script>
</body>
</html>