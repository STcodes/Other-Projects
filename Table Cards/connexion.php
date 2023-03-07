<?php 
    require "database.php";

    $nom = $password = $Errornom = $Errorpassword = $Error = "";
    $isSucces = true;

    if(!empty($_POST)){

        $nom = checkInput($_POST['nom']);
        $password = checkInput($_POST['password']);
        
        if(empty($nom)){
            $Errornom = "Veuillez entrez votre nom";
            $isSucces = false;
        }

        if(empty($password)){
            $Errorpassword = "Veuillez entrez votre mot de passe";
            $isSucces = false;
        }

        $i = 0;

        if($isSucces){
            $db = Database::connect();
            $statement = $db->prepare('SELECT client.id FROM client WHERE client.name = ? AND client.password = ?');
            $statement->execute(array($nom,$password));
            while($stat = $statement->fetch()){
                $client = $stat['id'];
                $i++;
            }
            if($i==0){
                $Error = "Nom ou Mot de passe incorrect";
            }else{
                header("Location: clientindex.php?client=$client");
            }
            Database::disconnect();
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
    <link rel="stylesheet" href="style/connexion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="images/logo.png">
</head>
<body>
    <div id="container">
        <img  id="logo" src="images/logo1.png">
        <h2><span id="log">Log</span><span id="in">in</span></h2>
        <span id="ligne"></span>
        <form action="connexion.php" method="POST">
            <div class="input-box">
                <i class="fa fa-user"></i>`
                <input type="text" name="nom" placeholder="Username" id="user" autocomplete="off">
            </div>
            <div style="color:red;"><?php echo $Errornom; ?></div>
            <div class="input-box">
                <i class="fa fa-key"></i>
                <input type="password" name="password" placeholder="Password" id="pass">
                <span id="eye" onclick="myfunction()">
                    <i id="hide1" class="fa fa-eye"></i>
                </span>
            </div>
            <div style="color:red;"><?php echo $Errorpassword; ?></div>
            <button type = "submit" name="connecter">Log in</button>
            <div id="message"  style="color:red;"><?php echo $Error; ?></div>
        </form>
        <a href="signup.php" style="float:right; color:white; font-weight:bold; margin:5px 0px 0px 80%; font-size:1.1rem;">Sign up</a>
    </div>
    <footer> &copy; <b> Copyrigth R PRO associates 2022 All Rights Reserved </b></footer>
    <script src="js/connexion.js"></script>
</body>
</html>