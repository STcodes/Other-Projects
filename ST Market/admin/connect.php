<?php 

    $password = $name = $user_name = $user = $message = "";
    $i = 0;

    if(!empty($_POST)){
        $name = $_POST['name'];
        $password = $_POST['password'];
        
        require 'database.php';
        $db = Database::connect();
        $statement = $db->prepare('SELECT user.name FROM user WHERE user.name = ? AND user.password = ?');
        $statement->execute(array($name,$password));
        while($user = $statement->fetch()){
            $i++;
            $user_name = $user['name'];
        }
        Database::disconnect();
        
        if($i == 0){
            $message = "Nom ou mot de passe incorrect. Veuillez reessayer.";
        }else{
            header("Location: index.php?user=$user_name");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST Market-Admin</title>
    <link rel="shortcut icon" href="../images/logo2.png">
    <link rel="stylesheet" href="../style/styleconnect.css">
    
</head>
<body>
    <div id="login-container">
        <img src="../images/logo.png" alt="logo" id="login-logo">
        
        <form action="connect.php"  method=post>
            <h2>Se connecter</h2>
            <div>
                <div class="login-input">
                    <label for="name">Nom</label>
                    <input type="text" name="name">
                </div>

                <div class="login-input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                </div>
            </div>

            <div id="message"> <?php echo ''.$message.'' ?> </div>

            <button type="submit">Valider</button>
        </form>
    </div>
</body>
</html>