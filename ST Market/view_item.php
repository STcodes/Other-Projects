<?php 

    $isconnect = false;
    $customer_id = 0;

    if(!empty($_GET['isconnect'])){
        $isconnect = $_GET['isconnect'];
        if(!empty($_GET['customer'])){
            $customer_id = $_GET['customer'];
        }
    }


    require 'database.php';

    $code = $name = $libelle =$description = $quantite = $prix = $image = $id_cat = "";
    $evaluation = 0;

    if(!empty($_GET['id'])) 
    {
        $code = checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT item.name, item.libelle, item.description, item.quantite, item.prix, item.image, item.évaluation, item.id_cat FROM item WHERE item.code = ?');
    $statement->execute(array($code));
    $item = $statement->fetch();

    $name           = $item['name'];
    $libelle        = $item['libelle'];
    $description    = $item['description'];
    $quantite       = $item['quantite'];
    $prix           = $item['prix'];
    $image          = $item['image'];
    $evaluation     = $item['évaluation'];
    $id_cat         = $item['id_cat'];



    function checkInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nbre = 0;
    $isSuccess = true;
    $message = "";

    if(!empty($_POST)){
        $nbre = $_POST['qte'];

        if($nbre <= 0 ){
            $message = "Veuillez entrer une quantite valide";
            $isSuccess = false;
        }

        if(!$isconnect){
            $message = "Veuillez vous connecter au prealable";
            $isSuccess = false;
        }


        $i = 0;
        if($isSuccess){
            $db = Database::connect();
            $statement = $db->prepare('SELECT * FROM commande WHERE commande.etat = 0 AND commande.customer = ?');
            $statement->execute(array($customer_id));
            while($cmde = $statement->fetch()){
                $i++;
            }

            if($i == 0){
                $db = Database::connect();
                $statement = $db->prepare('INSERT INTO commande(commande.item_qte, commande.prix, commande.customer, commande.etat) VALUES(?,?,?,0)');
                $total = $prix*$nbre;
                $itemqte = '<span style="color:#fdac17;"> > </span>&nbsp Nom : '.$name.',&nbsp  Quantite : '.$nbre.',&nbsp  Prix = '.$nbre.' x '.$prix.' = '.$total.'€. ';
                $statement->execute(array($itemqte,$total,$customer_id));
            }

            if($i == 1){
                $db = Database::connect();
                $statement = $db->prepare('SELECT * FROM commande WHERE commande.etat = 0 AND commande.customer = ?');
                $statement->execute(array($customer_id));
                $cmde = $statement->fetch();

                $statement = $db->prepare('UPDATE commande SET commande.item_qte = ?, commande.prix = ? WHERE commande.etat = 0 AND commande.customer = ?');
                $total1 = $prix*$nbre;
                $total = $total1 + $cmde['prix'];
                $itemqte = ''.$cmde['item_qte'].'<br><br> <span style="color:#fdac17;"> > </span>&nbsp  Nom : '.$name.',&nbsp  Quantite : '.$nbre.',&nbsp   Prix = '.$nbre.' x '.$prix.' = '.$total1.'€. ';
                
                $statement->execute(array($itemqte,$total,$customer_id));
            }

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
        article.classList.add("active");
        panier.classList.remove("active");
        contact.classList.remove("active");
        </script>';
    ?>

    <section id="view_item-container">
        <h2 id="view_item-title"> <?php echo $name; ?> </h2>
        <div class="panier-line-container"> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="line"></div> 
            <div class="box"></div> 
        </div><br><br>
        <div id="view_item-div1">
            <?php
                echo'<img src="images/'.$image.'" alt="" id="view_item-img">
                    <div id="view_item-div2">
                    '.$libelle.'
                    <br><br>
                    Prix : '.$prix.' €
                    <br><br>
                    Quantite en Stock : '.$quantite.' unites
                    <br><br>
                    <div class="item-star">';
                    $i = 1;
                    while($i <= $evaluation){
                        echo '<i class="fa fa-star" style="color:orange;"></i>';
                        $i++;
                    }
                    $i = 0;
                    $evaluation = 5 - $evaluation;
                    while($i < $evaluation){
                       echo '<i class="fa fa-star" style="color:black;"></i>';
                       $i ++ ;
                    }
                    echo'</div>
                    <br>
                    '.$description.'
                    <br><br>
                    <form class="form" action="view_item.php?id='.$code.'&&isconnect='.$isconnect.'&&customer='.$customer_id.'" method=post >
                        <label for="qte"> Quatite souhaitee </label>
                        <input type=number placeHolder=5 id="view_item-qte" name="qte"></input><br>
                        <p>'.$message.'</p><br>
                        <button type=submit id="view_item-button1"> <i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
                    </form>
                    </div> ';
            ?>
        </div>
        <div id="view_item-div3">
            <h3>Assecoires complementaires</h3>
            <div class="panier-line-container">
                <div class="line"></div> 
                <div class="box"></div> 
            </div><br>
            <?php 
               
                echo '<div id="view_item-div4">';
                $i = 0;
                $a = 0;
                $db = Database::connect();
                $statement = $db->prepare('SELECT item.code, item.image, item.évaluation FROM item WHERE item.categorie = "gadjet" AND item.id_cat  = ?');
                $statement->execute(array($id_cat));
                while(($item1 = $statement->fetch()) OR ($a = 0)){
                    $i ++;
                    echo '<div class="view_item-div5"> <a href="view_item.php?id='.$item1['code'].'&&isconnect='.$isconnect.'&&customer='.$customer_id.'">  <img src="images/'.$item1['image'].'" class="view_item-also"> </a>';
                    echo '<div>';
                    $j = 1;
                    $evaluation = $item1['évaluation'];
                    while($j <= $evaluation){
                        echo '<i class="fa fa-star" style="color:orange;"></i>';
                        $j++;
                    }
                    $j = 0;
                    $evaluation = 5 - $evaluation;
                    while($j < $evaluation){
                    echo '<i class="fa fa-star" style="color:black;"></i>';
                    $j ++ ;
                    }
                    echo '</div></div>';
                    
                    if($i = 3){
                        $a = 1;
                    }
                }
                echo '</div>';
            ?>
        </div>.
    </section>

    <?php require "footer.php"; ?>
</body>