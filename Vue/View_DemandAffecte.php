<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Demandes Affectées</title>
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
        #affect-form, #search-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        #affect-form h2, #search-form h2 {
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
    <form id="affect-form" action="../Controleur/ControleAff.php" method="post">
        <h2>Affecter ou Rejeter une Demande</h2>
        <label for="id">Sélectionner une Demande:</label>
        <select name="id" id="id">
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
        <input type="submit" value="Rejeter" name="rejeter">
        <label for="idTech">Sélectionner un Technicien:</label>
        <select name="idTech" id="idTech">
            <option value="">Sélectionner un Technicien</option>
            <?php
            require_once '../Modele/User.php';
            $tabU = User::getUserAllTech();
            foreach ($tabU as $T) {
                echo "<option>$T->nom</option>";
            }
            ?>
        </select>
        <input type="submit" value="Affecter" name="affecter">
    </form>
    <?php
    require_once "../Modele/DemandeAFF.php";
    if (isset($_POST["submitRecherche"])) {
        $NomRecherche = $_POST["id"];
        $tabD = DemandeAFF::getDemandsAFFC($NomRecherche);
    } else {
        $NomRecherche = "";
        $tabD = DemandeAFF::getDemandsAff();
    }
    ?>
    <form id="search-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <h2>Rechercher une Demande Affectée</h2>
        <label for="search-id">Id:</label>
        <input type="text" name="id" id="search-id" value="<?= $NomRecherche ?>">
        <input type="submit" name="submitRecherche" value="Chercher">
    </form>
    <table>
        <thead>
            <tr>
                <th>Id Demande</th>
                <th>Nom Technicien</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tabD as $A) {
                echo "<tr>";
                echo "<td>$A->idDemandR</td>";
                $u = User::getUserC($A->idTech);
                echo "<td>$u->nom</td>";
                ?>
                <td class="action-links">
                    <a href="../Controleur/ControleAff.php?idD=<?= $A->idDemandR ?>&idT=<?= $u->id ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet évènement ?')">Supprimer</a>
                </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>