<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        form input[type="text"], form input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #218838;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .picture {
            text-align: center;
            margin: 20px;
        }
        .picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid #007bff;
        }
    </style>
</head>
<body>
<header>
    <h1>Gestion des Utilisateurs</h1>
</header>
<div class="picture">
    <img src="https://via.placeholder.com/150" alt="Admin Picture">
</div>
<form action="../Controleur/Controle_user.php" method="post">
    <center>
        <label for="id">Id :</label>
        <input type="text" name="id" id="id">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="mdp">Mot de passe:</label>
        <input type="text" name="mdp" id="mdp">
        <label for="role">Role:</label>
        <input type="text" name="role" id="role">
        <input type="submit" name="ajouter" value="Ajouter Utilisateur">
    </center>
</form>
<?php
    
    include ("../Modele/User.php");
    
    if (isset($_POST["submitRecherche"])) {
        //Récupérer les données à partir du formulaire
        $NomRecherche = $_POST["nom"];
        
        $tabArt = User::getUserAllC($NomRecherche);
    } else {
        $NomRecherche="";
        $tabArt = User::getUserAll();
    }

    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <center>
            <label for="nom">Recherche par Nom:</label>
            <input type="text" name="nom" value="<?= $NomRecherche ?>">
            <input type="submit" name="submitRecherche" value="Chercher">
        </center>
    </form>
    <hr />
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Mot de Passe</th>
                <th>Role</th>
                <th>Etat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tabArt as $art) {
                echo $art;
                
                    ?><td><a href="../Vue/View_Modifutili.php?id=<?= $art->id ?> ">Modifier</a>
                    <a href="../Controleur/ControleDemandR.php?idSUP=<?= $art->id ?> " onclick="return confirm("Etes vous sûr de vouloir supprimer cet évènement?")">Supprimer</a>
                    </td></tr><?php
                  ?>
                
            <?php
        } ?>


        </tbody>
    </table>
</body>
</html>