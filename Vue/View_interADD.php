<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Interventions</title>
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
        #intervention-form, #search-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        #intervention-form h2, #search-form h2 {
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
        select, input[type="text"], input[type="submit"] {
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
    require_once "../Modele/intervantion.php";
    session_start();
    $user = $_SESSION["user"];
    if (isset($_POST["submitRecherche"])) {
        $NomRecherche = $_POST["Nom"];
        $tabArt = Intervention::getInterventions($NomRecherche);
    } else {
        $NomRecherche = "";
        $tabArt = Intervention::getInterventionsAll();
    }
?>
    <form id="intervention-form" action="../Controleur/Controle_Intervention.php" method="POST">
        <h2>Ajouter une Intervention</h2>
        <label for="id">Id Intervention:</label>
        <input type="text" name="id" id="id">
        <label for="idDem">Sélectionner une Demande:</label>
        <select name="idDem" id="idDem">
            <option value="">Sélectionner une Demande</option>
            <?php
            require_once '../Modele/DemandeRep.php';
            $tabD = DemandeRep::getDemandUserAll();
            foreach ($tabD as $A) {
                if ($A->statut != "refusée") {
                    echo "<option value='$A->id'>$A->id</option>";
                }
            }
            ?>
        </select>
        <label for="idTech">Sélectionner un Technicien:</label>
        <select name="idTech" id="idTech">
            <option value="">Sélectionner un Technicien</option>
            <?php
            require_once '../Modele/User.php';
            $tabU = User::getUserAllTech();
            foreach ($tabU as $T) {
                echo "<option>$T->id</option>";
            }
            ?>
        </select>
        <label for="com">Commentaire Intervention:</label>
        <input type="text" name="com" id="com">
        <input type="submit" name="ajouter" value="Ajouter Intervention">
    </form>
    <form id="search-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <h2>Rechercher une Intervention</h2>
        <label for="Nom">Nom:</label>
        <input type="text" name="Nom" id="Nom" value="<?= $NomRecherche ?>">
        <input type="submit" name="submitRecherche" value="Chercher">
    </form>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Id Demande</th>
                <th>Id Technicien</th>
                <th>Date Intervention</th>
                <th>Commentaire Intervention</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tabArt as $art) { ?>
                <tr>
                    <td><?= $art->id ?></td>
                    <td><?= $art->idDem ?></td>
                    <td><?= $art->idTech ?></td>
                    <td><?= $art->dateI ?></td>
                    <td><?= $art->des ?></td>
                    <td class="action-links">
                        <a href="../Vue/View_InterMOD.php?id=<?= $art->id ?>">Modifier</a>
                        <a href="../Controleur/Controle_Intervention.php?idSUP=<?= $art->id ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet évènement ?')">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>