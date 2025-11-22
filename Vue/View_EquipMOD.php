<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Équipement</title>
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
    include ('../Modele/Equipement.php');
    
    $id = $_GET['id'];

    $demandModif = Equipement::getEquipsA($id);

    ?>
    <form id="modif-form" action="../Controleur/Controle_Equipement.php" method="post">
        <h2>Modifier Équipement</h2>
        <label for="id">Id:</label>
        <input type="text" id="id" name="id" value="<?= $demandModif->id ?>" readonly>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?= $demandModif->nom ?>">
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" value="<?= $demandModif->type ?>">
        <label for="statut">Statut:</label>
        <input type="text" id="statut" name="statut" value="<?= $demandModif->statut ?>">
        <label for="idUser">Id Utilisateur:</label>
        <input type="text" id="idUser" name="idUser" value="<?= $demandModif->idUser ?>">
        <input type="submit" value="Modifier Équipement" name="modifier">
    </form>
</body>
</html>