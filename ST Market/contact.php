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
        contact.classList.add("active");

        </script>'
    ?>

    <div id="contact-banniere">
        <div id="contact-title"> Nous sommes a l'ecoute pour toutes vos preoccupations</div>
    </div>

    <div id="contact-container">
        <div id="contact-coordonnees">
            <div id="contact-div3">
                <div id="contact-div4">
                    <h1>Nos coordonnees</h1>
                    <div class="panier-line-container"> 
                        <div class="line"></div> 
                        <div class="box"></div> 
                    </div><br>
                    <div>
                        <p class="a"> <i class ="fa fa-phone-square"></i> &nbsp&nbsp 675124898 / 692357584</p>
                        <p class="a"> <i class ="fa fa-whatsapp"></i> &nbsp&nbsp 651782500</p>
                        <p class="a"> <i class ="fa fa-envelope-o"></i> &nbsp&nbsp STMarket@gmail.com</p>
                        <p class="a"> <i class ="fa fa-facebook-square"></i> &nbsp&nbsp STMarketgroup</p>
                        <p class="a"> <i class ="fa fa-globe"></i> &nbsp&nbsp B.P. 6081</p>
                    </div>
                </div>

                <div id="contact-div5">
                    <h1>Localisation &nbsp<i class="fa fa-map-marker"></i></h1>
                    <iframe id="contact-div6" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248.73301539733743!2d9.760138056197823!3d4.0756775194856765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10610dc9254f9331%3A0x3ae5064cf84cc012!2zNMKwMDQnMzIuNSJOIDnCsDQ1JzM2LjYiRQ!5e0!3m2!1sfr!2scm!4v1660071789985!5m2!1sfr!2scm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        
        <form action="" method="post">
            <h2>Vous pouvez nous contacter en nous envoyant vos coordonnees</h2>
            <div>
                <input type="text" placeholder="Votre nom..." class="contact-form-input" >
                <input type="number" placeholder="Votre numero..." class="contact-form-input">
            </div>
            <button id="contact-form-submit">Envoyer</button>
            <p>Nous vous recontacterons ulterieurement</p>
        </form>

        <div class="contact-line-container"> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="line"></div> 
            <div class="box"></div> 
        </div>

        <div id="contact-text3">
            <div id="contact-div1">
                Nous sommes disponibles et joiniables 7 jours sur 7 et 24 heures sur 24 pour vos moindres questions et preoccupations.
            </div> 

            <div id="contact-div2">
                Vous pouvez aussi nous trouver sur :  &nbsp&nbsp
                    <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>&nbsp&nbsp
                    <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>&nbsp&nbsp
                    <a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>&nbsp&nbsp
                    <a href="https://www.youtube.com"><i class="fa fa-youtube-play"></i></a>&nbsp&nbsp
                    <a href="https://www.pinterest.com"><i class="fa fa-pinterest"></i></a>
                
            </div>
            </div>
        </div>
    </div>
 
    <?php require "footer.php"; ?>
</body>
</html>