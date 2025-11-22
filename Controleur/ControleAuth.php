<?php
require_once '../Modele/connexion.php';
require_once '../Modele/User.php';
if (isset($_POST["cnx"])) {
    $lg=$_POST["login"];
    $mp=$_POST["pass"];
    $user=User::getUser($lg ,$mp);
    if ($user!=null) {
        session_start();
        $_SESSION["user"]=$user;
        if ($user->role=='employe') {
            echo "<script>document.location='../Vue/View_emp.php'</script>";
        }
        elseif($user->role=='technicien') {
            echo "<script>document.location='../Vue/View_tech.php'</script>";
        }
        else {
           echo" <script>document.location='../Vue/View_admn.php'</script>";
        }
    }
}
else {
    echo'erreur';
}
?>