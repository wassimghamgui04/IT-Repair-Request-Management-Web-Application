<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Assets/css/style.css">
</head>
<body>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<?php
    
    require_once "../Modele/User.php";
    require_once "../Modele/Equipement.php";
    session_start();
    $user=$_SESSION["user"];
    ?>
    <div class="Emp">
    <header>
        <center><h1 id="Debt">Bienvenue <?=$user->nom?> Votre Role <?=$user->role?> !!</h1></center>
    </header>
    <nav class="dashboard-nav">
        <ul>
            <li><a href="?page=donnes">Modifier les données</a></li>
            <li><a href="?page=equip">Equipement</a></li>
            <li><a href="?page=demand">Demandes</a></li>
            <li><a href="?page=quit">Deconnexion</a></li>
        </ul>
    </nav>
    <section class="content-section">
        <?php
        if ($page == 'donnes') {
            echo '<h2>Modifier les données</h2><iframe src="View_Mdnn.php" frameborder="0" class="content-iframe"></iframe>';
        } elseif ($page === 'equip') {
            echo '<h2>Equipement</h2><iframe src="View_EquipUser.php" frameborder="0" class="content-iframe"></iframe>';
        } elseif ($page === 'demand') {
            echo '<h2>Demandes</h2><iframe src="View_DemandRepU.php" frameborder="0" class="content-iframe"></iframe>';
        } elseif ($page === 'quit') {
            session_destroy();
            echo '<script>document.location.href="../Vue/View_auth.php"</script>';
        } else {
            echo "<h2>Bienvenue</h2><p>Choisissez une option dans le menu.</p>";
        }
        ?>
    </section>
</div>
</body>
</html>