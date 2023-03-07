<?php
    require "database.php";

    $user_name = "";

    if(!empty($_GET['user'])){
        $user_name = $_GET['user'];
    }
    else{
        header("Location: connect.php");
    }

    $update_name = $update_password = $message = $id = "";

    if(!empty($_GET['add'])){

        if(!empty($_POST['name']) && !empty($_POST['password'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $db = Database::connect();
            $statement = $db->prepare('SELECT * FROM user WHERE user.name = ? AND user.password = ?');
            $statement->execute(array($name,$password));
            $i = 0;
            while($b = $statement->fetch()){
                $i++;
            }
            Database::disconnect();

            if($i == 1){
                $message = "Ces informations appartiennent a un autre administrateur. Veuillez les changer.";
            }elseif($i == 0){
                $db= Database::connect();
                $statement = $db->prepare('INSERT INTO user(user.name, user.password) VALUES(?,?)');
                $statement->execute(array($name,$password));
                Database::disconnect();
            }
        }
        
        $_POST['name'] = $_POST['password'] = null;
    }

    if(!empty($_GET['update_id'])){

        $id = $_GET['update_id'];
        
        $db = Database::connect();
        $statement = $db->prepare('SELECT * FROM user WHERE user.id = ?');
        $statement->execute(array($id));
        $user = $statement->fetch();
        
        $update_name = $user['name'];
        $update_password = $user['password'];
        Database::disconnect();
    }

    if(!empty($_GET['update'])){

        if(!empty($_POST['update_name']) && !empty($_POST['update_password'])){

            $db = Database::connect();
            $statement = $db->prepare('SELECT * FROM user WHERE user.name = ? AND user.password = ?');
            $statement->execute(array($_POST['update_name'], $_POST['update_password']));
            $i = 0;
            while($b = $statement->fetch()){
                $i++;
            }
            Database::disconnect();

            if($i == 1){
                $message = "Ces informations appartiennent a un autre administrateur. Veuillez les changer.";
            }elseif($i == 0){
                $db = Database::connect();
                $statement = $db->prepare('UPDATE user SET user.name = ?, user.password = ? WHERE user.id = ?');
                $statement->execute(array($_POST['update_name'], $_POST['update_password'], $id));
                Database::disconnect();
                $_GET['update_id'] = null;
            }            
        }

        $_POST['update_name'] = $_POST['update_password'] = null;
    }

    if(!empty($_GET['delete_id'])){
        $db = Database::connect();
        $statement = $db->prepare('DELETE FROM user WHERE user.id = ?');
        $statement->execute(array($_GET['delete_id']));
        Database::disconnect();
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
            
            <div id="index-title"> <i class="fa fa-user"></i>&nbsp Administrateur </div>

            <div id="user-div1">
                <div><i class="fa fa-user-circle"></i>&nbsp <?php echo $user_name; ?></div>&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="connect.php"> <i class="fa fa-sign-out"></i> Se deconnecter</a>
            </div>

        </div>


        <div id="admin-container1">
            <div>
                <h2 class="admin-title1">Liste des Administrateurs</h2>
                <div class="admin-line-container">
                    <div class="line"></div> 
                    <div class="box"></div> 
                </div><br>
                <table id="admin-table">
                    <thead>
                        <tr>
                            <th width = "fit-content">Nom</th>
                            <th width = "fit-content">Mot de passe</th>
                            <th width = "fit-content">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = Database::connect();
                            $statement = $db->query('SELECT * FROM user');
                            while($admin = $statement->fetch()){
                                echo '
                                    <tr>
                                        <td>'.$admin['name'].'</td>
                                        <td>'.$admin['password'].'</td>
                                        <td>
                                            <a href="admin.php?user='.$user_name.'&&update_id='.$admin['id'].'" class="admin-update"><i class="fa fa-pencil"></i> &nbspModifier</a>&nbsp&nbsp|&nbsp
                                            <a href="admin.php?user='.$user_name.'&&delete_id='.$admin['id'].'" class="admin-delete"><i class="fa fa-trash"></i> &nbspSupprimer</a>
                                        </td>
                                    </tr>
                                ';
                            }
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>


            <div id="admin-div1">
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore ea eveniet ut? 
                Corporis et impedit delectus ipsum ex dolores id!
                </p>
                <div id="admin-add" class="admin-action admin-active">
                    <h2>Ajouter un adminstrateur</h2>
                    <div class="admin-line-container">
                        <div class="line" ></div> 
                        <div class="box"></div> 
                    </div><br>
                    <form action="admin.php?user=<?php echo $user_name; ?>&&add=1" method=post>
                        <label for="name" class="admin-action-label">Nom</label> &nbsp&nbsp<input type="text" name="name" class="admin-action-input"><br><br>
                        <label for="name" class="admin-action-label">Mot de passe</label> &nbsp&nbsp<input type="text" name="password" class="admin-action-input"><br><br>

                        <button type=submit class="admin-submit" > <i class="fa fa-user-plus"></i>&nbsp Ajouter</button>
                    </form>
                    <div class="admin-message"> <?php echo $message; ?> </div>
                </div>

                <div id="admin-update" class="admin-action">
                    <h2>Modifier un adminstrateur</h2>
                    <div class="admin-line-container">
                        <div class="line"></div> 
                        <div class="box"></div> 
                    </div><br>
                    <form action="admin.php?user=<?php echo $user_name; ?>&&update=1&&update_id=<?php echo $id; ?>" method=post>
                        <label for="name" class="admin-action-label">Nom</label> &nbsp&nbsp<input type="text" name="update_name" class="admin-action-input" value="<?php echo $update_name; ?>"><br><br>
                        <label for="name" class="admin-action-label">Mot de passe</label> &nbsp&nbsp<input type="text" name="update_password" class="admin-action-input" value="<?php echo $update_password; ?>"><br><br>

                        <button type=submit class="admin-submit"> <i class="fa fa-pencil"></i> &nbspModifier</button>
                    </form>
                </div>
            </div>
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
                comm.classList.remove("active");
                admin.classList.add("active");
            </script>';


        if(!empty($_GET['update_id'])){
            echo '
                <script language="Javascript">
                    const add = document.getElementById("admin-add");
                    const update = document.getElementById("admin-update");
                    
                    add.classList.remove("admin-active");
                    update.classList.add("admin-active");
                
                </script>
    
            ';
        }
    ?>
    <script language="Javascript">
        // function delete(id){
        //     confirm("Voulez-vous vraiment supprimer cet administrateur ?");
        //     var a = confirm("Voulez-vous vraiment supprimer cet administrateur ?");
        //     if(confirm(a == true)){
        //         window.location.href = 'admin.php?delete_id='+id+'';
        //         return true;
        //     }
        // }
    </script>
    
</body>
</html>