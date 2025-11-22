<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier vos données</title>
    <link rel="stylesheet" href="../Assets/css/style.css">
</head>
<body>
    <?php
    require_once "../Modele/User.php";
    require_once "../Modele/Equipement.php";
    session_start();
    $u = $_SESSION["user"];
    ?>
    <form action="../Controleur/Controle_user.php" method="post" class="form-container">
        <h2>Modifier vos données</h2>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" value="<?= $u->nom ?>" name="nom"><br>
        <label for="email">Email:</label>
        <input type="text" id="email" value="<?= $u->email ?>" name="email"><br>
        <label for="mdp">Mot de Passe:</label>
        <input type="text" id="mdp" value="<?= $u->mdp ?>" name="mdp"><br>
        <button type="submit" name="modifier" value="Modifier">Modifier</button>
    </form>
</body>
</html>