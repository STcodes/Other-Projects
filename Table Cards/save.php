<?php
    require "database.php";

    $reussi = $heuredError = $heurefError = $heured = $heuref = $dateError = $evenementError = $code = $client = $table = $date = $evenement = "";

    if(!empty($_GET['client'])){
        $client = $_GET['client'];
    }
    
    if(!empty($_POST)){
        
        
        $date = checkInput($_POST['date']);
        $heured = checkInput($_POST['heured']);
        $heuref = checkInput($_POST['heuref']);
        $evenement = checkInput($_POST['evenement']);
        $isSuccess = true;
        
        
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
        if(empty($evenement)) 
        {
            $evenementError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if($heured > $heuref){
            $heuredError = "Veulliez entrer des heures valides";
            $heurefError = "Veulliez entrer des heures valides";
            $isSuccess = false;
        }
        

        //code
        $am = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        $aM = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        $i = 0;
        while($i < 7){
            $a = rand(1,3);
            if($a == 1){
                $code =  "".$code."".$am[rand(0,25)]."";
            }
            if($a == 2){
                $code =  "".$code."".$aM[rand(0,25)]."";
            }
            if($a == 3){
                $code =  "".$code."".rand(0,9)."";
            }
            $i++;
        }

        //----table
        $a = Database::connect();
        $b = $a->prepare('SELECT card.table FROM card WHERE card.date = ? AND (? >= card.heured AND ? <= card.heuref) OR (? >= card.heured AND ? <= card.heuref) OR (? <= card.heured AND ? >= card.heuref)');
        $b->execute(array($date,$heured,$heured,$heuref,$heuref,$heured,$heuref));
        $i = 1;
        $j = false;
        $k = 1;
        
        while($i <= 80){
            while($c = $b->fetch()){
                $x = $c['table'];
                if($i == $x){
                    $j = false;
                    break;
                }else{
                    $j = true;
                    $k = $i;
                }
            } 
            if($j == true){
                $table = $k;
                $i = 100;
            }
            if($k == 80 && $j == false){
                $isSuccess = false;
                $reussi = "Toutes les tables sont deja reserves a cette periode de ce jour";
            }
            $i++;  
        }
        Database::disconnect();

        if($isSuccess){
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO card(card.code,card.client,card.table,card.heured,card.heuref,card.date,card.evenement) values(?, ?, ?, ?, ?, ?, ?)');
            $statement->execute(array($code,$client,$table,$heured,$heuref,$date,$evenement));
            Database::disconnect();
            $reussi = "Reservation enregistree avec succes";
            header("Location: clientindex.php?client=$client");
        }
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
    <?php require "navclient.php"; 
        echo'
        <script language="Javascript">
            const liste = document.getElementById("L");
            const save = document.getElementById("S");

            save.style.color = "#79f8f8";
            save.classList.add("ad");
        </script>               
        ';
    ?>
   
    <div class="container sup">
            <div class="row">
                <h1 style="color:#45AFDB; margin: bottom 10px;">Enregistrer une reservation</h1>
                <br>
                <form class="form" action="save.php?client=<?php echo $client; ?>" role="form" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <input type="date" class="code" id="save" name="date" placeholder="01/01/2022" autocomplete="off">
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $dateError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="heured" style="color:white; font-size: 1.1rem;">Heure de debut :
                        <input type="time" class="code" id="save" name="heured" autocomplete="off"> 
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $heuredError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="heuref" style="color:white; font-size: 1.1rem;">Heure de fin :
                        <input type="time" class="code" id="save" name="heuref" autocomplete="off"> 
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $heurefError;?></span>
                    </div>
                    <div class="form-group" style="color: white;">
                        <input type="text" class="code" id="save" name="evenement" placeholder="Evenement de reservation" autocomplete="off">
                        <span class="help-inline" style="color:red; display: flex; flex-direction: columns;"><?php echo $evenementError;?></span>
                    </div>
                    <div class="form-actions">
                        <a class="btn btn-primary deln return" href="clientindex.php?client=<?php echo $client; ?>" style="border: black; border-radius: 10px; padding: 9.8px; background-color: red; font-size: 1rem; color: white;"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        <button onmouseover="this.style.transform='scale(1.1)'; this.style.transition= '0.4s'; this.style.opacity='0.9';" onmouseout="this.style.transform='scale(1)'; this.style.transition= '0.4s'; this.style.opacity='0.9';" class="search" type="submit"  style="border-radius: 10px; padding: 10px 10px; background-color: green; font-size: 1rem; color: white; margin-top:10px; transform:translateY(2.5px);"><i class="fa fa-user"></i> Enregistrer</button>
                   </div>
                   <span class="help-inline" style="color:green;display: flex; flex-direction: columns; margin-top:5px; font-weight:bold;"><?php echo $reussi; ?></span>
                </form>
            </div>
    </div>
    


    <footer> &copy; <b> Copyrigth R PRO associates 2022 All Rights Reserved </b></footer>
    <script src="js/nav.js"></script>
</body>
</html>