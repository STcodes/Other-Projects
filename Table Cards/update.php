<?php
    require "database.php";

    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);
    }

    $reussi = $tableError = $dateError = $heuredError = $heurefError = $table = $date = $heured = $heuref =  "";

    if(!empty($_POST)){

        
        $id = checkInput($_POST['id']);

        $table = checkInput($_POST['table']);
        $date = checkInput($_POST['date']);
        $heured = checkInput($_POST['heured']);
        $heuref = checkInput($_POST['heuref']);
        $isSuccess = true;

        if(empty($table)) 
        {
            $tableError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($date)) 
        {
            $dateError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($heured)) 
        {
            $heuredError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($heuref)) 
        {
            $heurefError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if($heured > $heuref){
            $heuredError = "Veulliez entrer des heures valides";
            $heurefError = "Veulliez entrer des heures valides";
            $isSuccess = false;
        }

        $dc= Database::connect();
        $m = $dc->prepare('SELECT card.heured, card.heuref FROM card WHERE card.table = ? AND card.date = ?');
        $m->execute(array($table, $date));
        while($c = $m->fetch()){
            if(($heured >= $c['heured'] AND $heured <= $c['heuref']) OR ($heuref >= $c['heured'] AND $heuref <= $c['heuref']) OR ($heured <= $c['heured'] AND $heuref >= $c['heuref'])){
                $isSuccess = false;
                $reussi = "Cette table est deja reservee a cette periode de la journee";
            }
        }
        Database::disconnect();


        if($isSuccess){
            $db = Database::connect();
            $statement = $db->prepare('UPDATE card SET card.table = ?, card.date = ?, card.heured = ?, card.heuref = ? WHERE id = ? ');
            $statement->execute(array($table,$date,$heured,$heuref,$id));
            Database::disconnect();
            $reussi = "Reservation Modifiee avec succes";
        }
    }
    else{
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM card where id = ?");
        $statement->execute(array($id));
        $card = $statement->fetch();
        $table       = $card['table'];
        $date        = $card['date'];
        $heured      = $card['heured'];
        $heuref      = $card['heuref'];
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
                <h1 style="color:#45AFDB; margin: bottom 10px;">Modifier une reservation</h1>
                <br>
                <form class="form" action="update.php" role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <div class="form-group">
                        <label for="table" style="color:white; font-size: 1.1rem;">Numero de table :
                        <input type="text" class="code" id="save" name="table"  autocomplete="off" value="<?php echo $table; ?>">
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $tableError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="date" style="color:white; font-size: 1.1rem;">Date de reservation :
                        <input type="date" class="code" id="save" name="date" autocomplete="off" value="<?php echo $date; ?>"> 
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $dateError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="heured" style="color:white; font-size: 1.1rem;">Heure de debut :
                        <input type="time" class="code" id="save" name="heured" autocomplete="off" value="<?php echo $heured; ?>"> 
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $heuredError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="heuref" style="color:white; font-size: 1.1rem;">Heure de fin :
                        <input type="time" class="code" id="save" name="heuref" autocomplete="off" value="<?php echo $heuref; ?>"> 
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $heurefError;?></span>
                    </div>
                    
                    <div class="form-actions">
                        <a class="btn btn-primary deln return" href="index.php" style="border: black; border-radius: 10px; padding: 9.8px; background-color: red; font-size: 1rem; color: white;"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        <button onmouseover="this.style.transform='scale(1.1)'; this.style.transition= '0.4s'; this.style.opacity='0.9';" onmouseout="this.style.transform='scale(1)'; this.style.transition= '0.4s'; this.style.opacity='0.9';" class="search" type="submit"  style="border-radius: 10px; padding: 10px 10px; background-color: green; font-size: 1rem; color: white; margin-top:10px; transform:translateY(2.5px);"><i class="fa fa-user"></i> Modifier</button>
                   </div>
                   <span class="help-inline" style="color:green;display: flex; flex-direction: columns; margin-top:5px; font-weight:bold;"><?php echo $reussi; ?></span>
                </form>
            </div>
    </div>
    
    <footer> &copy; <b> Copyrigth R PRO associates 2022 All Rights Reserved </b></footer>
    <script src="js/nav.js"></script>
</body>
</html>