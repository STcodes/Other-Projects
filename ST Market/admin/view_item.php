<?php
    require 'database.php';

    $user_name = "";

    if(!empty($_GET['user'])){
        $user_name = $_GET['user'];
    }
    else{
        header("Location: connect.php");
    }


    $code = $name = $libelle = $description = $quantite = $prix = $image = $id_cat = "";
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
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST Market-Admin</title>
    <link rel="shortcut icon" href="../images/logo2.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    

    <section id="sidebar">
        <img src="../images/logo.png" id="logo">
        <div class="nav-line-container"> 
            <div class="box"></div>
            <div class="line"></div> 
            <div class="box"></div> 
        </div><br>
        <nav id="sidebar-nav">
            <a href="index.php?user=<?php echo $user_name; ?>" id="home" class="navh active"> <i class="fa fa-home"></i>&nbsp Acceuil</a>
            <a href="item.php?user=<?php echo $user_name; ?>" id="item" class="nava"> <i class="fa fa-headphones"></i>&nbsp Article</a>
            <a href="commande.php?user=<?php echo $user_name; ?>" id="commande" class="navc"> <i class ="fa fa-shopping-cart"></i>&nbsp Commande</a>
            <a href="admin.php?user=<?php echo $user_name; ?>" id="admin" class="navd"> <i class="fa fa-user"></i>&nbsp Administrateur</a>
        </nav>

        <div id="copyright">
            &copy; Copyrigth ST.code 
        </div>
    </section>

    <div id="container1">

        <div id="nav-top">
            <div id="social">
                <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
            </div>
            <div id="index-title"> <i class="fa fa-headphones"></i>&nbsp Article </div>

            <div id="user-div1">
                <div><i class="fa fa-user-circle"></i>&nbsp <?php echo $user_name; ?></div>&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="connect.php"> <i class="fa fa-sign-out"></i> Se deconnecter</a>
            </div>

        </div>

        <section id="view_item-container">
            <h2 id="view_item-title"> <?php echo $name; ?> </h2>
            <div class="panier-line-container"> 
                <div class="line"></div> 
                <div class="box"></div> 
            </div><br><br>
            <div id="view_item-div1">
                <?php
                    echo'<img src="../images/'.$image.'" alt="" id="view_item-img">
                        <div id="view_item-div2">
                        '.$libelle.'
                        <br><br>
                        <div> Prix : <span style="color:#fdac17;"> '.$prix.' € </span> </div>
                        <br>
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
                        echo '<i class="fa fa-star"  style="color: rgba(0,0,0,0.7);"></i>';
                        $i ++ ;
                        }
                        echo'</div>
                                <br>'.$description.'<br><br>
                                <a href="item.php?user='.$user_name.'" class="view-back"> <i class="fa fa-arrow-left"></i>retour</a>
                                </div> 
                            ';
                ?>
            </div>
            
        </section>
    </div>


    <?php 
        echo'<script language="Javascript">
                const home = document.querySelector(".navh");
                const item = document.querySelector(".nava");
                const comm = document.querySelector(".navc");
                const admin = document.querySelector(".navd");

                home.classList.remove("active");
                item.classList.add("active");
                comm.classList.remove("active");
                admin.classList.remove("active");
            </script>';
    ?>

    <script src="article.js"></script>
</body>
</html>