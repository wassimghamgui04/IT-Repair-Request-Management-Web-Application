<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="../Controleur/Controle_user.php" method="post">
        id<input type="text"name="id">
        nom<input type="text"name="nom">
        email<input type="text"name="email">
        mdp<input type="text"name="mdp">
        role<input type="text"name="role">
        <input type="submit"name="ajouter" value="ajouter">
        <input type="submit"name="modifier"value="modifier">
        <input type="submit"name="supprimer" value="supprimer">
        <a href="Modif.php">Modifier</a>
    </form>
    <h2>Liste des Equipement</h2>
    <h3>Chercher par:</h3>

    <?php
    
    require_once "../Modele/User.php";
    require_once "../Modele/Equipement.php";
    session_start();
    $user=$_SESSION["user"];
    if (isset($_POST["submitRecherche"])) {
        //Récupérer les données à partir du formulaire
        $NomRecherche = $_POST["Nom"];
        
        $tabArt = Equipement::getEquipsUser($NomRecherche,$user->id);
    } else {
        $NomRecherche="";
        $tabArt = Equipement::getEquipsUserAll($user->id);
    }

    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        Nom: <input type="text" name="Nom" value="<?= $NomRecherche ?>" />
        <input type="submit" name="submitRecherche" value="Chercher" />
    </form>
    <hr />
    <table border='2'>
        <thead>
            <th>Id</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Statut</th>
            
        </thead>
        <tbody>
            <?php
            foreach ($tabArt as $art) {
                echo $art; ?>
                
                
            <?php } ?>


        </tbody>
    </table>

</body>
</html>