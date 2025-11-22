<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier vos données</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #update-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        #form-title {
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
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        #submit-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        #submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<?php
    require_once "../Modele/User.php";
    require_once "../Modele/Equipement.php";
    session_start();
    
    $u=$_SESSION["user"];
    
    ?>
    <form id="update-form" action="../Controleur/Controle_user.php" method="post">
        <center>
            <h2 id="form-title">Modifier vos données</h2><br>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" value="<?= $u->nom ?>" name="nom"><br>
            <label for="email">Email:</label>
            <input type="text" id="email" value="<?= $u->email ?>" name="email"><br>
            <label for="mdp">Mot de Passe:</label>
            <input type="text" id="mdp" value="<?= $u->mdp ?>" name="mdp"><br>
            <label for="role">Rôle:</label>
            <input type="text" id="role" value="<?= $u->role ?>" name="role"><br>
            <button id="submit-button" type="submit" name="modifierADM" value="Modifier">Modifier</button>
        </center>
    </form>
</body>
</html>