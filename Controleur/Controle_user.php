<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("../Modele/User.php");
    function AjouterUser()
    {
        //On ne peut pas insérer une référence vide dans la BD!
        if (!empty($_POST["id"])) {

            //Récupérer les données à partir du formulaire
            $id = $_POST["id"];
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            $role=$_POST["role"];
            //Construire l'objet article et l'ajouter dans la BD
            $art = new User($id, $nom,  $email,$mdp, $role); //,$ptVentes);

            return ($art->ajouterUsers());
            echo "<script>document.location='../Vue/View_uAdmnUtili.php'</script>";
        } else return 0;
    }
    function modifierUser()
    {
        session_start();
        $u=$_SESSION["user"];
        //Récupérer les données à partir du formulaire
             $id = $u->id;
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            $role=$u->role;
            //Construire l'objet article et l'ajouter dans la BD
            $art = new User($id, $nom,  $email,$mdp, $role); 
            
            
            return ($art->modifierUsers());
            
        
    }
    function modifierADMN()
    {
        session_start();
        $u=$_SESSION["user"];
        //Récupérer les données à partir du formulaire
             $id = $u->id;
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            $role=$_POST["role"];
            //Construire l'objet article et l'ajouter dans la BD
            $art = new User($id, $nom,  $email,$mdp, $role); 
            
            
            return ($art->modifierADMs());
            
        
    }
    function modifierADMNU()
    {
        
        //Récupérer les données à partir du formulaire
             $id = $_POST["id"];
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            $role=$_POST["role"];
            //Construire l'objet article et l'ajouter dans la BD
            $art = new User($id, $nom,  $email,$mdp, $role); 
            
            
            return ($art->modifierADMs());
            
        
    }
    function supprimerUser()
    {
        if (!empty($_POST["id"])) {
        //Récupérer les données à partir du formulaire
             $id = $_POST["id"];
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $mdp = $_POST["mdp"];

            $role=$_POST["role"];
            //Construire l'objet article et l'ajouter dans la BD
            $art = new User($id, $nom,  $email,$mdp, $role); 

            return ($art->supprimerUsers());
        } else return 0;
    }
    if (isset($_POST["ajouter"])) {
        $ajout = AjouterUser();
        if ($ajout)
            echo '<script>alert("Employe ajouté")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo '<script> document.location.hid="../Vue/view_article.php"</script>';
    }
    if(isset($_POST["modifier"])) {
        $mod = modifierUser();
        if ($mod)
            echo '<script>alert("Employe mod")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo '<script> document.location.hid="../Vue/view_article.php"</script>';
    }
    if(isset($_POST["supprimer"])) {
        $mod = supprimerUser();
        if ($mod)
            echo '<script>alert("Employe mod")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo '<script> document.location.hid="../Vue/view_article.php"</script>';
    }
    if(isset($_POST["modifierADM"])) {
        $mod = modifierADMN();
        if ($mod)
            echo '<script>alert("Employe mod")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo '<script> document.location.hid="../Vue/view_article.php"</script>';
    }
    if(isset($_POST["modifierU"])) {
        $mod = modifierADMNU();
        if ($mod)
            echo '<script>alert("Employe mod")</script>';
        else  echo '<script>alert("Référence non fournie ou Erreur d\'ajout!")</script>';
        //Rediriger l'utilisateur vers view_article
        echo '<script> document.location.hid="../Vue/view_article.php"</script>';
    }
?>
</body>
</html>