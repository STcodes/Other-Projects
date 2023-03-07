<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style/footer_style.css">
</head>
<body>
    <section id="footer">
        <img src="images/logo.png" alt="logo" id="footer-logo">
        <div id="footer-parcourir">
            <h3>PARCOURIR</h3>
            <ul>
                <ol><a href="index.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"> <span style="color:#fdac17; font-weight:bold;"> > </span>&nbsp Acceuil</a></ol>
                <ol><a href="boutique.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"> <span style="color:#fdac17; font-weight:bold;"> > </span>&nbsp  Boutique</a></ol>
                <ol><a href="panier.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"> <span style="color:#fdac17; font-weight:bold;"> > </span>&nbsp Panier</a></ol>
                <ol><a href="contact.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"> <span style="color:#fdac17; font-weight:bold;"> > </span>&nbsp Contact</a></ol>
            </ul>
        </div>

        <div id="footer-info">
            <h3>INFORMATIONS COMPLEMENTAIRES</h3>
            <ul>
                <ol><a href="policy.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"> <span style="color:#fdac17; font-weight:bold;"> > </span>&nbsp Politique de confidentalite</a></ol>
                <ol><a href="conditions.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"> <span style="color:#fdac17; font-weight:bold;"> > </span>&nbsp Termes et conditions du site</a></ol>
            </ul>
        </div>

        <div id="footer-social">
            <h3>SUIVEZ-NOUS...</h3>
            <div id="social">
                <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
            </div>
        </div>

    </section>

    <div id="copyright">
        &copy; Copyrigth ST.code 2022 All Rights Reserved
    </div>

</body>
</html>