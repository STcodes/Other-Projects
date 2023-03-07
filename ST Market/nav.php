<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style/nav_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
    <div id="top_nav">
        <div id="social">
            <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
            <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
        </div>
        <img src="images/logo.png" alt="logo" id="logo">
        <div id="search_nav"><input type="text" name="search_content" id="search_content" value="Rechercher"><button type="submit" id="search_go"><i class="fa fa-search"></i></button> <span style="color:white; font-family: sans-serif;">0.00 €</span> </div>
        
    </div>
    <div id="container-line">
        <div id="line"></div>
    </div>
    <div id="middle_nav">
        <nav id="nav">
        <a href="index.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>" id="home"> <i class="fa fa-home"></i>Acceuil</a>
        <a href="boutique.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>" id="article" > <i class="fa fa-euro"></i> Boutique</a>
        <a href="panier.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>" id="panier" > <i class="fa fa-shopping-cart"></i> Panier</a>
        <a href="contact.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>" id="contact"> <i class ="fa fa-phone-square"></i> Contact</a>
        </nav>


    </div>
    <?php 

        if($isconnect){

            echo' <form action="index.php?isconnect=false&&customer=0"  method=post >           
            <button type=submit name="disconnect" class="nav-connexion"><i class="fa fa-sign-out"></i> &nbsp Se deconnecter</button>
            </form>';
        }
        else {
            echo' <a href="connexion.php" class="nav-connexion"><i class="fa fa-sign-in"></i> &nbsp Se connecter</a>';
        }

    ?>

</body>
</html>
