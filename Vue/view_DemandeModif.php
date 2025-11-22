<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Demande</title>
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
    include '../Modele/DemandeRep.php';
    session_start();
    $u = $_SESSION["user"];
    $id = $_GET['id'];
    if ($u->role == "admin") {
        $demandModif = DemandeRep::getDemandUserAFA($id);
    } else {
        $demandModif = DemandeRep::getDemandUserAFF($id, $u->id);
    }
?>
    <form id="modif-form" action="../Controleur/ControleDemandR.php" method="post">
        <h2>Modifier Demande</h2>
        <label for="id">Id:</label>
        <input type="text" id="id" name="id" value="<?= $demandModif->id ?>" readonly>
        <label for="date">Date:</label>
        <input type="text" id="date" name="date" value="<?= $demandModif->dateD ?>">
        <label for="statut">Statut:</label>
        <input type="text" id="statut" name="statut" value="<?= $demandModif->statut ?>">
        <label for="des">Description:</label>
        <input type="text" id="des" name="des" value="<?= $demandModif->des ?>">
        <label for="idequip">Id Equipement:</label>
        <input type="text" id="idequip" name="idequip" value="<?= $demandModif->idEquip ?>">
        <label for="idUser">Id Employé:</label>
        <input type="text" id="idUser" name="idUser" value="<?= $demandModif->idUser ?>">
        <input type="submit" value="Modifier" name="modifier">
    </form>
</body>
</html>