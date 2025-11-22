<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        #modif-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        #modif-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
    include ('../Modele/User.php');
    $id = $_GET['id'];
    $demandModif = User::getUserC($id);
?>
    <form id="modif-form" action="../Controleur/Controle_user.php" method="post">
        <h2>Modifier Utilisateur</h2>
        <label for="id">Id:</label>
        <input type="text" id="id" name="id" value="<?= $demandModif->id ?>" readonly>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?= $demandModif->nom ?>">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= $demandModif->email ?>">
        <label for="mdp">Mot de passe:</label>
        <input type="text" id="mdp" name="mdp" value="<?= $demandModif->mdp ?>">
        <label for="role">Rôle:</label>
        <input type="text" id="role" name="role" value="<?= $demandModif->role ?>">
        <input type="submit" value="Modifier Utilisateur" name="modifierU">
    </form>
</body>
</html>