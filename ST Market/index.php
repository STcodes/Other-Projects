<?php
    $isconnect = false;
    $customer_id = 0;

    if(!empty($_GET['isconnect'])){
        $isconnect = $_GET['isconnect'];
        if(!empty($_GET['customer'])){
            $customer_id = $_GET['customer'];
        }
    }

    if(isset($_POST['disconnect'])){
        $isconnect = false;
        $customer_id = 0;
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

                home.classList.add("active");
                article.classList.remove("active");
                panier.classList.remove("active");
                contact.classList.remove("active");
            </script>';
    ?>

    <div id="banniere">
        <div id="slogan"> Des Articles de qualite pour votre pleine satisfaction</div>
    </div>

    <section id="index-section">
        <div id="index-container1">
            <img src="images/ban2.jpeg" alt="img" id="index-image1">
            <div id="abc">
                <h3 id="index-title1">Qui sommes nous...</h3>
                <div id="index-line1"></div>
                <div id="index-text1">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Tempora debitis obcaecati accusantium praesentium nihil sunt.
                    iure amet corporis, eligendi fuga labore esse fugit, ipsa blanditiis.
                    <br><br> 
                    assumenda rerum recusandae voluptatem. Eveniet voluptas natus obcaecati 
                    asperiores, odio adipisci illum ex sunt ab atque quis iste eum sit porro
                     dolorum facere nihil doloremque excepturi ratione rem vitae! Quo similique 
                     omnis recusandae ratione, atque adipisci iste possimus, dicta doloribus labore.
                </div>
                <a href="contact.php?isconnect=<?php echo $isconnect; ?>&&customer=<?php echo $customer_id; ?>"><button id="index-button1">Nous contacter</button></a>
            </div>
        </div>

        <div id="index-container2">
            <div class="index-count">
                <h2 id="index-count1"  class="index-cnt">25</h2>
                <div class="index-client" > Clients satisfaits</div>
                <div class="index-count-line" style="margin-left:40px;"></div>
            </div>
            <div class="index-count">
                <h2 id="index-count2"  class="index-cnt">7</h2>
                <div class="index-client" > Annees d'experience</div>
                <div class="index-count-line" style="margin-left:20px;"></div>
            </div>
            <div class="index-count">
                <h2 id="index-count3"  class="index-cnt">18</h2>
                <div class="index-client" > Partenaires administratifs</div>
                <div class="index-count-line"></div>
            </div>
        </div>

        <div id="index-container3">
            <h2>Quelques de nos articles</h2>
            <div id="index-caroussel">               
                <div id="index-slider" style="transform: scaleY(0.7); margin-right: 2em;">
                    <img class="index-slider-active index-slider-image" src="images/caroussel/1.webp">
                    <img class="index-slider-image" src="images/caroussel/2.webp">
                    <img class="index-slider-image" src="images/caroussel/3.jpeg">
                    <img class="index-slider-image" src="images/caroussel/4.jpeg">
                    <img class="index-slider-image" src="images/caroussel/5.jpeg">
                    <img class="index-slider-image" src="images/caroussel/6.webp">
                    <img class="index-slider-image" src="images/caroussel/7.webp">
                    <img class="index-slider-image" src="images/caroussel/8.jpeg">
                    <img class="index-slider-image" src="images/caroussel/9.jpeg">
                    <img class="index-slider-image" src="images/caroussel/10.webp">
                    <img class="index-slider-image" src="images/caroussel/11.jpeg">
                    <img class="index-slider-image" src="images/caroussel/12.webp">
                    <img class="index-slider-image" src="images/caroussel/13.jpeg">
                    <img class="index-slider-image" src="images/caroussel/14.jpeg">
                    <img class="index-slider-image" src="images/caroussel/15.jpeg">
                    <img class="index-slider-image" src="images/caroussel/16.webp">  
                </div>
                <div id="index-slider">
                    <img class="index-slider-image1 index-slider-active" src="images/caroussel/2.webp">
                    <img class="index-slider-image1" src="images/caroussel/3.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/4.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/5.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/6.webp">
                    <img class="index-slider-image1" src="images/caroussel/7.webp">
                    <img class="index-slider-image1" src="images/caroussel/8.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/9.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/10.webp">
                    <img class="index-slider-image1" src="images/caroussel/11.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/12.webp">
                    <img class="index-slider-image1" src="images/caroussel/13.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/14.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/15.jpeg">
                    <img class="index-slider-image1" src="images/caroussel/16.webp">  
                    <img class="index-slider-image1" src="images/caroussel/1.webp">
                </div>
                <div id="index-slider" style="transform:scaleY(0.7); margin-left: 2em;">
                    <img class="index-slider-image2 index-slider-active" src="images/caroussel/3.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/4.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/5.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/6.webp">
                    <img class="index-slider-image2" src="images/caroussel/7.webp">
                    <img class="index-slider-image2" src="images/caroussel/8.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/9.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/10.webp">
                    <img class="index-slider-image2" src="images/caroussel/11.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/12.webp">
                    <img class="index-slider-image2" src="images/caroussel/13.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/14.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/15.jpeg">
                    <img class="index-slider-image2" src="images/caroussel/16.webp">  
                    <img class="index-slider-image2" src="images/caroussel/1.webp">
                    <img class="index-slider-image2" src="images/caroussel/2.webp">
                </div>
            </div>
            <div id="index-slider-buttons">
                <div class="index-slider-button left" style="margin-right:1em;"><i class="fa fa-chevron-left"></i></div>
                <div class="index-slider-button right" style="margin-left:1em;"><i class="fa fa-chevron-right"></i></div>
            </div>
        </div>
        
        <div id="index-container4">

            <div class="index-avis">
                <i class="index-icon-avis fa fa-quote-left"></i>
                <div class="index-avis-title">Services inpecables.</div>
                <div class="index-avis-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Omnis odio accusantium voluptates perspiciatis ut aut nostrum
                    eius quas ipsa non molestiae facilis quam maxime in, dolore 
                    a possimus, obcaecati sapiente?
                </div>
                <div class="index-avis-info">
                    <img src="images/hom.jpeg" alt="image" class="index-image-info">
                    <div class="index-avis-name-job">
                        <div class="index-info-name">SITIO Thierry</div>
                        <div class="index-info-job">Ingenieur</div>
                    </div>
                </div>
            </div>

            <div class="index-avis">
                <i class="index-icon-avis fa fa-quote-left"></i>
                <div class="index-avis-title">Tres pro, je recommande.</div>
                <div class="index-avis-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Omnis odio accusantium voluptates perspiciatis ut aut nostrum
                    eius quas ipsa non molestiae facilis quam maxime in, dolore 
                    a possimus, obcaecati sapiente?
                </div>
                <div class="index-avis-info">
                    <img src="images/ho.jpeg" alt="image" class="index-image-info">
                    <div class="index-avis-name-job">
                        <div class="index-info-name">TAGNE Talom</div>
                        <div class="index-info-job">Entrepreneur</div>
                    </div>
                </div>
            </div>

            <div class="index-avis">
                <i class="index-icon-avis fa fa-quote-left"></i>
                <div class="index-avis-title">Articles de qualite, bravo!</div>
                <div class="index-avis-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Omnis odio accusantium voluptates perspiciatis ut aut nostrum
                    eius quas ipsa non molestiae facilis quam maxime in, dolore 
                    a possimus, obcaecati sapiente?
                </div>
                <div class="index-avis-info">
                    <img src="images/fe.webp" alt="image" class="index-image-info">
                    <div class="index-avis-name-job">
                        <div class="index-info-name">MARIE Belle</div>
                        <div class="index-info-job">Commercante</div>
                    </div>
                </div>
            </div>    
        </div>

    </section>

    <?php require "footer.php"; ?>

    <script src="index.js"></script>
</body>
</html>