<?php
     
    require 'database.php';

    $user_name = "";

    if(!empty($_GET['user'])){
        $user_name = $_GET['user'];
    }
    else{
        header("Location: connect.php");
    }

    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
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
        $isUploadSuccess    = true;
        
        if(empty($name) OR empty($libelle) OR empty($description) OR empty($price) OR empty($category) OR empty($qte) OR empty($eva) OR empty($id_cat)){
            $message = "Les champs ne doivent pas etre vides";
            $isSuccess = false;
        }
        if(empty($image)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
        {
            $isImageUpdated = false;
        }
        else{
            $isImageUpdated = true;
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
                    $isSuccess = false;
                } 
            } 
        }

        if ($isSuccess && $isUploadSuccess) 
        { 
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE item  set name = ?, libelle = ?, description = ?, prix = ?,categorie =?, quantite = ?,évaluation = ?, id_cat = ?, image = ? WHERE code = ?");
                $statement->execute(array($name,$libelle,$description,$price,$category,$qte,$eva,$id_cat,$image,$id));
            }
            else
            {
                $statement = $db->prepare("UPDATE item  set name = ?, libelle = ?, description = ?, prix = ?, categorie = ?, quantite = ?,évaluation = ?, id_cat = ?  WHERE code = ?");
                $statement->execute(array($name,$libelle,$description,$price,$category,$qte,$eva,$id_cat,$id));

            }
            Database::disconnect();
            header("Location: item.php?user=$user_name");
        }
    }
    else{
        $db = Database::connect();
        $statement = $db->prepare('SELECT * FROM item WHERE item.code = ?');
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name           = $item['name'];
        $libelle        = $item['libelle'];
        $description    = $item['description'];
        $price          = $item['prix'];
        $category       = $item['categorie'];
        $qte            = $item['quantite'];
        $eva            = $item['évaluation'];
        $id_cat         = $item['id_cat'];
        $image          = $item['image'];
        Database::disconnect();
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

        <div id="update-item-container1">
            <h2 class="admin-title1 upa">Modifier un article</h2>
            <div class="admin-line-container upa">
                    <div class="line"></div> 
                    <div class="box"></div> 
            </div>
            <form action="update_item.php?user=<?php echo $user_name; ?>&&id=<?php echo $id; ?>" method="POST" id="item-add-form" enctype="multipart/form-data" role="form">
                <div>
                    <label for="name">Nom de l'article :</label> &nbsp&nbsp&nbsp<input type="text" name="name" class="item-add-input" value="<?php echo $name; ?>"> <br><br>
                    <label for="libelle">Libelle</label><br> <textarea name="libelle" id="" cols="50" rows="5" ><?php echo $libelle; ?></textarea><br><br>
                    <label for="description">Description</label> <br><textarea name="description" id="" cols="50" rows="11" ><?php echo $description; ?></textarea>
                </div>
                
                <div id="item-add-div2">
                    <label for="prix">Prix <span style="color:#fdac17;">( en € ) </span>: </label> &nbsp&nbsp&nbsp<input type="number" name="prix" class="item-add-input" value="<?php echo $price; ?>">  <br><br> 
                    <label for="qte">Quantite :</label> &nbsp&nbsp&nbsp<input type="number" name="qte" class="item-add-input" value="<?php echo $qte; ?>">   <br><br>
                    <label for="eva">Evaluation</label> &nbsp&nbsp&nbsp <select name="eva" class="item-add-select"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option>  <option value="<?php echo $eva; ?>" selected="selected"><?php echo $eva; ?></option></select>  <br><br>
                    <label for="cat">Categorie</label> &nbsp&nbsp&nbsp<select name="cat" class="item-add-select"> <option value="smartphone">smartphone</option>  <option value="laptop">laptop</option> <option value="car">car</option> <option value="gadjet">Gadjets</option> <option value="<?php echo $category; ?>" selected="selected"><?php echo $category; ?></option> </select> <br><br>
                    <label for="id-cat">ID-CAT</label> &nbsp&nbsp&nbsp<select name="id-cat" class="item-add-select"> <option value="phone">phone</option>  <option value="laptop">laptop</option> <option value="car">car</option> <option value="<?php echo $id_cat; ?>" selected="selected"><?php echo $id_cat; ?></option> </select> <br><br>
                    <label for="image">Sélectionner une image</label> <input type="file" id="image" name="image"> <br><br>
                    <a href="item.php?user=<?php echo $user_name; ?>"> <i class="fa fa-arrow-left"></i> retour</a> &nbsp&nbsp&nbsp&nbsp&nbsp
                    <button type="submit" id="item-add-submit"> <i class="fa fa-pencil"></i>&nbsp Modifier</button> <br><br>
                    <p>&nbsp <?php echo $message; ?></p>
                </div>

            </form>
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