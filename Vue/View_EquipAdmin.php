<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Équipements</title>
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
        #equip-form, #search-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        #equip-form h2, #search-form h2 {
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
<?php
    require_once "../Modele/User.php";
    require_once "../Modele/Equipement.php";
    session_start();
    $user = $_SESSION["user"];
    if (isset($_POST["submitRecherche"])) {
        // Récupérer les données à partir du formulaire
        $NomRecherche = $_POST["Nom"];
        $tabArt = Equipement::getEquips($NomRecherche);
    } else {
        $NomRecherche = "";
        $tabArt = Equipement::getEquipsUserAllA();
    }
?>
    <form id="equip-form" action="../Controleur/Controle_Equipement.php" method="POST">
        <h2>Ajouter un Équipement</h2>
        <label for="id">Id Équipement:</label>
        <input type="text" name="id" id="id">
        <label for="nom">Nom Équipement:</label>
        <input type="text" name="nom" id="nom">
        <label for="type">Type Équipement:</label>
        <input type="text" name="type" id="type">
        <label for="statut">Statut Équipement:</label>
        <input type="text" name="statut" id="statut">
        <label for="idUser">Id Utilisateur:</label>
        <input type="text" name="idUser" id="idUser">
        <input type="submit" name="ajouter" value="Ajouter Équipement">
    </form>
    <form id="search-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <h2>Rechercher un Équipement</h2>
        <label for="Nom">Nom:</label>
        <input type="text" name="Nom" id="Nom" value="<?= $NomRecherche ?>">
        <input type="submit" name="submitRecherche" value="Chercher">
    </form>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Id Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tabArt as $art) { ?>
                <tr>
                    <td><?= $art->id ?></td>
                    <td><?= $art->nom ?></td>
                    <td><?= $art->type ?></td>
                    <td><?= $art->statut ?></td>
                    <td><?= $art->idUser ?></td>
                    <td class="action-links">
                        <a href="../Vue/View_EquipMOD.php?id=<?= $art->id ?>">Modifier</a>
                        <a href="../Controleur/Controle_Equipement.php?idSUP=<?= $art->id ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>