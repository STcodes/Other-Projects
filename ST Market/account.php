<?php 

    $password = $email = $name = $customer_id = $message = "";
    $i = 0;
    $isSucces = true;

    if(!empty($_POST)){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(empty($name)){
            $isSucces = false;
            $message = "Email ou mot de passe incorrect. Veuillez reessayer.";
        }
        if(empty($email)){
            $isSucces = false;
            $message = "Email ou mot de passe incorrect. Veuillez reessayer.";
        }
        if(empty($password)){
            $isSucces = false;
            $message = "Email ou mot de passe incorrect. Veuillez reessayer.";
        }


        if($isSucces){

            require 'database.php';
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO customer(customer.name, customer.password, customer.email) VALUES (?,?,?)');
            $statement->execute(array($name,$password,$email));
            
            $db = Database::connect();
            $statement = $db->prepare('SELECT customer.id FROM customer WHERE customer.email = ? AND customer.password = ?');
            $statement->execute(array($email,$password));
            $i = $statement->fetch();
            $customer_id = $i['id'];
    
            Database::disconnect();
            header("Location: index.php?isconnect=1&&customer=$customer_id");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST Market</title>
    <link rel="shortcut icon" href="images/logo2.png">
    <link rel="stylesheet" href="style/styleconnect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="login-container">
        <img src="images/logo.png" alt="logo" id="login-logo">
        
        <form action="account.php"  method=post>
            <h2>Creez un compte</h2>
            <div>
                <div class="login-input">
                    <label for="name">Nom</label>
                    <input type="text" name="name">
                </div>

                <div class="login-input">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                </div>

                <div class="login-input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                </div>
            </div>

            <div id="message"> <?php echo ''.$message.'' ?> </div>

            <button type="submit">Enregistrer</button>
        </form>
        <div id="account">
            Vous avez deja un compte, <a href="connexion.php"> Connectez-vous </a>
        </div>
    </div>
</body>
</html>