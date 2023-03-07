<?php 

    $password = $email = $customer_id = $message = "";
    $i = 0;

    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        
        require 'database.php';
        $db = Database::connect();
        $statement = $db->prepare('SELECT customer.id FROM customer WHERE customer.email = ? AND customer.password = ?');
        $statement->execute(array($email,$password));
        while($customer = $statement->fetch()){
            $i++;
            $customer_id = $customer['id'];
        }
        Database::disconnect();
        
        if($i == 0){
            $message = "Email ou mot de passe incorrect. Veuillez reessayer.";
        }else{
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
    
</head>
<body>
    <div id="login-container">
        <img src="images/logo.png" alt="logo" id="login-logo">
        
        <form action="connexion.php"  method=post>
            <h2>Se connecter</h2>
            <div>
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

            <button type="submit">Valider</button>
        </form>
        <div id="account">
            Vous n'avez pas de compte, <a href="account.php"> creez un compte </a>
        </div>
    </div>
</body>
</html>