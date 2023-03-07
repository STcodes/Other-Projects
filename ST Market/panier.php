<?php
    $isconnect = false;
    $customer_id = 0;

    if(!empty($_GET['isconnect'])){
        $isconnect = $_GET['isconnect'];
        if(!empty($_GET['customer'])){
            $customer_id = $_GET['customer'];
        }
    }

    $message = $message1 = "";
    $isSuccess = true;

    require 'database.php';
    

    if(!empty($_POST)){

        if(empty($_POST['numeromtn']) AND empty($_POST['numeroorange'])){
            $isSuccess = false;
            $message1 = "Veuillez entrer votre numero de compte";
        }

        if(!empty($_POST['numeromtn'])){
            if( (strlen($_POST['numeromtn']) != 9) OR ((substr($_POST['numeromtn'], 0,2) !== "67") AND (substr($_POST['numeromtn'], 0,3) !== "650") AND (substr($_POST['numeromtn'], 0,3) !== "651") AND (substr($_POST['numeromtn'], 0,3) !== "652") AND (substr($_POST['numeromtn'], 0,3) !== "653") AND (substr($_POST['numeromtn'], 0,3) !== "654") AND (substr($_POST['numeromtn'], 0,3) !== "655")) AND (substr($_POST['numeromtn'], 0,3) !== "680")){
                $isSuccess = false;
                $message1 = "Veuillez entrer un numero valide";
            }
        }

        if(!empty($_POST['numeroorange'])){
            if( (strlen($_POST['numeroorange']) != 9) OR ((substr($_POST['numeroorange'], 0,2) !== "69") AND (substr($_POST['numeroorange'], 0,3) !== "656") AND (substr($_POST['numeroorange'], 0,3) !== "657") AND (substr($_POST['numeroorange'], 0,3) !== "658") AND (substr($_POST['numeroorange'], 0,3) !== "659")) ){
                $isSuccess = false;
                $message1 = "Veuillez entrer un numero valide";
            }
        }

        if(!isset($_POST['checkbox'])){
            $isSuccess = false;
            $message1 = "Veuillez accepter les conditions d'utilisation";
        }
        if(empty($_POST['adresse'])){
            $isSuccess = false;
            $message1 = "Veuillez entrer votre adresse de livraison";
        }else{
            $adresse = $_POST['adresse'];
        }



        if($isSuccess){
            $db = Database::connect();
            $statement = $db->prepare('UPDATE commande SET commande.etat = 1, commande.adresse = ? WHERE commande.etat = 0 AND commande.customer = ?');
            $statement->execute(array($adresse,$customer_id));

            $db= Database::connect();
            $statement = $db->prepare('SELECT customer.name FROM customer WHERE customer.id = ?');
            $statement->execute(array($customer_id));
            $nom = $statement->fetch();

            $message = "<script language=Javascript> alert('M./Mm. ".$nom['name'].", votre commande a ete passe avec succes, votre facture vous seras envoye par mail. Merci pour votre confiance toujours renouvelee.'); </script>";
            Database::disconnect();
            header("Location: boutique.php?isconnect=$isconnect&customer=$customer_id&message=$message");
        }
    }

    if(isset($_POST['cancel'])){
        $db = Database::connect();
        $statement = $db->prepare('DELETE FROM commande WHERE commande.customer = ? AND commande.etat = 0');
        $statement->execute(array($customer_id));
        header("Location: boutique.php?isconnect=$isconnect&customer=$customer_id");
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
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php require "nav.php"; 

        echo'<script language="Javascript">
                const home = document.getElementById("home");
                const article = document.getElementById("article");
                const panier = document.getElementById("panier");
                const contact = document.getElementById("contact");

                home.classList.remove("active");
                article.classList.remove("active");
                panier.classList.add("active");
                contact.classList.remove("active");

            </script>'
    ?>

    <section id="panier-container1">
        <h2> Votre Panier </h2>
        <div class="panier-line-container"> 
            <div class="line"></div> 
            <div class="box"></div> 
        </div>

        <p>
            Ici sont affiches tous vos articles que vous avez ajouter
            au panier. Tant que vous n'avez pas passez la commande, Ces 
            articles resteront sur cette page. Si vous n'etes pas connecte, 
            veuillez a le faire sinon aucun de vos articles ne s'affichera et nous 
            vous prions de remplir les informations demandes ci dessous  de maniere 
            minucieuse pour qu'il y'ait pas d'erreur lors de la livraison. Nous vous 
            remercions pour votre comprehension.

        </p>

        <?php
            $i = 0;
            $db = Database::connect();
            $statement = $db->prepare('SELECT * FROM commande WHERE commande.etat = 0 AND commande.customer = ?');
            $statement->execute(array($customer_id));
            while($cmde = $statement->fetch()){
                $i++;
            }

            if($i == 0){
                echo '
                    <div class="messageanime">
                        <span class="lettre">A</span>
                        <span class="lettre">u</span>
                        <span class="lettre">c</span>
                        <span class="lettre">u</span>
                        <span class="lettre">n &nbsp</span>
            
                        <span class="lettre">a</span>
                        <span class="lettre">r</span>
                        <span class="lettre">t</span>
                        <span class="lettre">i</span>
                        <span class="lettre">c</span>
                        <span class="lettre">l</span>
                        <span class="lettre">e &nbsp</span>
            
                        <span class="lettre">a</span>
                        <span class="lettre">j</span>
                        <span class="lettre">o</span>
                        <span class="lettre">u</span>
                        <span class="lettre">t</span>
                        <span class="lettre">é</span>
                    </div>            
                ';
            }

            if($i == 1){
                $db = Database::connect();
                $statement = $db->prepare('SELECT * FROM commande WHERE commande.etat = 0 AND commande.customer = ?');
                $statement->execute(array($customer_id));
                $cmde = $statement->fetch();
                $b = "J'ai lu et j'accepte les ";
                echo'
                <div id="panier-div1">

                    <div id="panier-div2">
                        <h3>Liste des articles</h3>
                        <div class="panier-line-container"> 
                            <div class="line"></div> 
                            <div class="box"></div> <br><br><br>
                        </div>
                        <div id="panier-list-item">
                            '.$cmde['item_qte'].'
                        </div>
                        <div id="panier-price"> Prix total : <span style="color:#fdac17;"> '.$cmde['prix'].' € </span></div>
                        <div class="panier-message" style="color: red;"> '.$message1.' </div>
                    </div>
            
                    <form action="panier.php?isconnect='.$isconnect.'&&customer='.$customer_id.'" method=post>
                        <h3><img src="images/mtn.jpg"  class="logo-paiement">&nbsp Paiement par MTN Mobile Money </h3>
                        <input type="number" placeholder="Numero du compte" class="panier-input-number" name="numeromtn">
            
                        <h3><img src="images/orange.png"  class="logo-paiement">&nbsp Paiement par Orange Money</h3>
                        <input type="number" placeholder="Numero du compte"  class="panier-input-number" name="numeroorange"><br>

                        <label for="adresse">Adresse de Livraison</label>&nbsp&nbsp<input type=text class="panier-input-number" placeHolder="Boite postal" name="adresse"><br>
            
                        <div id="panier-condition"> <input type="checkbox" name="checkbox"> '.$b.'<a href="conditions.php?isconnect='.$isconnect.'&customer='.$customer_id.'">termes et conditions du site</a></div>
                        
                        <button id="panier-cancel" name="cancel"> <i class="fa fa-trash"></i>&nbsp Annuler la commande</button>
                        <button type=submit id="panier-submit"> <i class="fa fa-send"></i>&nbsp Passer la commande </button>
                    </form>
    
                </div>              
                ';

                
            }
        ?>
        
    </section>



    <?php require "footer.php"; ?>
</body>
</html>