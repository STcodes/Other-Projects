<?php
    $isconnect = false;
    $customer_id = 0;

    if(!empty($_GET['isconnect'])){
        $isconnect = $_GET['isconnect'];
        if(!empty($_GET['customer'])){
            $customer_id = $_GET['customer'];
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

    </script>'  ?>

    <div id="boutique-nav">
        <a id="boutique-nav-phone" class="boutique-nav-btn boutique-nav-active"> <i class="fa fa-mobile-phone"></i>Smartphone</a>
        <a id="boutique-nav-laptop" class="boutique-nav-btn"> <i class="fa fa-laptop"></i>Laptop</a>
        <a id="boutique-nav-car" class="boutique-nav-btn"> <i class="fa fa-car"></i>Voiture</a>
        <a id="boutique-nav-gadjets" class="boutique-nav-btn"> <i class="fa fa-headphones"></i>Gadjets</a>
    </div>
    
    <section id="boutique-phone" class="boutique-container boutique-container-active">
        <h2 class="boutique-title">Nos Smartphones</h2>
        <div class="panier-line-container"> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="line"></div> 
            <div class="box"></div> 
        </div>
        <div class="boutique-container-item">

            <?php   require 'database.php';
                    $db = Database::connect();
                    $statement = $db->query('SELECT item.code, item.libelle, item.prix, item.évaluation, item.image FROM item WHERE item.categorie = "smartphone"');
                    while($item = $statement->fetch()) 
                    {
                        $i = 1;
                        $a = $item['évaluation'];
                        echo'<div class="item">
                            <div id="item-image-prix">
                                <img src="images/' . $item['image'] . '" alt="item-image" class="item-image">
                                <span class="prix">' .$item['prix']. ' € </span>
                            </div>
                            <div class="item-star">';
                        while($i <= $a){
                            echo '<i class="fa fa-star" style="color:orange;"></i>';
                            $i++;
                        }
                        $i = 0;
                        $a = 5 - $a;
                        while($i < $a){
                           echo '<i class="fa fa-star"></i>';
                           $i ++ ;
                        }
                        echo'</div>
                             <div class="libelle">'.$item['libelle'].'</div>
                             <a href="view_item.php?id='.$item['code'].'&&isconnect='.$isconnect.'&&customer='.$customer_id.'" class="add-cart"> <i class="fa fa-shopping-cart"></i> Ajouter au panier</a>
                        </div>';
                    }
                    Database::disconnect();
            ?>
            
        </div>
    </section>
        
    <section id="boutique-laptop" class="boutique-container" > 
        <h2 class="boutique-title">Nos Laptops</h2>
        <div class="panier-line-container"> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="line"></div> 
            <div class="box"></div> 
        </div>
        <div class="boutique-container-item">
            
            <?php  
                    $db = Database::connect();
                    $statement = $db->query('SELECT item.code, item.libelle, item.prix, item.évaluation, item.image FROM item WHERE item.categorie = "laptop"');
                    while($item = $statement->fetch()) 
                    {
                        $i = 1;
                        $a = $item['évaluation'];
                        echo'<div class="item">
                            <div id="item-image-prix">
                                <img src="images/' . $item['image'] . '" alt="item-image" class="item-image">
                                <span class="prix">' .$item['prix']. ' € </span>
                            </div>
                            <div class="item-star">';
                        while($i <= $a){
                            echo '<i class="fa fa-star" style="color:orange;"></i>';
                            $i++;
                        }
                        $i = 0;
                        $a = 5 - $a;
                        while($i < $a){
                           echo '<i class="fa fa-star"></i>';
                           $i ++ ;
                        }
                        echo'</div>
                             <div class="libelle">'.$item['libelle'].'</div>
                             <a href="view_item.php?id='.$item['code'].'&&isconnect='.$isconnect.'&&customer='.$customer_id.'" class="add-cart"> <i class="fa fa-shopping-cart"></i> Ajouter au panier</a>
                        </div>';
                    }
                    Database::disconnect();
            ?>
            
        </div>    
    </section>

    <section id="boutique-car" class="boutique-container" > 
        <h2 class="boutique-title">Nos Voitures</h2>
        <div class="panier-line-container"> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="line"></div> 
            <div class="box"></div> 
        </div> 
        <div class="boutique-container-item">
            
            <?php  
                    $db = Database::connect();
                    $statement = $db->query('SELECT item.code, item.libelle, item.prix, item.évaluation, item.image FROM item WHERE item.categorie = "car"');
                    while($item = $statement->fetch()) 
                    {
                        $i = 1;
                        $a = $item['évaluation'];
                        echo'<div class="item">
                            <div id="item-image-prix">
                                <img src="images/' . $item['image'] . '" alt="item-image" class="item-image">
                                <span class="prix">' .$item['prix']. ' € </span>
                            </div>
                            <div class="item-star">';
                        while($i <= $a){
                            echo '<i class="fa fa-star" style="color:orange;"></i>';
                            $i++;
                        }
                        $i = 0;
                        $a = 5 - $a;
                        while($i < $a){
                           echo '<i class="fa fa-star"></i>';
                           $i ++ ;
                        }
                        echo'</div>
                             <div class="libelle">'.$item['libelle'].'</div>
                             <a href="view_item.php?id='.$item['code'].'&&isconnect='.$isconnect.'&&customer='.$customer_id.'" class="add-cart"> <i class="fa fa-shopping-cart"></i> Ajouter au panier</a>
                        </div>';
                    }
                    Database::disconnect();
            ?>
            
        </div>   
    </section>

    <section id="boutique-gadjets" class="boutique-container" > 
        <h2 class="boutique-title">Nos Gadjets</h2>
        <div class="panier-line-container"> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="line"></div> 
            <div class="box"></div> 
        </div> 
        
        <div class="boutique-container-item">
            
            <?php  
                    $db = Database::connect();
                    $statement = $db->query('SELECT item.code, item.libelle, item.prix, item.évaluation, item.image FROM item WHERE item.categorie = "gadjet"');
                    while($item = $statement->fetch()) 
                    {
                        $i = 1;
                        $a = $item['évaluation'];
                        echo'<div class="item">
                            <div id="item-image-prix">
                                <img src="images/' . $item['image'] . '" alt="item-image" class="item-image">
                                <span class="prix">' .$item['prix']. ' € </span>
                            </div>
                            <div class="item-star">';
                        while($i <= $a){
                            echo '<i class="fa fa-star" style="color:orange;"></i>';
                            $i++;
                        }
                        $i = 0;
                        $a = 5 - $a;
                        while($i < $a){
                           echo '<i class="fa fa-star"></i>';
                           $i ++ ;
                        }
                        echo'</div>
                             <div class="libelle">'.$item['libelle'].'</div>
                             <a href="view_item.php?id='.$item['code'].'&&isconnect='.$isconnect.'&&customer='.$customer_id.'" class="add-cart"> <i class="fa fa-shopping-cart"></i> Ajouter au panier</a>
                        </div>';
                    }
                    Database::disconnect();
            ?>
            
        </div>
    </section>

    <?php require "footer.php"; 
    
    if(!empty($_GET['message'])){
        $message = $_GET['message'];
        echo $message;
    }
    ?>

    <script src="boutique.js"></script>
</body>
</html>