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
        article.classList.remove("active");
        panier.classList.remove("active");
        contact.classList.remove("active");

        </script>'
    ?>
<section id="policy-container">
    <h2 id="policy-title">Termes et conditions </h2><br>
    <div class="panier-line-container"> 
            <div class="line"></div> 
            <div class="box"></div> 
    </div>
    <br><br>

    <div id="policy-text">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio saepe delectus,
         similique consequatur eligendi ipsam voluptatem, excepturi laboriosam ducimus imped
         it ea laborum numquam suscipit nesciunt quod itaque blanditiis esse nemo dignissimo
         s magni, quisquam tempore nihil. Dolor repellendus id qui autem sunt reiciendis iur
         e libero explicabo ut. Numquam nemo blanditiis eveniet in dolore architecto similiq
         ue rem, itaque ducimus possimus a esse voluptatum cupiditate aliquam error sequi cu
         mque sunt harum laudantium distinctio ex, culpa impedit. Ratione maiores laborum im
         pedit earum in quaerat reprehenderit, tempore, error voluptatibus autem et accusamu
         s aperiam inventore, repellat minima quod sit a libero consequatur quia. Architecto
         , soluta voluptatibus. Lorem, ipsum dolor sit amet consectetur adipisicing elit. <br><br> Do
         lorem tenetur possimus laboriosam exercitationem, repudiandae illum quae. Rem dicta
          illum consequuntur corrupti tenetur deserunt laboriosam! Sunt vero iure asperiores
           maxime harum laboriosam provident sed, dolore ex blanditiis iusto ea, <br> est rerum, 
           facere consequuntur delectus voluptas accusantium dignissimos? Nihil qui, dolorum
            quae ducimus libero neque dicta saepe cum veritatis incidunt cupiditate recusand
            ae exercitationem odit quaerat error culpa ut nulla iste, earum nisi, amet lauda
            ntium in. Eum, velit dolor, reiciendis sed aspernatur voluptatem rem ab neque op
            tio hic laudantium, excepturi aperiam praesentium consequuntur possimus culpa al
            iquid. Voluptatum porro, aperiam quas sed libero quod quia unde vel <br><br> quis commodi
             labore autem, corporis atque cupiditate! Qui ea ducimus a rem temporibus corrup
             ti dolor consequatur doloremque asperiores, aliquam praesentium earum quis exer
             citationem facilis cupiditate id sunt! Minima recusandae facere adipisci incidu
             nt doloribus, id ipsum perferendis animi eum hic debitis? Odio sint dolorum com
             modi debitis, numquam voluptate possimus quia impedit. Deserunt ipsum consequun
             tur, illum voluptatum distinctio reiciendis nobis voluptatibus dolor, perspicia
             tis saepe, voluptas inventore reprehenderit fuga hic. Sequi, ea et. Totam, accu
             samus assumenda laboriosam tenetur ipsa delectus numquam odit veritatis fugit, 
             aspernatur pariatur quasi, nulla at vel. Corporis laborum, quisquam ut voluptat
             um mollitia quam minima aliquid illum aspernatur ad ex assumenda obcaecati, dol
             or dolore nulla repudiandae inventore veniam, reprehenderit quasi dicta laborio
             sam provident non. Dolor, temporibus, aspernatur sunt asperiores tenetur quae e
             xpedita maiores dicta cumque numquam alias similique amet libero voluptatem vel
             , iusto quis perferendis beatae eligendi magnam deserunt 
    </div>
    </section>

    <?php require "footer.php"; ?>
</body>
</html>