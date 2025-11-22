<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #444;
            color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        iframe {
            width: 100%;
            height: 80vh;
            border: none;
        }
    </style>
</head>
<body>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
require_once "../Modele/User.php";
require_once "../Modele/Equipement.php";
session_start();
$user = $_SESSION["user"];
?>
<div class="header">
    <h1>Bienvenue <?=$user->nom?> - Votre Role: <?=$user->role?></h1>
</div>
<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="?page=donnes">Modifier les données</a></li>
            <li><a href="?page=utili">Utilisateurs</a></li>
            <li><a href="?page=equip">Equipement</a></li>
            <li><a href="?page=demand">Demandes Reparation</a></li>
            <li><a href="?page=demandAF">Demandes Affecté</a></li>
            <li><a href="?page=inter">Intervention</a></li>
            <li><a href="?page=quit">Deconnexion</a></li>
        </ul>
    </div>
    <div class="content">
        <?php
        if ($page == 'donnes') {
            echo '<h2>Modifier les données</h2><iframe src="View_mdnnadm.php"></iframe>';
        } elseif ($page === 'equip') {
            echo '<h2>Equipement</h2><iframe src="View_EquipAdmin.php"></iframe>';
        } elseif ($page === 'demand') {
            echo '<h2>Demandes</h2><iframe src="View_DemandRepA.php"></iframe>';
        } elseif ($page === 'utili') {
            echo '<h2>Utilisateurs</h2><iframe src="View_AdmnUtili.php"></iframe>';
        }elseif ($page === 'demandAF') {
            echo '<h2>Demandes Affecté</h2><iframe src="View_DemandAffecte.php"></iframe>';
        } elseif ($page === 'inter') {
        echo '<h2>Utilisateurs</h2><iframe src="View_interADD.php"></iframe>';
    }  elseif ($page === 'utili') {
    echo '<h2>Utilisateurs</h2><iframe src="View_AdmnUtili.php"></iframe>';
} elseif ($page === 'quit') {
            session_destroy();
            echo '<script>document.location.href="../Vue/View_auth.php"</script>';
        } else {
            echo "<h2>Bienvenue</h2><p>Choisissez une option dans le menu.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>