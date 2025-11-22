<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Intervention</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fffbea; /* Light yellow */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }
        #modif-form {
            background-color: #fff8dc; /* Cornsilk */
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
            background-color: #ffd700; /* Gold */
            color: black;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #ffc107; /* Amber */
        }
    </style>
</head>
<body>
<?php
    include '../Modele/intervantion.php';
    $id = $_GET['id'];
    $demandModif = Intervention::getIntervention($id);
?>
    <form id="modif-form" action="../Controleur/Controle_InterventionT.php" method="post">
        <h2>Modifier Intervention</h2>
        <label for="id">Id:</label>
        <input type="text" id="id" name="id" value="<?= $demandModif->id ?>" readonly>
        <label for="idDem">Id Demande:</label>
        <input type="text" id="idDem" name="idDem" value="<?= $demandModif->idDem ?>">
        <label for="dateInter">Date Intervention:</label>
        <input type="text" id="dateInter" name="dateInter" value="<?= $demandModif->dateI ?>">
        <label for="com">Commentaire:</label>
        <input type="text" id="com" name="com" value="<?= $demandModif->des ?>">
        <input type="submit" value="Modifier" name="modifier">
    </form>
</body>
</html>