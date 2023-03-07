<?php
    $user_name = "";

    if(!empty($_GET['user'])){
        $user_name = $_GET['user'];
    }
    else{
        header("Location: connect.php");
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
            <div id="index-title"> <i class="fa fa-shopping-cart"></i>&nbsp Commande </div>
            

            <div id="user-div1">
                <div><i class="fa fa-user-circle"></i>&nbsp <?php echo $user_name; ?></div>&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="connect.php"> <i class="fa fa-sign-out"></i> Se deconnecter</a>
            </div>

        </div>


        <div id="container2">
            
        </div>
    </div>
    

    <?php 
        echo'<script language="Javascript">
                const home = document.querySelector(".navh");
                const item = document.querySelector(".nava");
                const comm = document.querySelector(".navc");
                const admin = document.querySelector(".navd");

                home.classList.remove("active");
                item.classList.remove("active");
                comm.classList.add("active");
                admin.classList.remove("active");
            </script>';
    ?>
</body>
</html>