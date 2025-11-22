<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Demandes</title>
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
        #demand-form, #search-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        #demand-form h2, #search-form h2 {
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
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .action-links a {
            text-decoration: none;
            color: #007bff;
            margin: 0 5px;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form id="demand-form" action="../Controleur/ControleDemandR.php" method="post">
        <h2>Ajouter une Demande</h2>
        <label for="id">Id Demande:</label>
        <input type="text" name="id" id="id">
        <label for="des">Description Demande:</label>
        <input type="text" name="des" id="des">
        <label for="idequip">Id Equipement Demande:</label>
        <input type="text" name="idequip" id="idequip">
        <input type="submit" name="ajouter" value="Ajouter Demande">
    </form>
    <?php
    require_once "../Modele/DemandeRep.php";
    if (isset($_POST["submitRecherche"])) {
        $NomRecherche = $_POST["id"];
        $tabArt = DemandeRep::getDemandsADD($NomRecherche);
    } else {
        $NomRecherche = "";
        $tabArt = DemandeRep::getDemandUserAll();
    }
    ?>
    <form id="search-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <h2>Rechercher une Demande</h2>
        <label for="id">Nom:</label>
        <input type="text" name="id" id="id" value="<?= $NomRecherche ?>">
        <input type="submit" name="submitRecherche" value="Chercher">
    </form>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Description</th>
                <th>Id Equipement</th>
                <th>Id Employé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tabArt as $art) { ?>
                <tr>
                    <td><?= $art->id ?></td>
                    <td><?= $art->dateD ?></td>
                    <td><?= $art->statut ?></td>
                    <td><?= $art->des ?></td>
                    <td><?= $art->idEquip ?></td>
                    <td><?= $art->idUser ?></td>
                    <td class="action-links">
                        <a href="../Vue/view_DemandeModif.php?id=<?= $art->id ?>">Modifier</a>
                        <a href="../Controleur/ControleDemandR.php?idSUP=<?= $art->id ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>