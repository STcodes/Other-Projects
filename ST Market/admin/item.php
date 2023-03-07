<?php
     
    require 'database.php';

    $user_name = "";

    if(!empty($_GET['user'])){
        $user_name = $_GET['user'];
    }
    else{
        header("Location: connect.php");
    }
 
    $message = $name = $libelle = $description = $price = $category = $qte = $eva = $id_cat = $image = "";

    if(!empty($_POST)){
        $name               = checkInput($_POST['name']);
        $libelle            = checkInput($_POST['libelle']);
        $description        = checkInput($_POST['description']);
        $price              = checkInput($_POST['prix']);
        $category           = checkInput($_POST['cat']); 
        $qte                = checkInput($_POST['qte']); 
        $eva                = checkInput($_POST['eva']); 
        $id_cat             = checkInput($_POST['id-cat']); 
        $image              = checkInput($_FILES['image']['name']);
        $imagePath          = '../images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($name) OR empty($libelle) OR empty($description) OR empty($price) OR empty($category) OR empty($qte) OR empty($eva) OR empty($id_cat)){
            $message = "Les champs ne doivent pas etre vides";
            $isSuccess = false;
        }
        else{
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $message = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $message = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $message = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $message = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        
        if($isSuccess && $isUploadSuccess){
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO item (name,libelle,description,prix,categorie,quantite,évaluation,id_cat,image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($name,$libelle,$description,$price,$category,$qte,$eva,$id_cat,$image));
            Database::disconnect();
            echo '<script language="Javascript"> alert("Article enregistre avec succes"); </script>';
        }else{
            echo '<script language="Javascript"> alert("'.$message.'"); </script>';
        }
    }

    function checkInput($data) 
    {
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

        <div id="item-container1">
            <div id="boutique-nav">
                <a id="boutique-nav-phone" class="boutique-nav-btn boutique-nav-active"> <i class="fa fa-mobile-phone"></i>Smartphone</a>
                <a id="boutique-nav-laptop" class="boutique-nav-btn"> <i class="fa fa-laptop"></i>Laptop</a>
                <a id="boutique-nav-car" class="boutique-nav-btn"> <i class="fa fa-car"></i>Voiture</a>
                <a id="boutique-nav-gadjets" class="boutique-nav-btn"> <i class="fa fa-headphones"></i>Gadjets</a>
                <a id="boutique-nav-item" class="boutique-nav-btn"> <i class="fa fa-plus"></i>Ajouter un article</a>
            </div>

            <section id="boutique-phone" class="boutique-container boutique-container-active">
                
                <div class="boutique-container-item">

                    <?php   
                            $db = Database::connect();
                            $statement = $db->query('SELECT item.code, item.libelle, item.prix, item.évaluation, item.image FROM item WHERE item.categorie = "smartphone"');
                            while($item = $statement->fetch()) 
                            {
                                $i = 1;
                                $a = $item['évaluation'];
                                echo'<div class="item">
                                    <div id="item-image-prix">
                                        <img src="../images/' . $item['image'] . '" alt="item-image" class="item-image">
                                    </div>
                                    <div class="item-star">';
                                while($i <= $a){
                                    echo '<i class="fa fa-star" style="color:orange;"></i>';
                                    $i++;
                                }
                                $i = 0;
                                $a = 5 - $a;
                                while($i < $a){
                                echo '<i class="fa fa-star" style="color: rgba(0,0,0,0.7);"></i>';
                                $i ++ ;
                                }
                                echo'</div>

                                    <div class="item-action"> 
                                        <a href="update_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-pencil"></i> Modifier</a>&nbsp&nbsp|&nbsp
                                        <a href="view_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-eye"></i> Voir</a>                            
                                    </div>
                                </div>';
                            }
                            Database::disconnect();
                    ?>
                    
                </div>
            </section>
                
            <section id="boutique-laptop" class="boutique-container" > 
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
                                        <img src="../images/' . $item['image'] . '" alt="item-image" class="item-image">
                                    </div>
                                    <div class="item-star">';
                                while($i <= $a){
                                    echo '<i class="fa fa-star" style="color:orange;"></i>';
                                    $i++;
                                }
                                $i = 0;
                                $a = 5 - $a;
                                while($i < $a){
                                echo '<i class="fa fa-star"  style="color: rgba(0,0,0,0.7);"></i>';
                                $i ++ ;
                                }
                                echo'</div>
                                    <div class="item-action"> 
                                        <a href="update_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-pencil"></i> Modifier</a>&nbsp&nbsp|&nbsp
                                        <a href="view_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-eye"></i> Voir</a>                            
                                    </div>
                                    </div>';
                            }
                            Database::disconnect();
                    ?>
                    
                </div>    
            </section>

            <section id="boutique-car" class="boutique-container" > 
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
                                        <img src="../images/' . $item['image'] . '" alt="item-image" class="item-image">
                                    </div>
                                    <div class="item-star">';
                                while($i <= $a){
                                    echo '<i class="fa fa-star" style="color:orange;"></i>';
                                    $i++;
                                }
                                $i = 0;
                                $a = 5 - $a;
                                while($i < $a){
                                echo '<i class="fa fa-star"  style="color: rgba(0,0,0,0.7);"></i>';
                                $i ++ ;
                                }
                                echo'</div>
                                        <div class="item-action"> 
                                            <a href="update_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-pencil"></i> Modifier</a>&nbsp&nbsp|&nbsp
                                            <a href="view_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-eye"></i> Voir</a>                            
                                        </div>
                                    </div>';
                            }
                            Database::disconnect();
                    ?>
                    
                </div>   
            </section>

            <section id="boutique-gadjets" class="boutique-container" > 
                
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
                                        <img src="../images/' . $item['image'] . '" alt="item-image" class="item-image">
                                    </div>
                                    <div class="item-star">';
                                while($i <= $a){
                                    echo '<i class="fa fa-star" style="color:orange;"></i>';
                                    $i++;
                                }
                                $i = 0;
                                $a = 5 - $a;
                                while($i < $a){
                                echo '<i class="fa fa-star"  style="color: rgba(0,0,0,0.7);"></i>';
                                $i ++ ;
                                }
                                echo'</div>
                                        <div class="item-action"> 
                                            <a href="update_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-pencil"></i> &nbspModifier</a>&nbsp&nbsp|&nbsp
                                            <a href="view_item.php?user='.$user_name.'&&id='.$item['code'].'" class="item-actions"> <i class="fa fa-eye"></i> &nbspVoir</a>                            
                                        </div>
                                    </div>';
                            }
                            Database::disconnect();
                    ?>
                    
                </div>
            </section>

            <section id="boutique-item" class="boutique-container">
                
                <form action="item.php?user=<?php echo $user_name; ?>" method="POST" id="item-add-form" enctype="multipart/form-data" role="form">
                    <div>
                        <label for="name">Nom de l'article :</label> &nbsp&nbsp&nbsp<input type="text" name="name" class="item-add-input"> <br><br>
                        <label for="libelle">Libelle</label><br> <textarea name="libelle" id="" cols="50" rows="5" placeHolder="Entrer le libelle..."></textarea><br><br>
                        <label for="description">Description</label> <br><textarea name="description" id="" cols="50" rows="11" placeHolder="Entrer la description..."></textarea>
                    </div>
                    
                    <div id="item-add-div2">
                        <label for="prix">Prix <span style="color:#fdac17;">( en € ) </span>:</label> &nbsp&nbsp&nbsp<input type="number" name="prix" class="item-add-input"> <br><br> 
                        <label for="qte">Quantite :</label> &nbsp&nbsp&nbsp<input type="number" name="qte" class="item-add-input">   <br><br>
                        <label for="eva">Evaluation</label> &nbsp&nbsp&nbsp <select name="eva" class="item-add-select"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option></select>  <br><br>
                        <label for="cat">Categorie</label> &nbsp&nbsp&nbsp<select name="cat" class="item-add-select"> <option value="smartphone">Smartphone</option>  <option value="laptop">Laptop</option> <option value="car">Car</option> <option value="gadjet">Gadjets</option></select> <br><br>
                        <label for="id-cat">ID-CAT</label> &nbsp&nbsp&nbsp<select name="id-cat" class="item-add-select"> <option value="phone">Phone</option>  <option value="laptop">Laptop</option> <option value="car">Car</option> </select> <br><br>
                        <label for="image">Sélectionner une image:</label> <input type="file" id="image" name="image"> <br><br>
                        
                        <button type="submit" id="item-add-submit"> <i class="fa fa-plus"></i>&nbsp Ajouter</button>
                    </div>

                </form>

            </section>
        </div>
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