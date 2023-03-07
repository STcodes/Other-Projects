<?php
    require 'database.php';
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM card WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php"); 
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
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
</head>
<body>
    <?php require "nav.php"; 
        echo'
        <script language=Javascript>
            const liste = document.getElementById("L");
            const rech = document.getElementById("R");
            const view = document.getElementById("S");

            liste.style.color = "#79f8f8";
            liste.classList.add("ad");
        </script>               
        ';
    ?>
    <div class="container sup">
            <div class="row">
                <h1><strong style="color:#45AFDB;">Supprimer une reservation</strong></h1>
                <br>
                <form class="form" action="delete.php" role="form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alt">Etes vous sur de vouloir supprimer ?</p>
                    <div class="form-actions">
                      <button class="dely" type="submit" style="border-radius: 10px; padding: 10px; margin-right: 15px; background-color: green; font-size: 1rem; color: white;">Oui</button>
                      <a class="btn btn-default deln return" href="index.php" style="border-radius: 10px; padding: 10px; background-color: red; font-size: 1rem; color: white;">Non</a>
                      
                    </div>
                </form>
            </div>
    </div> 
    
    <footer> &copy; <b> Copyrigth R PRO associates 2022 All Rights Reserved </b></footer>
    <script src="js/nav.js"></script>
</body>
</html>