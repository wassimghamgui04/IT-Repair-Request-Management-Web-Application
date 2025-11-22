<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes Affectées</title>
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
        #search-form {
            background-color: #fff8dc; /* Cornsilk */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        #search-form h2 {
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
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff8dc; /* Cornsilk */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        table th {
            background-color: #ffd700; /* Gold */
            color: black;
        }
        table tr:nth-child(even) {
            background-color: #fffacd; /* Lemon Chiffon */
        }
        table tr:hover {
            background-color: #fff8b5; /* Light Yellow */
        }
    </style>
</head>
<body>
<?php
    require_once "../Modele/DemandeAFF.php";
    session_start();
    $user = $_SESSION["user"];
    if (isset($_POST["submitRecherche"])) {
        $NomRecherche = $_POST["id"];
        $tabD = DemandeAFF::getDemandsAFFCT($NomRecherche, $user->id);
    } else {
        $NomRecherche = "";
        $tabD = DemandeAFF::getDemandsAffT($user->id);
    }
?>
    <form id="search-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <h2>Rechercher une Demande Affectée</h2>
        <label for="id">Id Demande:</label>
        <input type="text" name="id" id="id" value="<?= $NomRecherche ?>">
        <input type="submit" name="submitRecherche" value="Chercher">
    </form>
    <table>
        <thead>
            <tr>
                <th>Id Demande</th>
                <th>Nom Technicien</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tabD as $A) {
                echo "<tr>";
                echo "<td>$A->idDemandR</td>";
                $u = User::getUserC($A->idTech);
                echo "<td>$u->nom</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>